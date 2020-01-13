<?php

namespace App\Listeners;

use App\Events\SendMessenger;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMessengerListener
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
     * @param  SendMessenger  $event
     * @return void
     */
    public function handle(SendMessenger $event)
    {
        //
    }
}
