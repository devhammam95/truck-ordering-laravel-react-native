<?php

namespace Users\Services;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Users\Contracts\Services\UserRegisterInterface;
use Users\DTOs\UserRegisterDTO;
use Users\Models\User;

class UserRegisterService implements UserRegisterInterface
{
    public function handle(UserRegisterDTO $userRegisterDTO): ?string
    {
        $this->validateUserInputs($userRegisterDTO);

        $user = User::create([
            'name' => $userRegisterDTO->name,
            'email' => $userRegisterDTO->email,
            'phone' => $userRegisterDTO->phone,
            'password' => Hash::make($userRegisterDTO->password),
        ]);

        return $user->createToken("API TOKEN")->plainTextToken;
    }

    private function validateUserInputs(UserRegisterDTO $userRegisterDTO)
    {
        $validation = Validator::make(
            [
                'name' => $userRegisterDTO->name,
                'phone' => $userRegisterDTO->phone,
                'email' => $userRegisterDTO->email,
                'password' => $userRegisterDTO->password
            ], [
                'name' => 'required|string|min:3|max:33',
                'phone' => 'required|string|unique:users,phone',
                'email' => 'required|email|unique:users,email',
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
