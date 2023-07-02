<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class IntermediateAgent extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\IntermediateAgent::class;

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

            Text::make('Address')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Address'),

            Text::make('City')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('City'),

            Text::make('Country')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Country'),

            Text::make('Telephone')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Telephone'),

            Text::make('Email')
                ->rules('nullable', 'email')
                ->placeholder('Email'),

            Text::make('Website')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Website'),

            HasMany::make('SalesRequests', 'salesRequests'),
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
