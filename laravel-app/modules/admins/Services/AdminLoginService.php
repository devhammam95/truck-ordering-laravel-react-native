<?php

namespace Admins\Services;

use Admins\Contracts\AdminLoginInterface;
use Admins\DTOs\AdminLoginDTO;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Users\Contracts\Services\UserLoginInterface;
use Users\DTOs\UserLoginDTO;
use Users\Models\User;

class AdminLoginService implements AdminLoginInterface
{
    public function handle(AdminLoginDTO $adminLoginDTO): ?string
    {
        $this->validateUserInputs($adminLoginDTO);
        return Auth::guard('admin')
        ->attempt(['email' => $adminLoginDTO->email, 'password' => $adminLoginDTO->password]) ?? null;
    }

    private function validateUserInputs(AdminLoginDTO $adminLoginDTO)
    {
        $validation = Validator::make(
            [
                'email' => $adminLoginDTO->email,
                'password' => $adminLoginDTO->password
            ], [
                'email' => 'required|email',
                'password' => 'required|min:8|max:33'
            ]
        );

        if ($validation->fails()) {
            throw new HttpResponseException(
                response()->json([
                    'errors' => $validation->getMessageBag(),
                ], 422)
            );
        }
    }
}