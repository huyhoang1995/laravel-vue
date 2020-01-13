<?php

namespace App\Listeners;

use App\Events\DiscountEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailDiscountEvent implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DiscountEvent  $event
     * @return void
     */
    public function handle(DiscountEvent $event)
    {
        //
    }
}
