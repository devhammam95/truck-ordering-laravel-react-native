<?php

namespace Orders\Providers;

use Illuminate\Support\ServiceProvider;
use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\GetAllOrdersServiceInterface;
use Orders\Services\GetAllOrdersService;
use Orders\Contracts\Services\CreateOrderServiceInterface;
use Orders\Services\CreateOrderService;
use Orders\Repositories\OrderRepository;

class OrderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(OrderInterface::class, OrderRepository::class);
        $this->app->bind(CreateOrderServiceInterface::class, CreateOrderService::class);
        $this->app->bind(GetAllOrdersServiceInterface::class, GetAllOrdersService::class);
    }
}
