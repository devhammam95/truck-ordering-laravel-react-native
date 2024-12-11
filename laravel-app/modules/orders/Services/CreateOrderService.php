<?php

namespace Orders\Services;

use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\CreateOrderServiceInterface;
use Orders\DTOs\CreateOrderDTO;
use Orders\Events\NewOrderCreated;

class CreateOrderService implements CreateOrderServiceInterface
{
    private OrderInterface $order;

    public function __construct(
         OrderInterface $orderRepository,
    ) {
        $this->order = $orderRepository;
    }

    public function handle(CreateOrderDTO $createOrderDTO): void
    {
        event(new NewOrderCreated([]));
    }
}
