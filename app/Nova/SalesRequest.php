<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

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

            Text::make('Name')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Name'),

            Date::make('Date')
                ->rules('required', 'date')
                ->placeholder('Date'),

            Number::make('Minimum Budget')
                ->rules('nullable', 'numeric')
                ->placeholder('Minimum Budget'),

            Number::make('Maximum Budget')
                ->rules('nullable', 'numeric')
                ->placeholder('Maximum Budget'),

            Textarea::make('Description')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Description'),

            Boolean::make('Active')
                ->rules('required', 'boolean')
                ->placeholder('Active')
                ->default('1'),

            BelongsTo::make('Customer', 'customer'),

            BelongsTo::make('Source', 'source'),

            BelongsTo::make('SalesPeople', 'salesPeople')->nullable(),

            BelongsTo::make('PropertyType', 'propertyType'),

            HasMany::make('SalesRequestLocations', 'salesRequestLocations'),

            HasMany::make('SalesRequestDistricts', 'salesRequestDistricts'),

            HasMany::make(
                'SalesRequestMunicipalities',
                'salesRequestMunicipalities'
            ),

            HasMany::make(
                'SalesRequestListingTypes',
                'salesRequestListingTypes'
            ),

            HasMany::make(
                'SalesRequestAppointments',
                'salesRequestAppointments'
            ),
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
