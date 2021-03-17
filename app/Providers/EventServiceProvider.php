<?php

namespace App\Providers;

use App\Events\Ordered;
use App\Listeners\Ordered\DecreaseItemQuantityListener;
use App\Listeners\Ordered\DestroyCartSessionsListener;
use App\Listeners\Ordered\SendEmailOrderPlacedListener;
use App\Listeners\WelcomeEmailListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            WelcomeEmailListener::class,
        ],
        Ordered::class => [
            SendEmailOrderPlacedListener::class,
            DecreaseItemQuantityListener::class,
            DestroyCartSessionsListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
