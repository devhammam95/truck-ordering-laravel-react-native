<?php

namespace Orders\DTOs;

class CreateOrderDTO
{
    public function __construct(
       public int $userId,
        public array $order
    ) {
    }
}
