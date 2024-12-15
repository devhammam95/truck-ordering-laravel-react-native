<?php

namespace Orders\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
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
            'deliver_pickup_type' => $createOrderDTO->deliverPickupType,
            'delivery_pickup_date_time' => 
            Carbon::createFromFormat('Y-m-d\TH:i:s.u\Z', $createOrderDTO->deliverPickupDateTime)
            ->format('Y-m-d H:i:s'),
        ]);

        event(new NewOrderCreatedEvent([
            'user_id' => $createOrderDTO->userId,
        ]));
    }
}
