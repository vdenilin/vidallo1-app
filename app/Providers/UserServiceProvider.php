<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\UserService;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(UserService::class, function ($app){
            $users = [
                [
                    'name' => 'Jan Dave Vidallo',
                    'gender' => 'Male'
                ],
                [
                    'name' => 'Denilin Vidallo',
                    'gender' => 'Female'
                ]
                ];

                return new UserService($users);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}