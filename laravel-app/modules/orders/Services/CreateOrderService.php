<?php

namespace Orders\Services;

use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\CreateOrderServiceInterface;
use Orders\DTOs\CreateOrderDTO;
use Orders\Events\NewOrderCreatedEvent;

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
        $this->order->create([
            'user_id' => $createOrderDTO->userId,
            'location' => $createOrderDTO->location,
            'size' => $createOrderDTO->size,
            'weight' => $createOrderDTO->weight,

        ]);
        event(new NewOrderCreatedEvent([
            'user_id' => $createOrderDTO->userId,
        ]));
    }
}
