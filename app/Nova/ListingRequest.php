<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class ListingRequest extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ListingRequest::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'date_created';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['date_created'];

    public static $searchRelations = [
        'Source' => ['name'],        
        'Customer' => ['name'],
        'SalesPeople' => ['name']
   ];
    /**
     * Indicates if the resource should be displayed in the sidebar.
     *
     * @var bool
     */
    public static $displayInNavigation = false;

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

            Date::make('Date Created')
                ->rules('required', 'date')
                ->placeholder('Date Created'),

            BelongsTo::make('Customer', 'customer'),

            BelongsTo::make('Source', 'source'),

            HasMany::make('Districts', 'districts'),

            HasMany::make('Locations', 'locations'),

            HasMany::make('Municipalities', 'municipalities'),

            HasMany::make('Listings', 'listings'),

            HasMany::make('RequestAppointments', 'requestAppointments'),

            BelongsTo::make('SalesPeople', 'salesPeople')->nullable(),
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
