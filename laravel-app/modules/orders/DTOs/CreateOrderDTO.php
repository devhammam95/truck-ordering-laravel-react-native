<?php

namespace Orders\DTOs;

class CreateOrderDTO
{
    public function __construct(
       public int $userId,
        public string $location,
        public int $size,
        public int $weight,
        public string $deliverPickupType,
        public string $deliverPickupDateTime,
    ) {
    }
}
