<?php

namespace App\Providers;

use App\Nova\Marketplace;
use App\Nova\Listing;
use App\Nova\Layout;
use App\Nova\SalesPeople;
use App\Nova\SalesRequest;
use App\Nova\Location;
use App\Nova\Municipality;
use App\Nova\District;
use App\Nova\User;
use App\Nova\Language;
use App\Nova\Status;
use App\Nova\Feature;
use App\Nova\PropertyType;
use App\Nova\Agent;
use App\Nova\DeliveryTime;
use App\Nova\InternalStatus;
use App\Nova\ListingType;
use App\Nova\Theme;
use App\Nova\Banner;
use App\Nova\Customer;
use App\Nova\CustomerRole;
use App\Nova\SalesLostReason;
use App\Nova\SalesRequestAppointment;
use App\Nova\Source;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Dashboards\Main;
use Laravel\Nova\Menu\Menu;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Menu\MenuGroup;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
		Nova::mainMenu(function (Request $request) {
            return [
                MenuSection::dashboard(Main::class)->icon('chart-bar'),
                MenuSection::make('Property Management', [
                    MenuItem::resource(Listing::class),
                    MenuGroup::make('Settings', [
                        MenuItem::resource(District::class),
                        MenuItem::resource(Municipality::class),
						MenuItem::resource(Location::class),
                        MenuItem::resource(Status::class),
						MenuItem::resource(DeliveryTime::class),
						MenuItem::resource(InternalStatus::class),
						MenuItem::resource(Feature::class),
						MenuItem::resource(PropertyType::class),
						MenuItem::resource(ListingType::class),
                    ])->collapsable()->collapsedByDefault(),
                ])->icon('briefcase')->collapsable()->collapsedByDefault(),

                MenuSection::make('Users', [
                    MenuItem::resource(Customer::class),
					MenuItem::resource(CustomerRole::class),
                    MenuItem::resource(User::class),
                ])->icon('cog')->collapsable()->collapsedByDefault(),

				MenuSection::make('Sales Module', [
                    MenuItem::resource(SalesRequest::class),
                    // MenuItem::resource(SalesRequestAppointment::class),
                    MenuItem::resource(SalesPeople::class),
                    MenuItem::resource(Agent::class),
                    MenuGroup::make('Settings', [
                        MenuItem::resource(SalesLostReason::class),
                    ])->collapsable(),
                ])->icon('pencil-alt')->collapsable(),

                MenuSection::make('Website', [
                   // MenuItem::resource(Page::class),
                    MenuItem::link('Page', '/page'),                    
                    MenuItem::link('Menu', '/menus'),
                    MenuGroup::make('Settings', [
                        MenuItem::resource(Banner::class),
                        MenuItem::resource(Theme::class),
                    ])->collapsable()->collapsedByDefault(),
                ])->icon('trash')->collapsable()->collapsedByDefault(),
   
                MenuSection::make('Settings', [
                    MenuItem::resource(Source::class),
                    MenuItem::resource(Marketplace::class),
                    MenuItem::resource(Language::class)
                ])->icon('cog')->collapsable()->collapsedByDefault(),
            ];
            
        });
    }

	
    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

	protected function resources()
	{
		Nova::resourcesIn(app_path('Nova'));

		Nova::resources([
			Listing::class,
		]);
	}

	public function menu(Request $request)
	{
		return parent::menu($request)->withBadge(function () {
			return static::$model::count();
		});
	}
    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            // ...
            \Outl1ne\MenuBuilder\MenuBuilder::make()
            ->icon('adjustments') // Customize menu icon, supports heroicons
            ->hideMenu(false) // Hide MenuBuilder defined MenuSection.
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
