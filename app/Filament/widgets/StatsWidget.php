<?php

namespace App\Filament\Widgets;

use App\Models\Booking;
use App\Models\Payment;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue    = Payment::where('status', 'success')->sum('amount');
        $pendingBookings = Booking::where('status', 'pending')->count();
        $confirmedBookings = Booking::where('status', 'confirmed')->count();
        $totalBookings   = Booking::count();

        return [
            Stat::make('Total Bookings', $totalBookings)
                ->description('All time bookings')
                ->descriptionIcon('heroicon-m-calendar-days')
                ->color('primary'),

            Stat::make('Pending Bookings', $pendingBookings)
                ->description('Awaiting confirmation')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Confirmed Bookings', $confirmedBookings)
                ->description('Secured events')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),

            Stat::make('Total Revenue', 'KES ' . number_format($totalRevenue))
                ->description('From successful payments')
                ->descriptionIcon('heroicon-m-banknotes')
                ->color('success'),
        ];
    }
}