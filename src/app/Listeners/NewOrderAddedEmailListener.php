<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use App\Jobs\SendNewOrderEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NewOrderAddedEmailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(NewOrderEvent $event): void
    {
        SendNewOrderEmail::dispatch($event->order);
    }
}
