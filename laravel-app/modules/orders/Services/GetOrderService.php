<?php

namespace Orders\Services;

use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\GetOrderServiceInterface;
use Orders\DTOs\GetOrderDTO;
use Orders\Models\ShippingOrder;

class GetOrderService implements GetOrderServiceInterface
{
    private OrderInterface $order;

    public function __construct(
        OrderInterface $orderRepository
    ) {
        $this->order = $orderRepository;
    }

    public function handle(GetOrderDTO $getOrderDTO): ?ShippingOrder
    {
        return $this->order->find($getOrderDTO->orderId);
    }
}
