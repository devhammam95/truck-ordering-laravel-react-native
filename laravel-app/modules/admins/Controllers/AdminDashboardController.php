<?php

namespace Admins\Controllers;

use Admins\Contracts\AdminLoginInterface;
use Admins\Contracts\AdminLogoutInterface;
use Admins\DTOs\AdminLoginDTO;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Log;

class AdminAuthController extends Controller
{
    public function getAdminDashboardPage()
    {
        return view('admin.dashboard.index');
    }
}
