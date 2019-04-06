<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Helpers\OSRS_stat_helper;
use App\Helpers\Common_helper;

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
        $raw_stats = OSRS_stat_helper::get_stats_raw($username);
        $stats = OSRS_stat_helper::process_stats($raw_stats);

        return response()->json([
            'username' => $username,
            'stats' => $stats
        ], 200);
    }

}
