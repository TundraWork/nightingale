<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Common\AddSingers;
use App\Http\Requests\Common\AddSongs;
use App\Http\Requests\Common\ClearSingers;
use App\Http\Requests\Common\ClearSongs;
use App\Http\Requests\Common\GetCurrentSong;
use App\Http\Requests\Common\GetSingers;
use App\Http\Requests\Common\GetCurrentSinger;
use App\Http\Requests\Common\GetSongs;
use App\Http\Requests\Common\SetCurrentSinger;
use App\Http\Requests\Common\SetCurrentSong;
use Illuminate\Support\Facades\Redis;

class CommonController extends BasicController
{

    function clearSingers(ClearSingers $request)
    {
        if (count($request->input('ids'))) {
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
            $id = uniqid();
            Redis::hset(self::KEY_SINGERS, $id, $name);
            $singer_data = [
                'name' => $name,
                'songs' => [],
            ];
            Redis::set(self::PREFIX_SINGER . $id, json_encode($singer_data));
            $data[] = ['id' => $id, 'name' => $name];
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $data]);
    }

    function getSingers(GetSingers $request)
    {
        $singers = Redis::hgetall(self::KEY_SINGERS);
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $singers]);
    }

    function setCurrentSinger(SetCurrentSinger $request)
    {
        $id = $request->input('id');
        if (!Redis::hexists(self::KEY_SINGERS, $id)) {
            return response()->json(['code' => 400, 'message' => 'Singer not found'], 400);
        }
        Redis::set(self::KEY_CURRENT_SINGER, $id);
        return response()->json(['code' => 200, 'message' => 'Current singer set successfully']);
    }

    function getCurrentSinger(GetCurrentSinger $request)
    {
        $id = Redis::get(self::KEY_CURRENT_SINGER);
        if (!$id) {
            return response()->json(['code' => 404, 'message' => 'No current singer set'], 404);
        }
        $name = Redis::hget(self::KEY_SINGERS, $id);
        if (!$name) {
            return response()->json(['code' => 500, 'message' => 'Singer not found'], 500);
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => ['id' => $id, 'name' => $name]]);
    }

    function clearSongs(ClearSongs $request)
    {
        if (count($request->input('ids'))) {
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
            $id = uniqid();
            Redis::hset(self::KEY_SONGS, $id, $name);
            $data[] = ['id' => $id, 'name' => $name];
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $data]);
    }

    function getSongs(GetSongs $request)
    {
        $songs = Redis::hgetall(self::KEY_SONGS);
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $songs]);
    }

    function setCurrentSong(SetCurrentSong $request)
    {
        $id = $request->input('id');
        if (!Redis::hexists(self::KEY_SONGS, $id)) {
            return response()->json(['code' => 400, 'message' => 'Song not found'], 400);
        }
        Redis::set(self::KEY_CURRENT_SONG, $id);
        return response()->json(['code' => 200, 'message' => 'Current song set successfully']);
    }

    function getCurrentSong(GetCurrentSong $request)
    {
        $id = Redis::get(self::KEY_CURRENT_SONG);
        if (!$id) {
            return response()->json(['code' => 404, 'message' => 'No current song set'], 404);
        }
        $name = Redis::hget(self::KEY_SONGS, $id);
        if (!$name) {
            return response()->json(['code' => 500, 'message' => 'Song not found'], 500);
        }
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => ['id' => $id, 'name' => $name]]);
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

    function getTeams(GetSongs $request)
    {
        $teams = Redis::hgetall(self::KEY_TEAMS);
        return response()->json(['code' => 200, 'message' => 'OK', 'data' => $teams]);
    }
}
