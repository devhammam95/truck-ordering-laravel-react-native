<?php

namespace Users\Services;

use Illuminate\Support\Facades\Auth;
use Users\Contracts\Services\UserLogoutInterface;

class UserLogoutService implements UserLogoutInterface
{
    public function handle(): void
    {
        Auth::guard('user')->user()->tokens()->delete();;
    }
}
