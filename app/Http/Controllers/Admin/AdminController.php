<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Admin\CollectScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class AdminController extends BasicController
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
}
