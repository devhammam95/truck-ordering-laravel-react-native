<?php

namespace Users\DTOs;

class UserLoginDTO
{
    public function __construct(
        public ?string $email,
        public ?string $password,
    ) {
    }
}
