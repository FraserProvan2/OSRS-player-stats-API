<?php

namespace Tests\Feature;

use App\Like;
use Tests\TestCase;

class PlayerLikesTest extends TestCase
{
    /**
     * @test
     * Checks account can be liked
     *
     * @return void
     */
    public function like_account()
    {
        // setup
        $body = ['account_name' => 'Krun64'];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/playerLikes', $body, $headers);

        // test
        $response
            ->assertOk()
            ->assertJson([
                'message' => 'Player liked',
            ]);
    }

    /**
     * @test
     * Checks account is liked when checked (via api get request)
     *
     * @return void
     */
    public function check_account_is_liked()
    {
        // setup
        $this->like_account();

        $response = $this->get('/api/playerLikes/Krun64');

        // test
        $response
            ->assertOk()
            ->assertJson([
                'liked' => true,
            ]);
    }

    /**
     * @test
     * Checks account can be unliked
     *
     * @return void
     */
    public function unlike_account()
    {
        // setup
        $this->like_account();

        $body = ['account_name' => 'Krun64'];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/playerLikes', $body, $headers);

        // test
        $response
            ->assertOk()
            ->assertJson([
                'message' => 'Player unliked',
            ]);
    }

    /**
     * @test
     * Checks account is unliked when checked (via api get request)
     *
     * @return void
     */
    public function check_account_is_unliked()
    {
        // set up
        $this->unlike_account();

        $response = $this->get('/api/playerLikes/Krun64');

        // test
        $response
            ->assertOk()
            ->assertJson([
                'liked' => false,
            ]);
    }

}
