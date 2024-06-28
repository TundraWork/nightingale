<?php

namespace App\Http\Controllers\Judges;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Judges\SubmitScore;
use Illuminate\Support\Facades\Redis;

class JudgesController extends BasicController
{
    function submitScore(SubmitScore $request)
    {
        $judge_name = $request->input('judge');
        $singer_id = $request->input('singer_id');
        $song_id = $request->input('song_id');
        $scores = $request->input('scores');
        $singer_data = Redis::get(self::PREFIX_SINGER . $singer_id);
        if (!$singer_data) {
            return response()->json(['code' => 404, 'message' => 'Singer not found'], 404);
        }
        $singer_data = json_decode($singer_data, true);
        if (!Redis::hexists(self::KEY_SONGS, $song_id)) {
            return response()->json(['code' => 404, 'message' => 'Song not found'], 404);
        }
        $song_index = 0;
        foreach ($singer_data['songs'] as $song_index => $song) {
            if ($song['song'] == $song_id) {
                $song_data = $song;
                break;
            }
        }
        if (!isset($song_data)) {
            $song_index += 1;
            $song_data = [
                'song' => $song_id,
                'scores' => [],
                'final_score' => 0,
            ];
        }
        $score_index = 0;
        foreach ($song_data['scores'] as $score_index => $judge_score) {
            if ($judge_score['judge'] == $judge_name) {
                $score_index -= 1; // overwrite the existing score
                break;
            }
        }
        $score_index += 1;
        $items_data = [];
        foreach ($scores as $key => $value) {
            $items_data[] = ['item' => $key, 'score' => $value];
        }
        $scores_data = [
            'judge' => $judge_name,
            'data' => $items_data,
            'total_score' => 0,
        ];
        $song_data['scores'][$score_index] = $scores_data;
        $song_data = $this->calculateTotalScore($song_data);
        $singer_data['songs'][$song_index] = $song_data;
        Redis::set(self::PREFIX_SINGER . $singer_id, json_encode($singer_data));
        return response()->json(['code' => 200, 'message' => 'Score submitted successfully']);
    }
}
