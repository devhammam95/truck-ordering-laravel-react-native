<?php

namespace Admins\Controllers;


use App\Http\Controllers\Controller;

class AdminDashboardController extends Controller
{
    public function getAdminDashboardPage()
    {
        return view('admin.dashboard.index');
    }
}
