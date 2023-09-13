<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\User\iUserRepository;
use App\Repositories\User\UserRepository;
use App\Services\User\iUserService;
use App\Services\User\UserService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        app()->bind(iUserRepository::class, UserRepository::class);
        app()->bind(iUserService::class, UserService::class);
    }
}
