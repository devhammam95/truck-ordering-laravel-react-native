<?php

namespace Orders\Services;

use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\UpdateOrderStatusServiceInterface;
use Orders\DTOs\UpdateOrderStatusDTO;

class UpdateOrderStatusService implements UpdateOrderStatusServiceInterface
{
    private OrderInterface $order;

    public function __construct(
        OrderInterface $orderInterface
    ) {
        $this->order = $orderInterface;
    }

    public function handle(UpdateOrderStatusDTO $updateOrderStatusDTO): void
    {
        $this->order->updateOrderStatus(
            $updateOrderStatusDTO->orderId,
            $updateOrderStatusDTO->status,
        );
    }
}
