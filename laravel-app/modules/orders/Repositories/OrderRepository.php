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

    public function paginateUserOrders(int $userId)
    {
        return $this->model->where('user_id', $userId)
        ->with('user:id,name')
        ->orderBy('id', 'DESC')
            ->paginate();
    }


    public function paginateAllOrders()
    {
        return $this->model
        ->with('user:id,name')
        ->orderBy('id', 'DESC')
        ->paginate();
    }

    public function find(int $orderId)
    {
        return $this->model->with('user:id,name,email,phone')
            ->findOrFail($orderId);
    }


    public function create(array $orderData)
    {
        return $this->model->create($orderData);
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
