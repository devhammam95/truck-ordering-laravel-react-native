<?php

namespace Admins\DTOs;

class AdminLoginDTO
{
    public function __construct(
        public ?string $email,
        public ?string $password,
    ) {
    }
}