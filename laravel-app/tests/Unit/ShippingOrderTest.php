<?php

namespace Tests\Unit;

use Carbon\Carbon;
use Customers\Models\Customer;
use Faker\Generator;
use Illuminate\Container\Container;
use Illuminate\Support\Facades\App;
use Orders\Contracts\Services\CreateOrderServiceInterface;
use Orders\Contracts\Services\GetOrderServiceInterface;
use Orders\Contracts\Services\UpdateOrderStatusServiceInterface;
use Orders\DTOs\CreateOrderDTO;
use Orders\DTOs\GetOrderDTO;
use Orders\DTOs\UpdateOrderStatusDTO;
use Orders\Models\ShippingOrder;
use Tests\TestCase;
use Users\Models\User;

class ShippingOrderTest extends TestCase
{
    private $faker;
    private User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Container::getInstance()->make(Generator::class);
        $this->user = User::factory()->create();
    }
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_create_order(): void
    {
        $createOrderService = App::make(CreateOrderServiceInterface::class);
        $createOrderService->handle(
            new CreateOrderDTO(
                $this->user->id,
                $this->faker->address,
                $this->faker->numberBetween(1,300),
                $this->faker->numberBetween(1,300),
                'delivery',
                Carbon::now()->format('Y-m-d\TH:i:s.u\Z')
            )
        );

        $this->assertDatabaseHas('shipping_orders', [
            'user_id' => $this->user->id,
        ]);
    }

    public function test_update_order_status(): void
    {
        $createOrderService = App::make(CreateOrderServiceInterface::class);
        $createOrderService->handle(
            new CreateOrderDTO(
                $this->user->id,
                $this->faker->address,
                $this->faker->numberBetween(1,300),
                $this->faker->numberBetween(1,300),
                'delivery',
                Carbon::now()->format('Y-m-d\TH:i:s.u\Z')
            )
        );


        $order = ShippingOrder::latest()->first();

        $deletePurchase = App::make(UpdateOrderStatusServiceInterface::class);
        $deletePurchase->handle(new UpdateOrderStatusDTO($order->id));
        $this->assertDatabaseHas('shipping_orders', ['id' => $order->id, 'status' => 'inprogress']);
    }
}