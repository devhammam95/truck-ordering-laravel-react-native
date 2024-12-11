<?php

namespace Orders\Services;

use App\Models\ShippingOrder;
use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\GetOrderServiceInterface;
use Orders\DTOs\GetOrderDTO;

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
