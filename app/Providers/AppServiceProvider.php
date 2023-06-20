<?php

namespace App\Providers;

use App\Models\Theme;
use App\Observers\ThemeObserver;
use App\Models\FavoriteProperty;
use App\Observers\FavoritePropertyObserver;
use App\Models\SalesRequestAppointment;
use App\Observers\SalesRequestAppointmentObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FavoriteProperty::observe(FavoritePropertyObserver::class);
        Theme::observe(ThemeObserver::class);
        SalesRequestAppointment::observe(SalesRequestAppointmentObserver::class);
    }
}
