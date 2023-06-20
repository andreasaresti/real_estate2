<?php

namespace App\Providers;

use App\Models\Theme;
use App\Observers\ThemeObserver;
use App\Models\FavoriteProperty;
use App\Observers\FavoritePropertyObserver;
use App\Models\SalesRequestAppointment;
use App\Observers\SalesRequestAppointmentObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        Theme::observe(ThemeObserver::class);
        FavoriteProperty::observe(FavoritePropertyObserver::class);
        SalesRequestAppointment::observe(SalesRequestAppointmentObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
