<?php
namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\SiteSetting;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        try {
            $settings = SiteSetting::pluck('value', 'key');
            View::share('settings', $settings);
        } catch (\Exception $e) {
            View::share('settings', collect());
        }
    }
}
