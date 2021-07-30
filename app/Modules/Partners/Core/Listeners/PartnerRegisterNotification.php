<?php

namespace App\Modules\Partners\Core\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Modules\Partners\Core\Events\PartnerRegisterd;
use App\Notifications\PartnerRegisterdNotivication;

class PartnerRegisterNotification
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
     * @param  PartnerRegisterd  $event
     * @return void
     */
    public function handle(PartnerRegisterd $event)
    {
        $event->partner->notify(new PartnerRegisterdNotivication());
    }
}
