<?php

namespace App\Filament\Pages;

use App\Models\Booking;
use App\Models\Payment;
use App\Models\GalleryItem;
use App\Models\Package;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Widgets\StatsOverviewWidget\Stat;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static string $view = 'filament.pages.dashboard';
}