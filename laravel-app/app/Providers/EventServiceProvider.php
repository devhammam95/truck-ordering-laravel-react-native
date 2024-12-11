<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Orders\Events\NewOrderCreatedEvent;
use Orders\Listeners\NewOrderCreatedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Event::listen(NewOrderCreatedEvent::class, NewOrderCreatedListener::class);
    }
}
