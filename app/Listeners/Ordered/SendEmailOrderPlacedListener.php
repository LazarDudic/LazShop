<?php

namespace App\Listeners\Ordered;

use App\Events\Ordered;
use App\Jobs\SendEmail;
use App\Mail\OrderPlaced;

class SendEmailOrderPlacedListener
{
    /**
     * Handle the event.
     *
     * @param  Ordered  $event
     * @return void
     */
    public function handle(Ordered $event)
    {
        $email = new OrderPlaced($event->order);
        $emailJob = (new SendEmail($email))->delay(now()->addSeconds(5));
        dispatch($emailJob);
    }
}
