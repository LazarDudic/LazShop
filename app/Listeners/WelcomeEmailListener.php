<?php

namespace App\Listeners;

use App\Jobs\SendEmail;
use App\Mail\WelcomeEmail;
use Illuminate\Auth\Events\Registered;

class WelcomeEmailListener
{
    /**
     * Handle the event.
     *
     * @param Registered $event
     * @return void
     */
    public function handle(Registered $event)
    {
        $email = new WelcomeEmail($event->user->email);
        $emailJob = (new SendEmail($email))->delay(now()->addSeconds(5));
        dispatch($emailJob);
    }
}
