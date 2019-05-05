<?php

namespace Tests;

use App\User;
use Illuminate\Contracts\Console\Kernel;
use Laravel\Passport\Passport;

trait CreatesApplication
{
    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        // custom setup
        \Artisan::call('migrate', ['-vvv' => true]);
        // \Artisan::call('passport:install',['-vvv' => true]);
        // \Artisan::call('db:seed',['-vvv' => true]);
        Passport::actingAs(factory(User::class)->create(),['create-servers']);

        return $app;
    }
}
