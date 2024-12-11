<?php

namespace Users\Services;


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Users\Contracts\Services\UserLoginInterface;
use Users\DTOs\UserLoginDTO;
use Users\Models\User;

class UserLoginService implements UserLoginInterface
{
    public function handle(UserLoginDTO $userLoginDTO): ?string
    {
        $this->validateUserInputs($userLoginDTO);

        $user = User::where('email', $userLoginDTO->email)->first();
 
        if (! $user || ! Hash::check($userLoginDTO->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The credentials isn\'t correct.'],
            ]);
        }

        return $user->createToken("API TOKEN")->plainTextToken;
    }

    private function validateUserInputs(UserLoginDTO $userLoginDTO)
    {
        $validation = Validator::make(
            [
                'email' => $userLoginDTO->email,
                'password' => $userLoginDTO->password
            ], [
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8|max:33'
            ]
        );

        if ($validation->fails()) {
            throw ValidationException::withMessages(['error_msg' => 'The credentials isn\'t correct.']);
        }
    }
}
