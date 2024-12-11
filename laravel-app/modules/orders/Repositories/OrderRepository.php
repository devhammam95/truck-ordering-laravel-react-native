<?php

namespace Orders\Repositories;

use Illuminate\Database\Eloquent\Model;
use Orders\Models\ShippingOrder;
use Orders\Contracts\Repositories\OrderInterface;

class OrderRepository implements OrderInterface
{
    private Model $model;

    public function __construct(ShippingOrder $order)
    {
        $this->model = $order;
    }


    public function paginate()
    {
        return $this->model->with('user:id,name')
            ->paginate();
    }

    public function find(int $orderId)
    {
        return $this->model->with('user:id,name,email,phone')
            ->findOrFail($orderId);
    }


    public function create(int $userId, $orderDTO)
    {
        return $this->model->create(
            [
            ]
        );
    }

    public function updateOrderStatus(int $orderId, string $orderStatus)
    {
        return $this->model->where('id', $orderId)
            ->update(
                [
                    'status' => $orderStatus,
                ]
            );
    }
}
