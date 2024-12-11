<?php

namespace Orders\Contracts\Services;

use Orders\DTOs\UpdateOrderStatusDTO;

interface UpdateOrderStatusServiceInterface
{
    public function handle(UpdateOrderStatusDTO $updateOrderStatusDTO);
}
