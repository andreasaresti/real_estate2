<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\AgentController;
use App\Http\Controllers\Api\SourceController;
use App\Http\Controllers\Api\StatusController;
use App\Http\Controllers\Api\BannerController;
// use App\Http\Controllers\Api\FeatureController;
// use App\Http\Controllers\Api\ListingController;
// use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\DistrictController;
use App\Http\Controllers\Api\LanguageController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\FloorPlanController;
use App\Http\Controllers\Api\PermissionController;
// use App\Http\Controllers\Api\SalesPeopleController;
use App\Http\Controllers\Api\ListingTypeController;
use App\Http\Controllers\Api\MarketplaceController;
use App\Http\Controllers\Api\BannerImageController;
use App\Http\Controllers\Api\CustomerRoleController;
use App\Http\Controllers\Api\DeliveryTimeController;
use App\Http\Controllers\Api\MunicipalityController;
use App\Http\Controllers\Api\PropertyTypeController;
// use App\Http\Controllers\Api\SalesRequestController;
use App\Http\Controllers\Api\AgentListingsController;
use App\Http\Controllers\Api\DistrictAgentsController;
use App\Http\Controllers\Api\InternalStatusController;
use App\Http\Controllers\Api\StatusListingsController;
use App\Http\Controllers\Api\AgentAgreementController;
use App\Http\Controllers\Api\FeatureListingsController;
use App\Http\Controllers\Api\ListingListingsController;
use App\Http\Controllers\Api\ListingFeaturesController;
use App\Http\Controllers\Api\SalesLostReasonController;
use App\Http\Controllers\Api\CustomerListingsController;
use App\Http\Controllers\Api\LocationListingsController;
use App\Http\Controllers\Api\ListingFloorPlansController;
use App\Http\Controllers\Api\ListingAttachmentController;
use App\Http\Controllers\Api\CustomerAgreementController;
use App\Http\Controllers\Api\BannerBannerImagesController;
use App\Http\Controllers\Api\AgentAllSalesPeopleController;
use App\Http\Controllers\Api\ListingMarketplacesController;
use App\Http\Controllers\Api\ListingListingTypesController;
use App\Http\Controllers\Api\SourceSalesRequestsController;
use App\Http\Controllers\Api\ListingTypeListingsController;
use App\Http\Controllers\Api\SalesRequestListingController;
use App\Http\Controllers\Api\MarketplaceListingsController;
use App\Http\Controllers\Api\AgentAgentAgreementsController;
use App\Http\Controllers\Api\DeliveryTimeListingsController;
use App\Http\Controllers\Api\LanguageBannerImagesController;
use App\Http\Controllers\Api\ListingSalesRequestsController;
use App\Http\Controllers\Api\SalesPeopleDistrictsController;
use App\Http\Controllers\Api\SalesPeopleAgreementController;
use App\Http\Controllers\Api\CustomerSalesRequestsController;
use App\Http\Controllers\Api\CustomerRoleCustomersController;
use App\Http\Controllers\Api\MunicipalityLocationsController;
use App\Http\Controllers\Api\CustomerAllSalesPeopleController;
use App\Http\Controllers\Api\DistrictMunicipalitiesController;
use App\Http\Controllers\Api\DistrictAllSalesPeopleController;
use App\Http\Controllers\Api\InternalStatusListingsController;
use App\Http\Controllers\Api\ListingAdditionalDetailController;
use App\Http\Controllers\Api\SalesPeopleListingTypesController;
// use App\Http\Controllers\Api\SalesRequestAppointmentController;
use App\Http\Controllers\Api\SalesPeopleSalesRequestsController;
use App\Http\Controllers\Api\SalesPeoplePropertyTypesController;
use App\Http\Controllers\Api\ListingListingAttachmentsController;
use App\Http\Controllers\Api\ListingFavoritePropertiesController;
use App\Http\Controllers\Api\PropertyTypeSalesRequestsController;
use App\Http\Controllers\Api\ListingTypeAllSalesPeopleController;
use App\Http\Controllers\Api\CustomerCustomerAgreementsController;
use App\Http\Controllers\Api\CustomerFavoritePropertiesController;
use App\Http\Controllers\Api\DistrictCustomerAgreementsController;
use App\Http\Controllers\Api\PropertyTypeAllSalesPeopleController;
use App\Http\Controllers\Api\ListingSalesRequestListingsController;
use App\Http\Controllers\Api\PropertyTypeAgentAgreementsController;
use App\Http\Controllers\Api\SalesLostReasonSalesRequestsController;
use App\Http\Controllers\Api\DistrictSalesRequestDistrictsController;
use App\Http\Controllers\Api\DistrictSalesPeopleAgreementsController;
use App\Http\Controllers\Api\LocationSalesRequestLocationsController;
use App\Http\Controllers\Api\PropertyTypeCustomerAgreementsController;
use App\Http\Controllers\Api\ListingListingAdditionalDetailsController;
use App\Http\Controllers\Api\ListingSalesRequestAppointmentsController;
use App\Http\Controllers\Api\SalesPeopleSalesPeopleAgreementsController;
use App\Http\Controllers\Api\SalesRequestSalesRequestListingsController;
use App\Http\Controllers\Api\PropertyTypeSalesPeopleAgreementsController;
use App\Http\Controllers\Api\SalesRequestSalesRequestLocationsController;
use App\Http\Controllers\Api\SalesRequestSalesRequestDistrictsController;
use App\Http\Controllers\Api\ListingTypeSalesRequestListingTypesController;
use App\Http\Controllers\Api\SalesRequestSalesRequestListingTypesController;
use App\Http\Controllers\Api\SalesRequestSalesRequestAppointmentsController;
use App\Http\Controllers\Api\MunicipalitySalesRequestMunicipalitiesController;
use App\Http\Controllers\Api\SalesRequestSalesRequestMunicipalitiesController;

use App\Http\Controllers\MenuController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StatueController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SalesPeopleController;
use App\Http\Controllers\SalesRequestController;
use App\Http\Controllers\SalesRequestAppointmentController;
use App\Http\Controllers\FavoritePropertyController;
use App\Http\Controllers\webUsersController;
use App\Http\Controllers\webListings;
use App\Http\Controllers\webSalesRequestController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('localhost')->group(function () {

// webUsersController
Route::get('remind-password', [webUsersController::class, 'remind_password']);
Route::post('create-webuser', [webUsersController::class, 'create_user']);
Route::post('get-webuser', [webUsersController::class, 'get_users']);
Route::post('update-webuser', [webUsersController::class, 'update_user']);
Route::post('webuserschangepassword', [webUsersController::class, 'changepassword_user']);
Route::post('login-webuser', [webUsersController::class, 'login_user']);
Route::post('logout-webuser', [webUsersController::class, 'logout_user']);

// webListings
Route::post('activelistings', [webListings::class, 'get_active_listings']);
Route::post('activelisting-types', [webListings::class, 'get_active_listing_types']);
Route::post('activeproperty-types', [webListings::class, 'get_active_property_types']);
Route::post('activefeatures', [webListings::class, 'get_active_features']);
Route::post('activedistrict', [webListings::class, 'get_active_district']);
Route::post('activemunicipality', [webListings::class, 'get_active_municipality']);
Route::post('activelocation', [webListings::class, 'get_active_location']);
Route::post('get-countries', [webListings::class, 'get_countries']);
Route::post('get_pagination', [webListings::class, 'get_pagination']);
Route::post('add-remove-to-favorites', [webListings::class, 'add_remove_to_favorites']);

// webSalesRequestController
Route::post('salesrequest-closedeal', [webSalesRequestController::class, 'close_deal']);
Route::post('addnote', [webSalesRequestController::class, 'add_note']);
Route::post('salesrequest-getnotes', [webSalesRequestController::class, 'get_notes']);
Route::post('salesrequest-addappointments', [webSalesRequestController::class, 'add_appointments']);
Route::post('salesrequest-getappointments', [webSalesRequestController::class, 'get_appointments']);
Route::post('salesrequest-getlistings', [webSalesRequestController::class, 'get_listings']);
Route::post('salesrequest-addlisting', [webSalesRequestController::class, 'add_listing']);
Route::post('salesrequest-changelistingtype', [webSalesRequestController::class, 'change_listing_type']);
Route::post('salesrequest-addsalesrequest', [webSalesRequestController::class, 'add_sales_request']);
Route::post('salesrequest-getsalesrequest', [webSalesRequestController::class, 'accept_sales_request']);
Route::post('salesrequest-getsalesrequest', [webSalesRequestController::class, 'get_sales_request']);
Route::post('salesrequest-signappointment', [webSalesRequestController::class, 'sign_appointment']);
Route::post('salesrequest-updatesalesrequest', [webSalesRequestController::class, 'update_sales_request']);

// });

Route::controller(MenuController::class)->group(function () {
    Route::get('menu', 'index');
});
Route::controller(PageController::class)->group(function () {
    Route::get('page/{url}', 'get');
});
Route::controller(StatueController::class)->group(function () {
    Route::get('statue', 'index');
});
Route::controller(FeatureController::class)->group(function () {
    Route::get('feature', 'index');
});
Route::controller(TypeController::class)->group(function () {
    Route::get('type', 'index');
});
Route::controller(FavoritePropertyController::class)->group(function () {
    Route::get('add_favorit/{index}', 'create');
});
Route::controller(ListingController::class)->group(function () {
    Route::post('listing', 'get');
    Route::post('add_listing', 'add');
    Route::get('get_listing_param', 'get_param');
    Route::get('listing/{index}', 'cur_get');
    Route::get('add_favorit/{index}', 'add_favorit');
});
Route::controller(CustomerController::class)->group(function () {
    Route::post('customer', 'get');
    Route::get('logout', 'logout');
    Route::post('save_customer', 'store');
    Route::post('customer_details', 'get_details');
    Route::post('update_profile', 'update');
});
Route::controller(SalesPeopleController::class)->group(function () {
    Route::post('agencies', 'get');
    Route::post('request_inquiry', 'store_inquiry');
});
Route::controller(SalesRequestController::class)->group(function () {
    Route::post('request_get', 'get');
    Route::post('request_cur_get_list', 'cur_get_list');
    Route::post('update_request', 'update');
    Route::post('add_request_listing', 'add_listing');
    Route::post('update_request_listings_status', 'update_listings_status');
    Route::post('accept_request', 'accept');
    Route::post('colse_deal_request', 'colse_deal');
});

Route::controller(SalesRequestAppointmentController::class)->group(function () {
    Route::post('get_appointments', 'get');
    Route::post('add_appointments', 'add');
    Route::post('update_appointments_status', 'update_status');
    Route::post('update_appointments', 'update');
});

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('permissions', PermissionController::class);

        Route::apiResource('agents', AgentController::class);

        // Agent All Sales People
        Route::get('/agents/{agent}/all-sales-people', [
            AgentAllSalesPeopleController::class,
            'index',
        ])->name('agents.all-sales-people.index');
        Route::post('/agents/{agent}/all-sales-people', [
            AgentAllSalesPeopleController::class,
            'store',
        ])->name('agents.all-sales-people.store');

        // Agent Listings
        Route::get('/agents/{agent}/listings', [
            AgentListingsController::class,
            'index',
        ])->name('agents.listings.index');
        Route::post('/agents/{agent}/listings', [
            AgentListingsController::class,
            'store',
        ])->name('agents.listings.store');

        // Agent Agent Agreements
        Route::get('/agents/{agent}/agent-agreements', [
            AgentAgentAgreementsController::class,
            'index',
        ])->name('agents.agent-agreements.index');
        Route::post('/agents/{agent}/agent-agreements', [
            AgentAgentAgreementsController::class,
            'store',
        ])->name('agents.agent-agreements.store');

        Route::apiResource('customers', CustomerController::class);

        // Customer Listings
        Route::get('/customers/{customer}/listings', [
            CustomerListingsController::class,
            'index',
        ])->name('customers.listings.index');
        Route::post('/customers/{customer}/listings', [
            CustomerListingsController::class,
            'store',
        ])->name('customers.listings.store');

        // Customer All Sales People
        Route::get('/customers/{customer}/all-sales-people', [
            CustomerAllSalesPeopleController::class,
            'index',
        ])->name('customers.all-sales-people.index');
        Route::post('/customers/{customer}/all-sales-people', [
            CustomerAllSalesPeopleController::class,
            'store',
        ])->name('customers.all-sales-people.store');

        // Customer Sales Requests
        Route::get('/customers/{customer}/sales-requests', [
            CustomerSalesRequestsController::class,
            'index',
        ])->name('customers.sales-requests.index');
        Route::post('/customers/{customer}/sales-requests', [
            CustomerSalesRequestsController::class,
            'store',
        ])->name('customers.sales-requests.store');

        // Customer Customer Agreements
        Route::get('/customers/{customer}/customer-agreements', [
            CustomerCustomerAgreementsController::class,
            'index',
        ])->name('customers.customer-agreements.index');
        Route::post('/customers/{customer}/customer-agreements', [
            CustomerCustomerAgreementsController::class,
            'store',
        ])->name('customers.customer-agreements.store');

        // Customer Favorite Properties
        Route::get('/customers/{customer}/favorite-properties', [
            CustomerFavoritePropertiesController::class,
            'index',
        ])->name('customers.favorite-properties.index');
        Route::post('/customers/{customer}/favorite-properties', [
            CustomerFavoritePropertiesController::class,
            'store',
        ])->name('customers.favorite-properties.store');

        Route::apiResource('customer-roles', CustomerRoleController::class);

        // CustomerRole Customers
        Route::get('/customer-roles/{customerRole}/customers', [
            CustomerRoleCustomersController::class,
            'index',
        ])->name('customer-roles.customers.index');
        Route::post('/customer-roles/{customerRole}/customers', [
            CustomerRoleCustomersController::class,
            'store',
        ])->name('customer-roles.customers.store');

        Route::apiResource('delivery-times', DeliveryTimeController::class);

        // DeliveryTime Listings
        Route::get('/delivery-times/{deliveryTime}/listings', [
            DeliveryTimeListingsController::class,
            'index',
        ])->name('delivery-times.listings.index');
        Route::post('/delivery-times/{deliveryTime}/listings', [
            DeliveryTimeListingsController::class,
            'store',
        ])->name('delivery-times.listings.store');

        Route::apiResource('districts', DistrictController::class);

        // District Municipalities
        Route::get('/districts/{district}/municipalities', [
            DistrictMunicipalitiesController::class,
            'index',
        ])->name('districts.municipalities.index');
        Route::post('/districts/{district}/municipalities', [
            DistrictMunicipalitiesController::class,
            'store',
        ])->name('districts.municipalities.store');

        // District Agents
        Route::get('/districts/{district}/agents', [
            DistrictAgentsController::class,
            'index',
        ])->name('districts.agents.index');
        Route::post('/districts/{district}/agents', [
            DistrictAgentsController::class,
            'store',
        ])->name('districts.agents.store');

        // District Sales Request Districts
        Route::get('/districts/{district}/sales-request-districts', [
            DistrictSalesRequestDistrictsController::class,
            'index',
        ])->name('districts.sales-request-districts.index');
        Route::post('/districts/{district}/sales-request-districts', [
            DistrictSalesRequestDistrictsController::class,
            'store',
        ])->name('districts.sales-request-districts.store');

        // District Sales People Agreements
        Route::get('/districts/{district}/sales-people-agreements', [
            DistrictSalesPeopleAgreementsController::class,
            'index',
        ])->name('districts.sales-people-agreements.index');
        Route::post('/districts/{district}/sales-people-agreements', [
            DistrictSalesPeopleAgreementsController::class,
            'store',
        ])->name('districts.sales-people-agreements.store');

        // District Customer Agreements
        Route::get('/districts/{district}/customer-agreements', [
            DistrictCustomerAgreementsController::class,
            'index',
        ])->name('districts.customer-agreements.index');
        Route::post('/districts/{district}/customer-agreements', [
            DistrictCustomerAgreementsController::class,
            'store',
        ])->name('districts.customer-agreements.store');

        // District All Sales People
        Route::get('/districts/{district}/all-sales-people', [
            DistrictAllSalesPeopleController::class,
            'index',
        ])->name('districts.all-sales-people.index');
        Route::post('/districts/{district}/all-sales-people/{salesPeople}', [
            DistrictAllSalesPeopleController::class,
            'store',
        ])->name('districts.all-sales-people.store');
        Route::delete('/districts/{district}/all-sales-people/{salesPeople}', [
            DistrictAllSalesPeopleController::class,
            'destroy',
        ])->name('districts.all-sales-people.destroy');

        Route::apiResource('features', FeatureController::class);

        // Feature Listings
        Route::get('/features/{feature}/listings', [
            FeatureListingsController::class,
            'index',
        ])->name('features.listings.index');
        Route::post('/features/{feature}/listings/{listing}', [
            FeatureListingsController::class,
            'store',
        ])->name('features.listings.store');
        Route::delete('/features/{feature}/listings/{listing}', [
            FeatureListingsController::class,
            'destroy',
        ])->name('features.listings.destroy');

        Route::apiResource(
            'internal-statuses',
            InternalStatusController::class
        );

        // InternalStatus Listings
        Route::get('/internal-statuses/{internalStatus}/listings', [
            InternalStatusListingsController::class,
            'index',
        ])->name('internal-statuses.listings.index');
        Route::post('/internal-statuses/{internalStatus}/listings', [
            InternalStatusListingsController::class,
            'store',
        ])->name('internal-statuses.listings.store');

        Route::apiResource('languages', LanguageController::class);

        // Language Banner Images
        Route::get('/languages/{language}/banner-images', [
            LanguageBannerImagesController::class,
            'index',
        ])->name('languages.banner-images.index');
        Route::post('/languages/{language}/banner-images', [
            LanguageBannerImagesController::class,
            'store',
        ])->name('languages.banner-images.store');

        Route::apiResource('listings', ListingController::class);

        // Listing Listings
        Route::get('/listings/{listing}/listings', [
            ListingListingsController::class,
            'index',
        ])->name('listings.listings.index');
        Route::post('/listings/{listing}/listings', [
            ListingListingsController::class,
            'store',
        ])->name('listings.listings.store');

        // Listing Listing Attachments
        Route::get('/listings/{listing}/listing-attachments', [
            ListingListingAttachmentsController::class,
            'index',
        ])->name('listings.listing-attachments.index');
        Route::post('/listings/{listing}/listing-attachments', [
            ListingListingAttachmentsController::class,
            'store',
        ])->name('listings.listing-attachments.store');

        // Listing Listing Additional Details
        Route::get('/listings/{listing}/listing-additional-details', [
            ListingListingAdditionalDetailsController::class,
            'index',
        ])->name('listings.listing-additional-details.index');
        Route::post('/listings/{listing}/listing-additional-details', [
            ListingListingAdditionalDetailsController::class,
            'store',
        ])->name('listings.listing-additional-details.store');

        // Listing Floor Plans
        Route::get('/listings/{listing}/floor-plans', [
            ListingFloorPlansController::class,
            'index',
        ])->name('listings.floor-plans.index');
        Route::post('/listings/{listing}/floor-plans', [
            ListingFloorPlansController::class,
            'store',
        ])->name('listings.floor-plans.store');

        // Listing Sales Request Appointments
        Route::get('/listings/{listing}/sales-request-appointments', [
            ListingSalesRequestAppointmentsController::class,
            'index',
        ])->name('listings.sales-request-appointments.index');
        Route::post('/listings/{listing}/sales-request-appointments', [
            ListingSalesRequestAppointmentsController::class,
            'store',
        ])->name('listings.sales-request-appointments.store');

        // Listing Sales Request Listings
        Route::get('/listings/{listing}/sales-request-listings', [
            ListingSalesRequestListingsController::class,
            'index',
        ])->name('listings.sales-request-listings.index');
        Route::post('/listings/{listing}/sales-request-listings', [
            ListingSalesRequestListingsController::class,
            'store',
        ])->name('listings.sales-request-listings.store');

        // Listing Sales Requests
        Route::get('/listings/{listing}/sales-requests', [
            ListingSalesRequestsController::class,
            'index',
        ])->name('listings.sales-requests.index');
        Route::post('/listings/{listing}/sales-requests', [
            ListingSalesRequestsController::class,
            'store',
        ])->name('listings.sales-requests.store');

        // Listing Favorite Properties
        Route::get('/listings/{listing}/favorite-properties', [
            ListingFavoritePropertiesController::class,
            'index',
        ])->name('listings.favorite-properties.index');
        Route::post('/listings/{listing}/favorite-properties', [
            ListingFavoritePropertiesController::class,
            'store',
        ])->name('listings.favorite-properties.store');

        // Listing Marketplaces
        Route::get('/listings/{listing}/marketplaces', [
            ListingMarketplacesController::class,
            'index',
        ])->name('listings.marketplaces.index');
        Route::post('/listings/{listing}/marketplaces/{marketplace}', [
            ListingMarketplacesController::class,
            'store',
        ])->name('listings.marketplaces.store');
        Route::delete('/listings/{listing}/marketplaces/{marketplace}', [
            ListingMarketplacesController::class,
            'destroy',
        ])->name('listings.marketplaces.destroy');

        // Listing Features
        Route::get('/listings/{listing}/features', [
            ListingFeaturesController::class,
            'index',
        ])->name('listings.features.index');
        Route::post('/listings/{listing}/features/{feature}', [
            ListingFeaturesController::class,
            'store',
        ])->name('listings.features.store');
        Route::delete('/listings/{listing}/features/{feature}', [
            ListingFeaturesController::class,
            'destroy',
        ])->name('listings.features.destroy');

        // Listing Listing Types
        Route::get('/listings/{listing}/listing-types', [
            ListingListingTypesController::class,
            'index',
        ])->name('listings.listing-types.index');
        Route::post('/listings/{listing}/listing-types/{listingType}', [
            ListingListingTypesController::class,
            'store',
        ])->name('listings.listing-types.store');
        Route::delete('/listings/{listing}/listing-types/{listingType}', [
            ListingListingTypesController::class,
            'destroy',
        ])->name('listings.listing-types.destroy');

        Route::apiResource(
            'listing-additional-details',
            ListingAdditionalDetailController::class
        );

        Route::apiResource(
            'listing-attachments',
            ListingAttachmentController::class
        );

        Route::apiResource('locations', LocationController::class);

        // Location Listings
        Route::get('/locations/{location}/listings', [
            LocationListingsController::class,
            'index',
        ])->name('locations.listings.index');
        Route::post('/locations/{location}/listings', [
            LocationListingsController::class,
            'store',
        ])->name('locations.listings.store');

        // Location Sales Request Locations
        Route::get('/locations/{location}/sales-request-locations', [
            LocationSalesRequestLocationsController::class,
            'index',
        ])->name('locations.sales-request-locations.index');
        Route::post('/locations/{location}/sales-request-locations', [
            LocationSalesRequestLocationsController::class,
            'store',
        ])->name('locations.sales-request-locations.store');

        Route::apiResource('municipalities', MunicipalityController::class);

        // Municipality Locations
        Route::get('/municipalities/{municipality}/locations', [
            MunicipalityLocationsController::class,
            'index',
        ])->name('municipalities.locations.index');
        Route::post('/municipalities/{municipality}/locations', [
            MunicipalityLocationsController::class,
            'store',
        ])->name('municipalities.locations.store');

        // Municipality Sales Request Municipalities
        Route::get(
            '/municipalities/{municipality}/sales-request-municipalities',
            [MunicipalitySalesRequestMunicipalitiesController::class, 'index']
        )->name('municipalities.sales-request-municipalities.index');
        Route::post(
            '/municipalities/{municipality}/sales-request-municipalities',
            [MunicipalitySalesRequestMunicipalitiesController::class, 'store']
        )->name('municipalities.sales-request-municipalities.store');

        Route::apiResource('property-types', PropertyTypeController::class);

        // PropertyType Sales Requests
        Route::get('/property-types/{propertyType}/sales-requests', [
            PropertyTypeSalesRequestsController::class,
            'index',
        ])->name('property-types.sales-requests.index');
        Route::post('/property-types/{propertyType}/sales-requests', [
            PropertyTypeSalesRequestsController::class,
            'store',
        ])->name('property-types.sales-requests.store');

        // PropertyType Agent Agreements
        Route::get('/property-types/{propertyType}/agent-agreements', [
            PropertyTypeAgentAgreementsController::class,
            'index',
        ])->name('property-types.agent-agreements.index');
        Route::post('/property-types/{propertyType}/agent-agreements', [
            PropertyTypeAgentAgreementsController::class,
            'store',
        ])->name('property-types.agent-agreements.store');

        // PropertyType Sales People Agreements
        Route::get('/property-types/{propertyType}/sales-people-agreements', [
            PropertyTypeSalesPeopleAgreementsController::class,
            'index',
        ])->name('property-types.sales-people-agreements.index');
        Route::post('/property-types/{propertyType}/sales-people-agreements', [
            PropertyTypeSalesPeopleAgreementsController::class,
            'store',
        ])->name('property-types.sales-people-agreements.store');

        // PropertyType Customer Agreements
        Route::get('/property-types/{propertyType}/customer-agreements', [
            PropertyTypeCustomerAgreementsController::class,
            'index',
        ])->name('property-types.customer-agreements.index');
        Route::post('/property-types/{propertyType}/customer-agreements', [
            PropertyTypeCustomerAgreementsController::class,
            'store',
        ])->name('property-types.customer-agreements.store');

        // PropertyType All Sales People
        Route::get('/property-types/{propertyType}/all-sales-people', [
            PropertyTypeAllSalesPeopleController::class,
            'index',
        ])->name('property-types.all-sales-people.index');
        Route::post(
            '/property-types/{propertyType}/all-sales-people/{salesPeople}',
            [PropertyTypeAllSalesPeopleController::class, 'store']
        )->name('property-types.all-sales-people.store');
        Route::delete(
            '/property-types/{propertyType}/all-sales-people/{salesPeople}',
            [PropertyTypeAllSalesPeopleController::class, 'destroy']
        )->name('property-types.all-sales-people.destroy');

        Route::apiResource('all-sales-people', SalesPeopleController::class);

        // SalesPeople Sales Requests
        Route::get('/all-sales-people/{salesPeople}/sales-requests', [
            SalesPeopleSalesRequestsController::class,
            'index',
        ])->name('all-sales-people.sales-requests.index');
        Route::post('/all-sales-people/{salesPeople}/sales-requests', [
            SalesPeopleSalesRequestsController::class,
            'store',
        ])->name('all-sales-people.sales-requests.store');

        // SalesPeople Sales People Agreements
        Route::get('/all-sales-people/{salesPeople}/sales-people-agreements', [
            SalesPeopleSalesPeopleAgreementsController::class,
            'index',
        ])->name('all-sales-people.sales-people-agreements.index');
        Route::post('/all-sales-people/{salesPeople}/sales-people-agreements', [
            SalesPeopleSalesPeopleAgreementsController::class,
            'store',
        ])->name('all-sales-people.sales-people-agreements.store');

        // SalesPeople Listing Types
        Route::get('/all-sales-people/{salesPeople}/listing-types', [
            SalesPeopleListingTypesController::class,
            'index',
        ])->name('all-sales-people.listing-types.index');
        Route::post(
            '/all-sales-people/{salesPeople}/listing-types/{listingType}',
            [SalesPeopleListingTypesController::class, 'store']
        )->name('all-sales-people.listing-types.store');
        Route::delete(
            '/all-sales-people/{salesPeople}/listing-types/{listingType}',
            [SalesPeopleListingTypesController::class, 'destroy']
        )->name('all-sales-people.listing-types.destroy');

        // SalesPeople Districts
        Route::get('/all-sales-people/{salesPeople}/districts', [
            SalesPeopleDistrictsController::class,
            'index',
        ])->name('all-sales-people.districts.index');
        Route::post('/all-sales-people/{salesPeople}/districts/{district}', [
            SalesPeopleDistrictsController::class,
            'store',
        ])->name('all-sales-people.districts.store');
        Route::delete('/all-sales-people/{salesPeople}/districts/{district}', [
            SalesPeopleDistrictsController::class,
            'destroy',
        ])->name('all-sales-people.districts.destroy');

        // SalesPeople Property Types
        Route::get('/all-sales-people/{salesPeople}/property-types', [
            SalesPeoplePropertyTypesController::class,
            'index',
        ])->name('all-sales-people.property-types.index');
        Route::post(
            '/all-sales-people/{salesPeople}/property-types/{propertyType}',
            [SalesPeoplePropertyTypesController::class, 'store']
        )->name('all-sales-people.property-types.store');
        Route::delete(
            '/all-sales-people/{salesPeople}/property-types/{propertyType}',
            [SalesPeoplePropertyTypesController::class, 'destroy']
        )->name('all-sales-people.property-types.destroy');

        Route::apiResource('sources', SourceController::class);

        // Source Sales Requests
        Route::get('/sources/{source}/sales-requests', [
            SourceSalesRequestsController::class,
            'index',
        ])->name('sources.sales-requests.index');
        Route::post('/sources/{source}/sales-requests', [
            SourceSalesRequestsController::class,
            'store',
        ])->name('sources.sales-requests.store');

        Route::apiResource('statuses', StatusController::class);

        // Status Listings
        Route::get('/statuses/{status}/listings', [
            StatusListingsController::class,
            'index',
        ])->name('statuses.listings.index');
        Route::post('/statuses/{status}/listings', [
            StatusListingsController::class,
            'store',
        ])->name('statuses.listings.store');

        Route::apiResource('users', UserController::class);

        Route::apiResource('floor-plans', FloorPlanController::class);

        Route::apiResource('listing-types', ListingTypeController::class);

        // ListingType Sales Request Listing Types
        Route::get('/listing-types/{listingType}/sales-request-listing-types', [
            ListingTypeSalesRequestListingTypesController::class,
            'index',
        ])->name('listing-types.sales-request-listing-types.index');
        Route::post(
            '/listing-types/{listingType}/sales-request-listing-types',
            [ListingTypeSalesRequestListingTypesController::class, 'store']
        )->name('listing-types.sales-request-listing-types.store');

        // ListingType All Sales People
        Route::get('/listing-types/{listingType}/all-sales-people', [
            ListingTypeAllSalesPeopleController::class,
            'index',
        ])->name('listing-types.all-sales-people.index');
        Route::post(
            '/listing-types/{listingType}/all-sales-people/{salesPeople}',
            [ListingTypeAllSalesPeopleController::class, 'store']
        )->name('listing-types.all-sales-people.store');
        Route::delete(
            '/listing-types/{listingType}/all-sales-people/{salesPeople}',
            [ListingTypeAllSalesPeopleController::class, 'destroy']
        )->name('listing-types.all-sales-people.destroy');

        // ListingType Listings
        Route::get('/listing-types/{listingType}/listings', [
            ListingTypeListingsController::class,
            'index',
        ])->name('listing-types.listings.index');
        Route::post('/listing-types/{listingType}/listings/{listing}', [
            ListingTypeListingsController::class,
            'store',
        ])->name('listing-types.listings.store');
        Route::delete('/listing-types/{listingType}/listings/{listing}', [
            ListingTypeListingsController::class,
            'destroy',
        ])->name('listing-types.listings.destroy');

        Route::apiResource('sales-requests', SalesRequestController::class);

        // SalesRequest Sales Request Locations
        Route::get('/sales-requests/{salesRequest}/sales-request-locations', [
            SalesRequestSalesRequestLocationsController::class,
            'index',
        ])->name('sales-requests.sales-request-locations.index');
        Route::post('/sales-requests/{salesRequest}/sales-request-locations', [
            SalesRequestSalesRequestLocationsController::class,
            'store',
        ])->name('sales-requests.sales-request-locations.store');

        // SalesRequest Sales Request Districts
        Route::get('/sales-requests/{salesRequest}/sales-request-districts', [
            SalesRequestSalesRequestDistrictsController::class,
            'index',
        ])->name('sales-requests.sales-request-districts.index');
        Route::post('/sales-requests/{salesRequest}/sales-request-districts', [
            SalesRequestSalesRequestDistrictsController::class,
            'store',
        ])->name('sales-requests.sales-request-districts.store');

        // SalesRequest Sales Request Municipalities
        Route::get(
            '/sales-requests/{salesRequest}/sales-request-municipalities',
            [SalesRequestSalesRequestMunicipalitiesController::class, 'index']
        )->name('sales-requests.sales-request-municipalities.index');
        Route::post(
            '/sales-requests/{salesRequest}/sales-request-municipalities',
            [SalesRequestSalesRequestMunicipalitiesController::class, 'store']
        )->name('sales-requests.sales-request-municipalities.store');

        // SalesRequest Sales Request Listing Types
        Route::get(
            '/sales-requests/{salesRequest}/sales-request-listing-types',
            [SalesRequestSalesRequestListingTypesController::class, 'index']
        )->name('sales-requests.sales-request-listing-types.index');
        Route::post(
            '/sales-requests/{salesRequest}/sales-request-listing-types',
            [SalesRequestSalesRequestListingTypesController::class, 'store']
        )->name('sales-requests.sales-request-listing-types.store');

        // SalesRequest Sales Request Appointments
        Route::get(
            '/sales-requests/{salesRequest}/sales-request-appointments',
            [SalesRequestSalesRequestAppointmentsController::class, 'index']
        )->name('sales-requests.sales-request-appointments.index');
        Route::post(
            '/sales-requests/{salesRequest}/sales-request-appointments',
            [SalesRequestSalesRequestAppointmentsController::class, 'store']
        )->name('sales-requests.sales-request-appointments.store');

        // SalesRequest Sales Request Listings
        Route::get('/sales-requests/{salesRequest}/sales-request-listings', [
            SalesRequestSalesRequestListingsController::class,
            'index',
        ])->name('sales-requests.sales-request-listings.index');
        Route::post('/sales-requests/{salesRequest}/sales-request-listings', [
            SalesRequestSalesRequestListingsController::class,
            'store',
        ])->name('sales-requests.sales-request-listings.store');

        Route::apiResource(
            'sales-request-appointments',
            SalesRequestAppointmentController::class
        );

        Route::apiResource(
            'sales-request-listings',
            SalesRequestListingController::class
        );

        Route::apiResource('agent-agreements', AgentAgreementController::class);

        Route::apiResource(
            'customer-agreements',
            CustomerAgreementController::class
        );

        Route::apiResource(
            'sales-people-agreements',
            SalesPeopleAgreementController::class
        );

        Route::apiResource('marketplaces', MarketplaceController::class);

        // Marketplace Listings
        Route::get('/marketplaces/{marketplace}/listings', [
            MarketplaceListingsController::class,
            'index',
        ])->name('marketplaces.listings.index');
        Route::post('/marketplaces/{marketplace}/listings/{listing}', [
            MarketplaceListingsController::class,
            'store',
        ])->name('marketplaces.listings.store');
        Route::delete('/marketplaces/{marketplace}/listings/{listing}', [
            MarketplaceListingsController::class,
            'destroy',
        ])->name('marketplaces.listings.destroy');

        Route::apiResource(
            'sales-lost-reasons',
            SalesLostReasonController::class
        );

        // SalesLostReason Sales Requests
        Route::get('/sales-lost-reasons/{salesLostReason}/sales-requests', [
            SalesLostReasonSalesRequestsController::class,
            'index',
        ])->name('sales-lost-reasons.sales-requests.index');
        Route::post('/sales-lost-reasons/{salesLostReason}/sales-requests', [
            SalesLostReasonSalesRequestsController::class,
            'store',
        ])->name('sales-lost-reasons.sales-requests.store');

        Route::apiResource('banners', BannerController::class);

        // Banner Banner Images
        Route::get('/banners/{banner}/banner-images', [
            BannerBannerImagesController::class,
            'index',
        ])->name('banners.banner-images.index');
        Route::post('/banners/{banner}/banner-images', [
            BannerBannerImagesController::class,
            'store',
        ])->name('banners.banner-images.store');

        Route::apiResource('banner-images', BannerImageController::class);
    });