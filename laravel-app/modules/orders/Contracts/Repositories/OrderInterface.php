<?php

namespace Orders\Contracts\Repositories;

interface OrderInterface
{
    public function paginateUserOrders(int $userId);

    public function paginateAllOrders();


    public function find(int $orderId);

    public function create(array $orderData);

    public function updateOrderStatus(int $orderId, string $orderStatus);
}
