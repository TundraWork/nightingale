<?php

namespace App\Http\Controllers\Guests;

use App\Http\Controllers\BasicController;
use App\Http\Requests\Guests\SubmitVote;
use Illuminate\Support\Facades\Redis;

class GuestsController extends BasicController
{
    function submitVote(SubmitVote $request)
    {
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
}
