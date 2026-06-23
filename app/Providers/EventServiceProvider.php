<?php

namespace App\Providers;

use App\Events\BookingCreated;
use App\Events\BookingStatusUpdated;
use App\Listeners\SendAdminNotification;
use App\Listeners\SendBookingConfirmation;
use App\Listeners\SendPaymentReminder;
use App\Listeners\SendStatusUpdate;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        BookingCreated::class => [
            SendBookingConfirmation::class,
            SendAdminNotification::class,
            SendPaymentReminder::class,
        ],
        BookingStatusUpdated::class => [
            SendStatusUpdate::class,
        ],
    ];

    public function boot(): void
    {
        //
    }

    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
