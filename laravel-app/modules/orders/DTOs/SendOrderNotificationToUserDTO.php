<?php

namespace Orders\DTOs;

class SendOrderNotificationToUserDTO
{
    public function __construct(
        public int $orderId,
        public string $notificationType,
        public string $msgContent
    ) {
    }
}
