<?php

namespace App\Http\Controllers;

use App\Helpers\OSRS_stat_helper;

class PlayerStatsController extends Controller
{
    /**
     * Get players OSRS stats
     *
     * @param String username
     * @return Json players stats
     */
    public function get_player_stats($username)
    {
        // get users stats
        $fetched_stats = OSRS_stat_helper::get_stats_raw($username);

        // catch if player doesnt exist
        if (!$fetched_stats) {
            return response()->json([
                'message' => 'Player ' . $username . ' not found.',
            ], 404);
        } else {
            //process fetched stats
            $player_stats = OSRS_stat_helper::process_stats($fetched_stats);
        }

        return response()->json([
            'username' => $username,
            'stats' => $player_stats,
        ], 200);
    }

}
