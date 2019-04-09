<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlayerStatsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * makes sure stats are fetched
     *
     * @return void
     */
    public function check_player_stats_fetched()
    {
        // setup
        $response = $this->get('/api/playerStats/krun64');

        // test
        $response
            ->assertOk()
            ->assertJson([
                'username' => 'krun64',
                'stats' => [],
            ]);
    }

    /**
     * @test
     * check for correct error code when no player found
     *
     * @return void
     */
    public function check_player_stats_for_no_player()
    {
        // setup
        $response = $this->get('/api/playerStats/thisisnotauser');

        // test
        $response
            ->assertStatus(404)
            ->assertJson([
                'message' => 'Player thisisnotauser not found.',
            ]);
    }

}
