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
    private AdminLoginInterface $adminLoginService;
    private AdminLogoutInterface $adminLogoutService;

    public function __construct(
        AdminLoginInterface $adminLogin,
        AdminLogoutInterface $adminLogout
    ) {
        $this->adminLoginService = $adminLogin;
        $this->adminLogoutService = $adminLogout;
    }

    public function getLoginPage()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
    {
        try {
            $token = $this->adminLoginService->handle(
                new AdminLoginDTO($request->get('email'), $request->get('password'))
            );

            if (!$token) {
                return response()->json(['error' => "admin credential isn't correct, try again!"], 200);
            }
        }catch (Exception $exception) {
            Log::error("Exception: {$exception->getMessage()}");
            return response()->json(['error' => $exception->getMessage()], 500);
        }

        return response()->json(['token' => $token], 200);
    }

    public function logout()
    {
        try {
            $this->adminLogoutService->handle();
        } catch (Exception $exception) {
            Log::error("Exception: {$exception->getMessage()}");
            return response()->json(['error' => 'couldNot_Logout'], 500);
        }
        return response()->json(['message' => 'logout successfully'], 200);
    }
}
