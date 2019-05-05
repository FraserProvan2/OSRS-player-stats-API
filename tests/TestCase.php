<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Laravel\Passport\Passport;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Mock authentication for testing
     *
     * @return Object authenticated user
     */
    public function mock_auth()
    {
        return Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );
    }
}
