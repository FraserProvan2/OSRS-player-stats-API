<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OSRS_stat_helper;

class PlayerStatsController extends Controller
{
    public function get_player_stats($username)
    {
        OSRS_stat_helper::test_help();
        // return $username;
    }
}
