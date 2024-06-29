<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Common\AddSingers;
use App\Http\Requests\Common\AddSongs;
use App\Http\Requests\Common\ClearSingers;
use App\Http\Requests\Common\ClearSongs;
use Illuminate\Support\Facades\Redis;

class CommonController extends BasicController
{

    function clearSingers(ClearSingers $request)
    {
        if ($request->has('ids') && count($request->input('ids'))) {
            foreach ($request->input('ids') as $id) {
                if (!Redis::hexists(self::KEY_SINGERS, $id)) {
                    return response()->json(['code' => 400, 'message' => 'Singer not found'], 400);
                }
                Redis::del(self::PREFIX_SINGER . $id);
                Redis::hdel(self::KEY_SINGERS, $id);
            }
        } else {
            foreach (Redis::hkeys(self::KEY_SINGERS) as $id) {
                Redis::del(self::PREFIX_SINGER . $id);
            }
            Redis::del(self::KEY_SINGERS);
        }
        return response()->json(['code' => 200, 'message' => 'OK']);
    }

    function addSingers(AddSingers $request)
    {
        $names = $request->input('names');
        $data = [];
        foreach ($names as $name) {
            if (!empty($name)) {
                $id = uniqid();
                Redis::hset(self::KEY_SINGERS, $id, $name);
                $singer_data = [
                    'name' => $name,
                    'songs' => [],
                ];
                Redis::set(self::PREFIX_SINGER . $id, json_encode($singer_data));
                $data[$id] = $name;
            }
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $data]);
    }

    function getSingers()
    {
        $singers = Redis::hgetall(self::KEY_SINGERS);
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $singers]);
    }

    function clearSongs(ClearSongs $request)
    {
        if ($request->has('ids') && count($request->input('ids'))) {
            foreach ($request->input('ids') as $id) {
                if (!Redis::hexists(self::KEY_SONGS, $id)) {
                    return response()->json(['code' => 400, 'message' => 'Song not found'], 400);
                }
                Redis::del(self::PREFIX_SONG . $id);
                Redis::hdel(self::KEY_SONGS, $id);
            }
        } else {
            foreach (Redis::hkeys(self::KEY_SONGS) as $id) {
                Redis::del(self::PREFIX_SONG . $id);
            }
            Redis::del(self::KEY_SONGS);
        }
        return response()->json(['code' => 200, 'message' => 'OK']);
    }

    function addSongs(AddSongs $request)
    {
        $names = $request->input('names');
        $data = [];
        foreach ($names as $name) {
            if (!empty($name)) {
                $id = uniqid();
                Redis::hset(self::KEY_SONGS, $id, $name);
                $data[$id] = $name;
            }
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $data]);
    }

    function getSongs()
    {
        $songs = Redis::hgetall(self::KEY_SONGS);
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $songs]);
    }

    function clearTeams()
    {
        foreach (Redis::hkeys(self::KEY_TEAMS) as $id) {
            Redis::del(self::PREFIX_TEAM . $id);
        }
        Redis::del(self::KEY_TEAMS);
        return response()->json(['code' => 200, 'message' => 'OK']);
    }

    function addTeams(AddSongs $request)
    {
        $names = $request->input('names');
        $data = [];
        foreach ($names as $name) {
            $id = uniqid();
            Redis::hset(self::KEY_TEAMS, $id, $name);
            $team_data = [
                'name' => $name,
                'votes' => [],
                'total_votes' => 0,
            ];
            Redis::set(self::PREFIX_TEAM . $id, json_encode($team_data));
            $data[] = ['id' => $id, 'name' => $name];
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $data]);
    }

    function getTeams()
    {
        $teams = Redis::hgetall(self::KEY_TEAMS);
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $teams]);
    }

    function getCurrentStatus()
    {
        $current_status = Redis::get(self::KEY_CURRENT_STATUS);
        if (!$current_status) {
            return response()->json(['code' => 404, 'message' => 'Current status not exist'], 404);
        }
        $current_status = json_decode($current_status, true);
        if (!empty($current_status['singer_id'])) {
            if (!Redis::hexists(self::KEY_SINGERS, $current_status['singer_id'])) {
                return response()->json(['code' => 404, 'message' => 'Singer not found'], 404);
            } else {
                $current_status['singer'] = Redis::hget(self::KEY_SINGERS, $current_status['singer_id']);
            }
        } else {
            $current_status['singer'] = null;
        }
        if (!empty($current_status['song_id'])) {
            if (!Redis::hexists(self::KEY_SONGS, $current_status['song_id'])) {
                return response()->json(['code' => 404, 'message' => 'Song not found'], 404);
            } else {
                $current_status['song'] = Redis::hget(self::KEY_SONGS, $current_status['song_id']);
            }
        } else {
            $current_status['song'] = null;
        }
        if (!empty($current_status['team_id'])) {
            if (!Redis::hexists(self::KEY_TEAMS, $current_status['team_id'])) {
                return response()->json(['code' => 404, 'message' => 'Team not found'], 404);
            } else {
                $current_status['team'] = Redis::hget(self::KEY_TEAMS, $current_status['team_id']);
            }
        } else {
            $current_status['team'] = null;
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $current_status]);
    }
}
