<?php

namespace Orders\Listeners;

use Admins\Models\Admin;
use Orders\Notifications\NewShippingOrderCreatedNotification;

class NewOrderCreatedListener
{

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        Admin::first()->notify(
            new NewShippingOrderCreatedNotification($event->orderData['user_id'])
        );
    }

}
