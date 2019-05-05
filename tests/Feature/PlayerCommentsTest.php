<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PlayerCommentsTest extends TestCase
{
    /**
     * @test
     * Checks comments can be posted
     * 
     * @return void
     */
    public function comments_can_be_posted()
    {
        // setup
        $body = [
            'account_name' => 'Krun64',
            'body' => 'This is the comment body'
        ];
        $headers = ['Accept' => 'application/json'];
        $response = $this->post('/api/playerComments', $body, $headers);

        // test
        $response
            ->assertStatus(201)
            ->assertJson([
                'message' => 'Comment posted',
            ]);
    }

    /**
     * @test
     * Checks comments can be fetched
     * 
     * @return void
     */
    public function comments_can_be_fetched()
    {
        $this->comments_can_be_posted(); // comment #1

        $response = $this->get('/api/playerStats/krun64');

        // test
        $response
            ->assertOk()
            ->assertJson([
                'comments' => [],
            ]);
    }

    /**
     * @test
     * Checks comments can be deleted
     * 
     * @return void
     */
    public function comments_can_be_deleted()
    {
        // setup
        $this->comments_can_be_posted(); // comment #1

        $headers = ['Accept' => 'application/json'];
        $response = $this->delete('/api/playerComments/1', $headers);
        
        // test
        $response
            ->assertStatus(200)
            ->assertJson([
                'message' => 'Comment deleted',
            ]);
    }
}
