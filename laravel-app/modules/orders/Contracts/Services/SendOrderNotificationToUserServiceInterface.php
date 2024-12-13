<?php

namespace Orders\Contracts\Services;

use Orders\DTOs\SendOrderNotificationToUserDTO;

interface SendOrderNotificationToUserServiceInterface
{
    public function handle(SendOrderNotificationToUserDTO $sendOrderNotificationToUserDTO);
}
