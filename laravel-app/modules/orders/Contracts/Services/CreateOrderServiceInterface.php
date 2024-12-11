<?php

namespace Orders\Contracts\Services;

use Orders\DTOs\CreateOrderDTO;

interface CreateOrderServiceInterface
{
    public function handle(CreateOrderDTO $createOrderDTO): void;
}
