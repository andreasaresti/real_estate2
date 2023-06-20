<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Listing extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Listing::class;

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

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make('id')->sortable(),

            Textarea::make('Name')
                ->rules('required', 'max:255', 'json')
                ->placeholder('Name'),

            Image::make('Image')
                ->rules('nullable', 'image', 'max:1024')
                ->placeholder('Image'),

            Textarea::make('Description')
                ->rules('nullable', 'max:255', 'json')
                ->placeholder('Description')
                ->hideFromIndex(),

            Number::make('Price')
                ->rules('required', 'numeric')
                ->placeholder('Price')
                ->hideFromIndex(),

            Number::make('Old Price')
                ->rules('nullable', 'numeric')
                ->placeholder('Old Price')
                ->hideFromIndex(),

            Text::make('Price Prefix')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Price Prefix')
                ->hideFromIndex(),

            Text::make('Price Postfix')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Price Postfix')
                ->hideFromIndex(),

            Number::make('Area Size')
                ->rules('nullable', 'numeric')
                ->placeholder('Area Size')
                ->hideFromIndex(),

            Text::make('Area Size Prefix')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Area Size Prefix')
                ->hideFromIndex(),

            Text::make('Area Size Postfix')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Area Size Postfix')
                ->hideFromIndex(),

            Number::make('Number Of Bedrooms')
                ->rules('nullable', 'numeric')
                ->placeholder('Number Of Bedrooms')
                ->hideFromIndex(),

            Number::make('Number Of Bathrooms')
                ->rules('nullable', 'numeric')
                ->placeholder('Number Of Bathrooms')
                ->hideFromIndex(),

            Number::make('Number Of Garages Or Parkingpaces')
                ->rules('nullable', 'numeric')
                ->placeholder('Number Of Garages Or Parkingpaces')
                ->hideFromIndex(),

            Number::make('Year Built')
                ->rules('nullable', 'numeric')
                ->placeholder('Year Built')
                ->hideFromIndex(),

            Boolean::make('Featured')
                ->rules('nullable', 'boolean')
                ->placeholder('Featured'),

            Boolean::make('Published')
                ->rules('required', 'boolean')
                ->placeholder('Published'),

            Text::make('Address')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Address')
                ->hideFromIndex(),

            Number::make('Latitude')
                ->rules('nullable', 'numeric')
                ->placeholder('Latitude')
                ->hideFromIndex(),

            Text::make('Longitude')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Longitude')
                ->hideFromIndex(),

            Textarea::make('360 Virtual Tour')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('360 Virtual Tour')
                ->hideFromIndex(),

            Text::make('Energy Class')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Energy Class')
                ->hideFromIndex(),

            Text::make('Energy Performance')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Energy Performance')
                ->hideFromIndex(),

            Text::make('Epc Current Rating')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Epc Current Rating')
                ->hideFromIndex(),

            Text::make('Epc Potential Rating')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Epc Potential Rating')
                ->hideFromIndex(),

            Text::make('Taxes')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Taxes')
                ->hideFromIndex(),

            Text::make('Dues')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Dues')
                ->hideFromIndex(),

            Textarea::make('Notes')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Notes')
                ->hideFromIndex(),

            BelongsTo::make('Listing', 'listing')->nullable(),

            HasMany::make('Listings', 'listings'),

            BelongsTo::make('Location', 'location')->nullable(),

            BelongsTo::make('Status', 'status')->nullable(),

            BelongsTo::make('DeliveryTime', 'deliveryTime')->nullable(),

            BelongsTo::make('InternalStatus', 'internalStatus')->nullable(),

            BelongsTo::make('Customer', 'customer')->nullable(),

            HasMany::make('ListingAttachments', 'listingAttachments'),

            HasMany::make(
                'ListingAdditionalDetails',
                'listingAdditionalDetails'
            ),

            HasMany::make('FloorPlans', 'floorPlans'),

            BelongsTo::make('Agent', 'agent'),

            HasMany::make(
                'SalesRequestAppointments',
                'salesRequestAppointments'
            ),

            HasMany::make('SalesRequestListings', 'salesRequestListings'),

            BelongsToMany::make('Marketplaces', 'marketplaces'),
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
        return [];
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
    public function actions(Request $request)
    {
        return [];
    }
}
