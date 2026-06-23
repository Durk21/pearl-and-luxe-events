<?php

namespace App\Listeners;

use App\Events\BookingCreated;
use App\Mail\AdminNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendAdminNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(BookingCreated $event): void
    {
        $adminEmail = env('ADMIN_EMAIL', 'kabumba79@gmail.com');
        
        Mail::to($adminEmail)
            ->send(new AdminNotification($event->booking));
    }
}
