<?php

namespace Users\Providers;

use Illuminate\Support\ServiceProvider;
use Users\Contracts\Services\UserLoginInterface;
use Users\Contracts\Services\UserLogoutInterface;
use Users\Contracts\Services\UserRegisterInterface;
use Users\Services\UserLoginService;
use Users\Services\UserLogoutService;
use Users\Services\UserRegisterService;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(UserLoginInterface::class, UserLoginService::class);
        $this->app->bind(UserRegisterInterface::class, UserRegisterService::class);
        $this->app->bind(UserLogoutInterface::class, UserLogoutService::class);
    }
}
