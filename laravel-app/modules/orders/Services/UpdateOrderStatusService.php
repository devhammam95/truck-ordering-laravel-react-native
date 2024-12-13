<?php

namespace Orders\Services;

use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\GetOrderServiceInterface;
use Orders\Contracts\Services\UpdateOrderStatusServiceInterface;
use Orders\DTOs\GetOrderDTO;
use Orders\DTOs\UpdateOrderStatusDTO;

class UpdateOrderStatusService implements UpdateOrderStatusServiceInterface
{
    private OrderInterface $order;
    private GetOrderServiceInterface $getOrderService;


    public function __construct(
        OrderInterface $orderInterface,
        GetOrderServiceInterface $getOrderService
    ) {
        $this->order = $orderInterface;
        $this->getOrderService = $getOrderService;
    }

    public function handle(UpdateOrderStatusDTO $updateOrderStatusDTO): void
    {
        $order = $this->getOrderService->handle(new GetOrderDTO($updateOrderStatusDTO->orderId));

        $newOrderStatus = $order->status == 'pending' ? 'inprogress' : 'delivered';

        $this->order->updateOrderStatus(
            $updateOrderStatusDTO->orderId,
            $newOrderStatus,
        );
    }
}
