<?php

namespace Admins\Contracts;

use Admins\DTOs\AdminLoginDTO;

interface AdminLoginInterface
{
    public function handle(AdminLoginDTO $userLoginDTO): ?string;
}