<?php

namespace Admins\Services;

use Admins\Contracts\AdminLogoutInterface;
use Illuminate\Support\Facades\Auth;

class AdminLogoutService implements AdminLogoutInterface
{
    public function handle(): void
    {
        Auth::guard('admin')->logout();
    }
}