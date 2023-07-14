<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\SourceController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\FloorPlanController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SalesPeopleController;
use App\Http\Controllers\ListingTypeController;
use App\Http\Controllers\MarketplaceController;
use App\Http\Controllers\BannerImageController;
use App\Http\Controllers\CustomerRoleController;
use App\Http\Controllers\DeliveryTimeController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\SalesRequestController;
use App\Http\Controllers\InternalStatusController;
use App\Http\Controllers\AgentAgreementController;
use App\Http\Controllers\SalesLostReasonController;
use App\Http\Controllers\ListingAttachmentController;
use App\Http\Controllers\CustomerAgreementController;
use App\Http\Controllers\SalesRequestListingController;
use App\Http\Controllers\SalesPeopleAgreementController;
use App\Http\Controllers\ListingAdditionalDetailController;
use App\Http\Controllers\SalesRequestAppointmentController;
use App\Http\Controllers\PositionModalController;
use Fosetico\LaravelPageBuilder\LaravelPageBuilder;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/page/home');
})->name('page');

Route::any('/page/{any}', function () {

    $builder = new LaravelPageBuilder(config('pagebuilder'));
    $hasPageReturned = $builder->handlePublicRequest();

    if (request()->path() === '/' && !$hasPageReturned) {
        $builder->getWebsiteManager()->renderWelcomePage();
    }

})->where('any', '.*');

Route::controller(PositionModalController::class)->group(function(){
    Route::get('positionModal', 'index');
});

Route::get('/', function () {
    return redirect('/page/home');
});

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/dashboard', function () {
        return view('dashboard');
    })
    ->name('dashboard');

Route::prefix('/')
    ->middleware(['auth:sanctum', 'verified'])
    ->group(function () {
        Route::resource('roles', RoleController::class);
        Route::resource('permissions', PermissionController::class);

        Route::resource('agents', AgentController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('customer-roles', CustomerRoleController::class);
        Route::resource('delivery-times', DeliveryTimeController::class);
        Route::resource('districts', DistrictController::class);
        Route::resource('features', FeatureController::class);
        Route::resource('internal-statuses', InternalStatusController::class);
        Route::resource('languages', LanguageController::class);
        Route::resource('listings', ListingController::class);
        Route::resource(
            'listing-additional-details',
            ListingAdditionalDetailController::class
        );
        Route::resource(
            'listing-attachments',
            ListingAttachmentController::class
        );
        Route::resource('locations', LocationController::class);
        Route::resource('municipalities', MunicipalityController::class);
        Route::resource('property-types', PropertyTypeController::class);
        Route::get('all-sales-people', [
            SalesPeopleController::class,
            'index',
        ])->name('all-sales-people.index');
        Route::post('all-sales-people', [
            SalesPeopleController::class,
            'store',
        ])->name('all-sales-people.store');
        Route::get('all-sales-people/create', [
            SalesPeopleController::class,
            'create',
        ])->name('all-sales-people.create');
        Route::get('all-sales-people/{salesPeople}', [
            SalesPeopleController::class,
            'show',
        ])->name('all-sales-people.show');
        Route::get('all-sales-people/{salesPeople}/edit', [
            SalesPeopleController::class,
            'edit',
        ])->name('all-sales-people.edit');
        Route::put('all-sales-people/{salesPeople}', [
            SalesPeopleController::class,
            'update',
        ])->name('all-sales-people.update');
        Route::delete('all-sales-people/{salesPeople}', [
            SalesPeopleController::class,
            'destroy',
        ])->name('all-sales-people.destroy');

        Route::resource('sources', SourceController::class);
        Route::resource('statuses', StatusController::class);
        Route::resource('users', UserController::class);
        Route::resource('floor-plans', FloorPlanController::class);
        Route::resource('listing-types', ListingTypeController::class);
        Route::resource('sales-requests', SalesRequestController::class);
        Route::resource(
            'sales-request-appointments',
            SalesRequestAppointmentController::class
        );
        Route::resource(
            'sales-request-listings',
            SalesRequestListingController::class
        );
        Route::resource('agent-agreements', AgentAgreementController::class);
        Route::resource(
            'customer-agreements',
            CustomerAgreementController::class
        );
        Route::resource(
            'sales-people-agreements',
            SalesPeopleAgreementController::class
        );
        Route::resource('marketplaces', MarketplaceController::class);
        Route::resource('sales-lost-reasons', SalesLostReasonController::class);
        Route::resource('banners', BannerController::class);
        Route::resource('banner-images', BannerImageController::class);
    });