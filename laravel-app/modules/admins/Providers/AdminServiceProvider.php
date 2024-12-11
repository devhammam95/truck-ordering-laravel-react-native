<?php

namespace Admins\Providers;

use Admins\Contracts\AdminLoginInterface;
use Admins\Contracts\AdminLogoutInterface;
use Admins\Services\AdminLoginService;
use Admins\Services\AdminLogoutService;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(AdminLoginInterface::class, AdminLoginService::class);
        $this->app->bind(AdminLogoutInterface::class, AdminLogoutService::class);
    }
}
