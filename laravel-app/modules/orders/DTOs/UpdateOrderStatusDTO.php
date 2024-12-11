<?php

namespace Orders\DTOs;

class UpdateOrderStatusDTO
{
    public function __construct(
        public int $orderId,
        public string $status,
    ) {
    }
}
