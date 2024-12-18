<?php

namespace Orders\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewOrderCreatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public array $orderData;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(array $orderData)
    {
        $this->orderData = $orderData;
    }
}
