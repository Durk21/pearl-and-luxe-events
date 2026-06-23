<?php

namespace App\Listeners;

use App\Events\BookingStatusUpdated;
use App\Mail\StatusUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendStatusUpdate implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(BookingStatusUpdated $event): void
    {
        Mail::to($event->booking->client_email)
            ->send(new StatusUpdate($event->booking, $event->previousStatus));
    }
}
