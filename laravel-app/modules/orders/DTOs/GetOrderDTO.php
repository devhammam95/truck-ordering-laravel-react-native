<?php

namespace Orders\DTOs;

class GetOrderDTO
{
    public function __construct(
      public int $orderId,
    ) {
    }
}
