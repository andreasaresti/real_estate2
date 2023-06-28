<?php

namespace App\Nova;

use App\Models\SalesRequestMunicipality;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Computed;
use ZiffMedia\NovaSelectPlus\SelectPlus;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\FormData;

class SalesRequest extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SalesRequest::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['name'];

    public static $searchRelations = [
        'Agent' => ['name'],        
        'Customer' => ['name'],        
   ];
   
    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        $listing_arr = [];
        if($this->id != ''){
            $listings = DB::table('listings')
                            ->join('sales_request_listings', 'listings.id', '=', 'sales_request_listings.listing_id')
                            ->select('listings.*')
                            ->where("sales_request_listings.sales_request_id", $this->id)->get();
            $listing_arr = [];
            for ($i = 0; $i < count($listings); $i++){
                $listing_name = json_decode( $listings[$i]->name,true);
                $first_key = array_key_first($listing_name);
                $listing_arr[$listings[$i]->id] = $listing_name[$first_key];
            }  
        }
        
        
        

        return [
            
            ID::make('id')->sortable(),

            
            

            Text::make('Name')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Name'),
            
            Date::make('Date')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Date')
                ->default(now()),

            BelongsTo::make('Customer', 'customer')                
                ->searchable()
                ->showCreateRelationButton(),

            BelongsTo::make('PropertyType', 'propertyType')->showCreateRelationButton(),

            
            SelectPlus::make('District', 'salesRequestDistricts', District::class)->hideFromIndex(),

            SelectPlus::make('ListingType', 'salesRequestListingType', ListingType::class)->hideFromIndex(),

            Number::make('Minimum Budget')
                ->rules('nullable', 'numeric')
                ->placeholder('Minimum Budget')
                ->hideFromIndex(),

            Number::make('Maximum Budget')
                ->rules('nullable', 'numeric')
                ->placeholder('Maximum Budget')
                ->hideFromIndex(),


            SelectPlus::make('Municipality', 'salesRequestMunicipalities', Municipality::class)->hideFromIndex(),

            SelectPlus::make('Location', 'salesRequestLocations', Location::class)->hideFromIndex(),
            
            SelectPlus::make('Features', 'features', Feature::class)->hideFromIndex(),

            Number::make('Minimum Bedrooms')
                ->rules('nullable', 'numeric')
                ->placeholder('Minimum Bedrooms')
                ->hideFromIndex(),
                
            Number::make('Minimum Bathrooms')
                    ->rules('nullable', 'numeric')
                    ->placeholder('Minimum Bathrooms')
                    ->hideFromIndex(),
                    
            Number::make('Minimum Size')
                ->rules('nullable', 'numeric')
                ->placeholder('Minimum Size')
                ->hideFromIndex(),

            Number::make('Maximum Size')
                ->rules('nullable', 'numeric')
                ->placeholder('Maximum Size')
                ->hideFromIndex(),

            Trix::make('Description')
						->rules('nullable')
						->placeholder('Description')
						->hideFromIndex(),

            Boolean::make('Assigned')
                ->rules('nullable', 'boolean')
                ->placeholder('Assigned')
                ->default(false),

            BelongsTo::make('Sales People', 'salesPeople')
                ->nullable()
                ->searchable()
                ->dependsOn(
                    ['assigned'],
                    function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                        if ($formData->assigned === true) {
                            $field->required()->readonly(false)->show();
                        }
                    }
                )
                ->hide()
                ->showCreateRelationButton(),

            Select::make('Accepted Status')
                ->rules('nullable', 'max:255', 'string')
                ->options([
                    'no' => 'No',
                    'yes' => 'Yes',
                ])
                ->dependsOn(
                    ['assigned'],
                    function (Select $field, NovaRequest $request, FormData $formData) {
                        if ($formData->assigned === true) {
                            $field->required()->readonly(false)->show();
                        }
                    }
                )
                ->hide()
                ->displayUsingLabels()
                ->placeholder('Select Accepted Status')
                ->default('no'),

            BelongsTo::make('Source', 'source') 
                ->rules('required')
                ->showCreateRelationButton(),

            Select::make('Status')
                ->rules('required', 'max:255', 'string')
                ->options([
                    'open' => 'Open',
                    'won' => 'Won',
                    'lost' => 'Lost',
                ])
                ->displayUsingLabels()
                ->placeholder('Select Status')
                ->default('open'),

            Boolean::make('Active')
                ->rules('nullable', 'boolean')
                ->dependsOn(
                    ['status'],
                    function (Boolean $field, NovaRequest $request, FormData $formData) {
                        if ($formData->status === 'won' || $formData->status === 'lost') {
                            $field->readonly(true)->hide();
                        }
                    }
                )
                ->placeholder('Active')
                ->default(true),

            // BelongsTo::make('Listing', 'listing')->showCreateRelationButton(),

            Select::make('Listing', 'listing_id')
                ->nullable()
                ->dependsOn(
                        ['status'],
                        function (Select $field, NovaRequest $request, FormData $formData) {
                            if ($formData->status === 'won') {
                                $field->rules(['required'])->show();
                            }
                        }
                    )
                ->hide()
                ->options($listing_arr)
                ->hideFromIndex(),

            Number::make('Agreement Price')
                ->rules('nullable', 'numeric')
                ->dependsOn(
                    ['status'],
                    function (Number $field, NovaRequest $request, FormData $formData) {
                        if ($formData->status === 'won') {
                            $field->readonly(false)->rules(['required'])->show();
                        }
                    }
                )
                ->placeholder('Agreement Price')
                ->hide()
                ->hideFromIndex(),

            Number::make('Salespeople Percentage')
                ->rules('nullable', 'numeric')
                ->placeholder('Salespeople Percentage')
                ->dependsOn(
                    ['status'],
                    function (Number $field, NovaRequest $request, FormData $formData) {
                        if ($formData->status === 'won') {
                            $field->readonly(false)->rules(['required'])->show();
                        }
                    }
                )
                ->default($request->id)
                ->hide()
                ->hideFromIndex(),

            Number::make('Agency Percentage')
                ->rules('nullable', 'numeric')
                ->dependsOn(
                    ['status'],
                    function (Number $field, NovaRequest $request, FormData $formData) {
                        if ($formData->status === 'won') {
                            $field->readonly(false)->rules(['required'])->show();
                        }
                    }
                )
                ->hide()
                ->placeholder('Agency Percentage')
                ->hideFromIndex(),
            
            BelongsTo::make('Sales Lost Reason', 'salesLostReason')
                ->nullable()
                ->dependsOn(
                    ['status'],
                    function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                        if ($formData->status === 'lost') {
                            $field->readonly(false)->rules(['required'])->show();
                        }
                    }
                )
                ->hide()
                ->showCreateRelationButton(),
            

            HasMany::make('Sales Request Appointment', 'salesRequestAppointment'),
            HasMany::make('Sales Request Listing', 'salesRequestListing'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [
            new Filters\RequestSalesPerson(),
            new Filters\RequestStatus(),
            new Filters\RequestType(),
            new Filters\RequestAcceptedStatus(),
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request  $request)
    {
        return [
            Actions\AssignRequest::make()->showInline()
        ];
    }
}
