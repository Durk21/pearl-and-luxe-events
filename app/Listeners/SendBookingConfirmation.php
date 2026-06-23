<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\BookingConfirmation;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendBookingConfirmation implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(BookingCreated $event): void
    {
        Mail::to($event->booking->client_email)
            ->send(new BookingConfirmation($event->booking));
    }
}
