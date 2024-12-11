<?php

namespace Orders\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\GetAllOrdersServiceInterface;

class GetAllOrdersService implements GetAllOrdersServiceInterface
{
    private OrderInterface $order;

    public function __construct(
        OrderInterface $orderInterface
    ) {
        $this->order = $orderInterface;
    }

    public function handle(): LengthAwarePaginator
    {
        return $this->order->paginate();
    }
}
