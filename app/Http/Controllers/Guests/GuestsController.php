<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Admin\CollectScore;
use App\Http\Requests\Guests\SubmitVote;
use Illuminate\Support\Facades\Redis;

class GuestsController extends BasicController
{
    function collectScore(CollectScore $request)
    {
        $singer_id = $request->input('singer_id');
        $song_id = $request->input('song_id');
        $singer_data = Redis::get(self::PREFIX_SINGER . $singer_id);
        if (!$singer_data) {
            return response()->json(['code' => 404, 'message' => 'Singer not found'], 404);
        }
        $singer_data = json_decode($singer_data, true);
        foreach ($singer_data['songs'] as $song_index => $song) {
            if ($song['song'] == $song_id) {
                $song_data = $song;
                break;
            }
        }
        if (!isset($song_data)) {
            return response()->json(['code' => 404, 'message' => 'Song not found'], 404);
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $song_data]);
    }

    function collectAllScores()
    {
        $singers = Redis::hgetall(self::KEY_SINGERS);
        $data = [];
        foreach ($singers as $id => $name) {
            $singer_data = Redis::get(self::PREFIX_SINGER . $id);
            if (!$singer_data) {
                continue;
            }
            $singer_data = json_decode($singer_data, true);
            $game_score = 0;
            foreach ($singer_data['songs'] as $song) {
                $game_score += $song['final_score'];
            }
            $songs_data = [];
            foreach ($singer_data['songs'] as $song) {
                $songs_data[] = [
                    'id' => $song['song'],
                    'song' => Redis::hget(self::KEY_SONGS, $song['song']),
                    'final_score' => $song['final_score'],
                ];
            }
            $data[] = [
                'id' => $id,
                'name' => $name,
                'songs' => $songs_data,
                'game_score' => count($singer_data['songs']) ? round($game_score / count($singer_data['songs']), 2) : 0,
            ];
        }
        array_multisort(array_column($data, 'game_score'), SORT_DESC, $data);
        $redacted_data = [];
        foreach ($data as $index => $singer) {
            $singer['game_score'] = "本轮结束后公布";
            $redacted_data[] = $singer;
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $redacted_data]);
    }

    function submitVote(SubmitVote $request)
    {
        $vote_open = Redis::get(self::KEY_VOTE_OPEN);
        if (!$vote_open) {
            return response()->json(['code' => 403, 'message' => 'Voting is not open'], 403);
        }
        $guest_id = $request->input('guest_id');
        $singer_id = $request->input('singer_id');
        $team_id = $request->input('team_id');
        $team_data = Redis::get(self::PREFIX_TEAM . $team_id);
        if (!$team_data) {
            return response()->json(['code' => 404, 'message' => 'Team not found'], 404);
        }
        $team_data = json_decode($team_data, true);
        if (array_key_exists($singer_id, $team_data['votes']) && array_key_exists($guest_id, $team_data['votes'][$singer_id])) {
            return response()->json(['code' => 400, 'message' => 'Guest has already voted'], 400);
        }
        $team_data['votes'][$singer_id][$guest_id] = $team_id;
        $team_data['total_votes']++;
        Redis::set(self::PREFIX_TEAM . $team_id, json_encode($team_data));
        return response()->json(['code' => 200, 'message' => 'Vote submitted successfully']);
    }

    function collectAllVotes()
    {
        $teams = Redis::hgetall(self::KEY_TEAMS);
        $data = [];
        foreach ($teams as $id => $name) {
            $team_data = Redis::get(self::PREFIX_TEAM . $id);
            if (!$team_data) {
                continue;
            }
            $team_data = json_decode($team_data, true);
            $data[] = [
                'id' => $id,
                'name' => $name,
                'votes' => [],
                'total_votes' => '赛后公布',
            ];
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $data]);
    }
}
