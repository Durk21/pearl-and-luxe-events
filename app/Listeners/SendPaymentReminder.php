<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\PaymentReminder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendPaymentReminder implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(BookingCreated $event): void
    {
        // Send reminder after 2 days if deposit not paid
        Mail::to($event->booking->client_email)
            ->later(now()->addDays(2), new PaymentReminder($event->booking));
    }
}
