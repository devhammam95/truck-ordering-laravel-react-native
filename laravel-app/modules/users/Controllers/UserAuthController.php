<?php

namespace Users\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Users\Contracts\Services\UserLoginInterface;
use Users\Contracts\Services\UserLogoutInterface;
use Users\Contracts\Services\UserRegisterInterface;
use Users\DTOs\UserLoginDTO;
use Users\DTOs\UserRegisterDTO;

class UserAuthController extends Controller
{
    private UserLoginInterface $userLoginService;
    private UserRegisterInterface $userRegisterService;
    private UserLogoutInterface $userLogoutService;

    public function __construct(
        UserLoginInterface $userLogin,
        UserRegisterInterface $userRegister,
        UserLogoutInterface $userLogout
    ) {
        $this->userLoginService = $userLogin;
        $this->userRegisterService = $userRegister;
        $this->userLogoutService = $userLogout;
    }

    public function login(Request $request)
    {
        try {
            $token = $this->userLoginService->handle(
                new UserLoginDTO($request->get('email'), $request->get('password'))
            );

            if (!$token) {
                return response()->json(['error' => "User credential isn't correct, try again!"], 200);
            }
        } catch (Exception $exception) {
            Log::warning("Exception: {$exception->getMessage()}");
            return response()->json(['error' => $exception->getMessage()], 503);
        }

        return response()->json(['token' => $token], 200);
    }

    public function logout()
    {
        try {
            $this->userLogoutService->handle();
        } catch (Exception $exception) {
            Log::error("Exception: {$exception->getMessage()}");
            return response()->json(['error' => 'couldNot_Logout'], 500);
        }
        return response()->json(['message' => 'logout successfully'], 200);
    }

    public function register(Request $request)
    {
        try {
            $token = $this->userRegisterService->handle(
                new UserRegisterDTO(
                    $request->get('name'),
                    $request->get('email'),
                    $request->get('phone'),
                    $request->get('password')
                )
            );
            if (! $token) {
                return response()->json(['error' => "User data isn't correct, try again!"], 200);
            }
        } catch (Exception $exception) {
            Log::error("Exception: {$exception->getMessage()}");
            return response()->json(['error' => 'couldNot_register'], 500);
        }
        return response()->json([
            'message' => 'Register successfully',
            'token' => $token
        ], 200);
    }

    public function refreshToken()
    {
        // $token = JWTAuth::getToken();
        // if(!$token){
        //     return response()->json(['error' => 'Token not provided'], 502);
        // }
        // try{
        //     $token = JWTAuth::refresh($token);
        // }catch(TokenInvalidException $e){
        //     return response()->json(['error' => 'The token is invalid'], 501);
        // }
        return response()->json(['token' => 'sd'], 200);
    }
}
