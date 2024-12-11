<?php

namespace Orders\Services;

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\GetUserOrdersServiceInterface;

class GetUserOrdersService implements GetUserOrdersServiceInterface
{
    private OrderInterface $order;

    public function __construct(
        OrderInterface $orderInterface
    ) {
        $this->order = $orderInterface;
    }

    public function handle(): LengthAwarePaginator
    {
        return $this->order->paginateUserOrders(Auth::user()->id);
    }
}
