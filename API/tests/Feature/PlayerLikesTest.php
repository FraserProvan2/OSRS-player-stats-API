<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class PlayerLikesTest extends TestCase
{
    /**
     * @test
     * Checkers a user can like/unlike an account
     * GET/POST playerLikes
     *
     * @return void
     */
    public function check_playerLikes_requests()
    {
        // setup
        $this->mock_auth();

        // tests
        $this->like_account(); // POST
        $this->check_account_is_liked(); // GET
        $this->dislike_account(); // POST
        $this->check_account_is_disliked(); // GET
    }

    /**
     * Checks account can be liked
     *
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
     * Checks account can be unliked
     *
     */
    public function dislike_account()
    {
        // setup
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
     * Checks account is liked when checked (via api get request)
     *
     */
    public function check_account_is_liked()
    {
        // setup
        $response = $this->get('/api/playerLikes/Krun64');

        // test
        $response
            ->assertOk()
            ->assertJson([
                'liked' => true,
            ]);
    }

    /**
     * Checks account is unliked when checked (via api get request)
     *
     */
    public function check_account_is_disliked()
    {
        // set up
        $response = $this->get('/api/playerLikes/Krun64');

        // test
        $response
            ->assertOk()
            ->assertJson([
                'liked' => false,
            ]);
    }

}
