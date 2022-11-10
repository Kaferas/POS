<?php

namespace App\Listeners;

use App\Events\AfterPayPrintEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class CatchPrintonPrint
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
     * @param  \App\Events\AfterPayPrintEvent  $event
     * @return void
     */
    public function handle(AfterPayPrintEvent $event)
    {
        //
    }
}
