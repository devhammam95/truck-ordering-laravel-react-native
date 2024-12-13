<?php

namespace Orders\Providers;

use Illuminate\Support\ServiceProvider;
use Orders\Contracts\Repositories\OrderInterface;
use Orders\Contracts\Services\GetAllOrdersServiceInterface;
use Orders\Services\GetAllOrdersService;
use Orders\Contracts\Services\CreateOrderServiceInterface;
use Orders\Contracts\Services\GetOrderServiceInterface;
use Orders\Contracts\Services\GetUserOrdersServiceInterface;
use Orders\Contracts\Services\SendOrderNotificationToUserServiceInterface;
use Orders\Contracts\Services\Sms\SmsMessageProviderInterface;
use Orders\Contracts\Services\UpdateOrderStatusServiceInterface;
use Orders\Services\CreateOrderService;
use Orders\Repositories\OrderRepository;
use Orders\Services\GetOrderService;
use Orders\Services\GetUserOrdersService;
use Orders\Services\SendOrderNotificationToUserService;
use Orders\Services\UpdateOrderStatusService;
use Orders\Services\Sms\STCSmsMessage;

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
        $this->app->bind(GetOrderServiceInterface::class, GetOrderService::class);
        $this->app->bind(GetAllOrdersServiceInterface::class, GetAllOrdersService::class);
        $this->app->bind(GetUserOrdersServiceInterface::class, GetUserOrdersService::class);
        $this->app->bind(UpdateOrderStatusServiceInterface::class, UpdateOrderStatusService::class);
        $this->app->bind(SendOrderNotificationToUserServiceInterface::class, SendOrderNotificationToUserService::class);
        $this->app->bind(SmsMessageProviderInterface::class, STCSmsMessage::class);
    }
}
