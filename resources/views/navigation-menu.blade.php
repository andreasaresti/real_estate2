<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-jet-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-jet-nav-link>
                </div>

                <x-nav-dropdown title="Apps" align="right" width="48">
                    @can('view-any', App\Models\Agent::class)
                        <x-dropdown-link href="{{ route('agents.index') }}">
                            Agents
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Customer::class)
                        <x-dropdown-link href="{{ route('customers.index') }}">
                            Customers
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\CustomerRole::class)
                        <x-dropdown-link href="{{ route('customer-roles.index') }}">
                            Customer Roles
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\DeliveryTime::class)
                        <x-dropdown-link href="{{ route('delivery-times.index') }}">
                            Delivery Times
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\District::class)
                        <x-dropdown-link href="{{ route('districts.index') }}">
                            Districts
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Feature::class)
                        <x-dropdown-link href="{{ route('features.index') }}">
                            Features
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\InternalStatus::class)
                        <x-dropdown-link href="{{ route('internal-statuses.index') }}">
                            Internal Statuses
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Language::class)
                        <x-dropdown-link href="{{ route('languages.index') }}">
                            Languages
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Listing::class)
                        <x-dropdown-link href="{{ route('listings.index') }}">
                            Listings
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\ListingAdditionalDetail::class)
                        <x-dropdown-link href="{{ route('listing-additional-details.index') }}">
                            Listing Additional Details
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\ListingAttachment::class)
                        <x-dropdown-link href="{{ route('listing-attachments.index') }}">
                            Listing Attachments
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Location::class)
                        <x-dropdown-link href="{{ route('locations.index') }}">
                            Locations
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Municipality::class)
                        <x-dropdown-link href="{{ route('municipalities.index') }}">
                            Municipalities
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\PropertyType::class)
                        <x-dropdown-link href="{{ route('property-types.index') }}">
                            Property Types
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\SalesPeople::class)
                        <x-dropdown-link href="{{ route('all-sales-people.index') }}">
                            All Sales People
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Source::class)
                        <x-dropdown-link href="{{ route('sources.index') }}">
                            Sources
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Status::class)
                        <x-dropdown-link href="{{ route('statuses.index') }}">
                            Statuses
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\User::class)
                        <x-dropdown-link href="{{ route('users.index') }}">
                            Users
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\FloorPlan::class)
                        <x-dropdown-link href="{{ route('floor-plans.index') }}">
                            Floor Plans
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\ListingType::class)
                        <x-dropdown-link href="{{ route('listing-types.index') }}">
                            Types
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\SalesRequest::class)
                        <x-dropdown-link href="{{ route('sales-requests.index') }}">
                            Sales Requests
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\SalesRequestAppointment::class)
                        <x-dropdown-link href="{{ route('sales-request-appointments.index') }}">
                            Sales Request Appointments
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\SalesRequestListing::class)
                        <x-dropdown-link href="{{ route('sales-request-listings.index') }}">
                            Sales Request Listings
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\AgentAgreement::class)
                        <x-dropdown-link href="{{ route('agent-agreements.index') }}">
                            Agent Agreements
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\CustomerAgreement::class)
                        <x-dropdown-link href="{{ route('customer-agreements.index') }}">
                            Customer Agreements
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\SalesPeopleAgreement::class)
                        <x-dropdown-link href="{{ route('sales-people-agreements.index') }}">
                            Sales People Agreements
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Marketplace::class)
                        <x-dropdown-link href="{{ route('marketplaces.index') }}">
                            Marketplaces
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\SalesLostReason::class)
                        <x-dropdown-link href="{{ route('sales-lost-reasons.index') }}">
                            Sales Lost Reasons
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Banner::class)
                        <x-dropdown-link href="{{ route('banners.index') }}">
                            Banners
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\BannerImage::class)
                        <x-dropdown-link href="{{ route('banner-images.index') }}">
                            Banner Images
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\ChargeRequestCollectMoney::class)
                        <x-dropdown-link href="{{ route('charge-request-collect-monies.index') }}">
                            Charge Request Collect Monies
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\FavoriteProperty::class)
                        <x-dropdown-link href="{{ route('favorite-properties.index') }}">
                            Favorite Properties
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\IntermediateAgent::class)
                        <x-dropdown-link href="{{ route('intermediate-agents.index') }}">
                            Intermediate Agents
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\SalesRequestNoteType::class)
                        <x-dropdown-link href="{{ route('sales-request-note-types.index') }}">
                            Sales Request Note Types
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\Blog::class)
                        <x-dropdown-link href="{{ route('blogs.index') }}">
                            Blogs
                        </x-dropdown-link>
                    @endcan
                    @can('view-any', App\Models\BlogPost::class)
                        <x-dropdown-link href="{{ route('blog-posts.index') }}">
                            Blog Posts
                        </x-dropdown-link>
                    @endcan
                </x-nav-dropdown>

                @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                        Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                    <x-nav-dropdown title="Access Management" align="right" width="48">

                        @can('view-any', Spatie\Permission\Models\Role::class)
                            <x-dropdown-link href="{{ route('roles.index') }}">Roles</x-dropdown-link>
                        @endcan

                        @can('view-any', Spatie\Permission\Models\Permission::class)
                            <x-dropdown-link href="{{ route('permissions.index') }}">Permissions</x-dropdown-link>
                        @endcan

                    </x-nav-dropdown>
                @endif
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ml-3 relative">
                        <x-jet-dropdown align="right" width="60">
                            <x-slot name="trigger">
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition ease-in-out duration-150">
                                        {{ Auth::user()->currentTeam->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            </x-slot>

                            <x-slot name="content">
                                <div class="w-60">
                                    <!-- Team Management -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Manage Team') }}
                                    </div>

                                    <!-- Team Settings -->
                                    <x-jet-dropdown-link
                                        href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                        {{ __('Team Settings') }}
                                    </x-jet-dropdown-link>

                                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                        <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                            {{ __('Create New Team') }}
                                        </x-jet-dropdown-link>
                                    @endcan

                                    <div class="border-t border-gray-100"></div>

                                    <!-- Team Switcher -->
                                    <div class="block px-4 py-2 text-xs text-gray-400">
                                        {{ __('Switch Teams') }}
                                    </div>

                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-jet-switchable-team :team="$team" />
                                    @endforeach
                                </div>
                            </x-slot>
                        </x-jet-dropdown>
                    </div>
                @endif

                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <button
                                    class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition duration-150 ease-in-out">
                                    <img class="h-8 w-8 rounded-full object-cover"
                                        src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                                </button>
                            @else
                                <span class="inline-flex rounded-md">
                                    <button type="button"
                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                        {{ Auth::user()->name }}

                                        <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                    {{ __('API Tokens') }}
                                </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-jet-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-jet-responsive-nav-link>

            @can('view-any', App\Models\Agent::class)
                <x-jet-responsive-nav-link href="{{ route('agents.index') }}">
                    Agents
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Customer::class)
                <x-jet-responsive-nav-link href="{{ route('customers.index') }}">
                    Customers
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\CustomerRole::class)
                <x-jet-responsive-nav-link href="{{ route('customer-roles.index') }}">
                    Customer Roles
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\DeliveryTime::class)
                <x-jet-responsive-nav-link href="{{ route('delivery-times.index') }}">
                    Delivery Times
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\District::class)
                <x-jet-responsive-nav-link href="{{ route('districts.index') }}">
                    Districts
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Feature::class)
                <x-jet-responsive-nav-link href="{{ route('features.index') }}">
                    Features
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\InternalStatus::class)
                <x-jet-responsive-nav-link href="{{ route('internal-statuses.index') }}">
                    Internal Statuses
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Language::class)
                <x-jet-responsive-nav-link href="{{ route('languages.index') }}">
                    Languages
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Listing::class)
                <x-jet-responsive-nav-link href="{{ route('listings.index') }}">
                    Listings
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\ListingAdditionalDetail::class)
                <x-jet-responsive-nav-link href="{{ route('listing-additional-details.index') }}">
                    Listing Additional Details
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\ListingAttachment::class)
                <x-jet-responsive-nav-link href="{{ route('listing-attachments.index') }}">
                    Listing Attachments
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Location::class)
                <x-jet-responsive-nav-link href="{{ route('locations.index') }}">
                    Locations
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Municipality::class)
                <x-jet-responsive-nav-link href="{{ route('municipalities.index') }}">
                    Municipalities
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\PropertyType::class)
                <x-jet-responsive-nav-link href="{{ route('property-types.index') }}">
                    Property Types
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\SalesPeople::class)
                <x-jet-responsive-nav-link href="{{ route('all-sales-people.index') }}">
                    All Sales People
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Source::class)
                <x-jet-responsive-nav-link href="{{ route('sources.index') }}">
                    Sources
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Status::class)
                <x-jet-responsive-nav-link href="{{ route('statuses.index') }}">
                    Statuses
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\User::class)
                <x-jet-responsive-nav-link href="{{ route('users.index') }}">
                    Users
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\FloorPlan::class)
                <x-jet-responsive-nav-link href="{{ route('floor-plans.index') }}">
                    Floor Plans
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\ListingType::class)
                <x-jet-responsive-nav-link href="{{ route('listing-types.index') }}">
                    Types
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\SalesRequest::class)
                <x-jet-responsive-nav-link href="{{ route('sales-requests.index') }}">
                    Sales Requests
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\SalesRequestAppointment::class)
                <x-jet-responsive-nav-link href="{{ route('sales-request-appointments.index') }}">
                    Sales Request Appointments
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\SalesRequestListing::class)
                <x-jet-responsive-nav-link href="{{ route('sales-request-listings.index') }}">
                    Sales Request Listings
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\AgentAgreement::class)
                <x-jet-responsive-nav-link href="{{ route('agent-agreements.index') }}">
                    Agent Agreements
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\CustomerAgreement::class)
                <x-jet-responsive-nav-link href="{{ route('customer-agreements.index') }}">
                    Customer Agreements
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\SalesPeopleAgreement::class)
                <x-jet-responsive-nav-link href="{{ route('sales-people-agreements.index') }}">
                    Sales People Agreements
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Marketplace::class)
                <x-jet-responsive-nav-link href="{{ route('marketplaces.index') }}">
                    Marketplaces
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\SalesLostReason::class)
                <x-jet-responsive-nav-link href="{{ route('sales-lost-reasons.index') }}">
                    Sales Lost Reasons
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Banner::class)
                <x-jet-responsive-nav-link href="{{ route('banners.index') }}">
                    Banners
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\BannerImage::class)
                <x-jet-responsive-nav-link href="{{ route('banner-images.index') }}">
                    Banner Images
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\ChargeRequestCollectMoney::class)
                <x-jet-responsive-nav-link href="{{ route('charge-request-collect-monies.index') }}">
                    Charge Request Collect Monies
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\FavoriteProperty::class)
                <x-jet-responsive-nav-link href="{{ route('favorite-properties.index') }}">
                    Favorite Properties
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\IntermediateAgent::class)
                <x-jet-responsive-nav-link href="{{ route('intermediate-agents.index') }}">
                    Intermediate Agents
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\SalesRequestNoteType::class)
                <x-jet-responsive-nav-link href="{{ route('sales-request-note-types.index') }}">
                    Sales Request Note Types
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\Blog::class)
                <x-jet-responsive-nav-link href="{{ route('blogs.index') }}">
                    Blogs
                </x-jet-responsive-nav-link>
            @endcan
            @can('view-any', App\Models\BlogPost::class)
                <x-jet-responsive-nav-link href="{{ route('blog-posts.index') }}">
                    Blog Posts
                </x-jet-responsive-nav-link>
            @endcan

            @if (Auth::user()->can('view-any', Spatie\Permission\Models\Role::class) ||
                    Auth::user()->can('view-any', Spatie\Permission\Models\Permission::class))
                @can('view-any', Spatie\Permission\Models\Role::class)
                    <x-jet-responsive-nav-link href="{{ route('roles.index') }}">Roles</x-jet-responsive-nav-link>
                @endcan

                @can('view-any', Spatie\Permission\Models\Permission::class)
                    <x-jet-responsive-nav-link
                        href="{{ route('permissions.index') }}">Permissions</x-jet-responsive-nav-link>
                @endcan
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 mr-3">
                        <img class="h-10 w-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-jet-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-jet-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-jet-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-jet-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-jet-responsive-nav-link href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-jet-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-jet-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-jet-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-jet-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-jet-responsive-nav-link>
                    @endcan

                    <div class="border-t border-gray-200"></div>

                    <!-- Team Switcher -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Switch Teams') }}
                    </div>

                    @foreach (Auth::user()->allTeams() as $team)
                        <x-jet-switchable-team :team="$team" component="jet-responsive-nav-link" />
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</nav>
