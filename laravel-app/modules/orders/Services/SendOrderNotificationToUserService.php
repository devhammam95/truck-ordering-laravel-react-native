<?php

namespace Orders\Services;

use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\GetOrderServiceInterface;
use Orders\Contracts\Services\SendOrderNotificationToUserServiceInterface;
use Orders\DTOs\GetOrderDTO;
use Orders\DTOs\SendOrderNotificationToUserDTO;
use Orders\DTOs\UpdateOrderStatusDTO;
use Orders\Notifications\SendOrderToUserNotification;
use Users\Models\User;

class SendOrderNotificationToUserService implements SendOrderNotificationToUserServiceInterface
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

    public function handle(SendOrderNotificationToUserDTO $sendOrderNotificationToUserDTO): void
    {
        $order = $this->getOrderService->handle(
            new GetOrderDTO($sendOrderNotificationToUserDTO->orderId)
        );

        User::where('id', $order->user->id)
        ->first()
        ->notify(
            new SendOrderToUserNotification(
                $order->user->id,
                $sendOrderNotificationToUserDTO->msgContent,
                $sendOrderNotificationToUserDTO->notificationType
            )
        );

    }
}
