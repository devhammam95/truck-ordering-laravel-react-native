<?php

namespace Users\DTOs;

class UserRegisterDTO
{
    public function __construct(
        public ?string $name,
        public ?string $email,
        public ?string $phone,
        public ?string $password,
    ) {
    }
}
