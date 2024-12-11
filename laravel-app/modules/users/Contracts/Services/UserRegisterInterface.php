<?php

namespace Users\Contracts\Services;

use Users\DTOs\UserRegisterDTO;

interface UserRegisterInterface
{
    public function handle(UserRegisterDTO $userRegisterDTO): ?string;
}
