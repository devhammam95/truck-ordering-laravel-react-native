<?php

namespace Orders\Contracts\Services;

use Orders\Models\ShippingOrder;
use Orders\DTOs\GetOrderDTO;

interface GetOrderServiceInterface
{
    public function handle(GetOrderDTO $getOrderDTO): ?ShippingOrder;
}
