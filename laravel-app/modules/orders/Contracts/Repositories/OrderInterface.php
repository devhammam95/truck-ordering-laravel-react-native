<?php

namespace Orders\Contracts\Repositories;

interface OrderInterface
{
    public function paginate();

    public function find(int $orderId);

    public function create(int $userId, $orderDTO);

    public function updateOrderStatus(int $orderId, string $orderStatus);
}
