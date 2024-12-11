<?php

namespace Users\Contracts\Services;

use Users\DTOs\UserLoginDTO;

interface UserLoginInterface
{
    public function handle(UserLoginDTO $userLoginDTO): ?string;
}
