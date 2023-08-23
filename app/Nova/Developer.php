<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Developer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Developer::class;

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
        'CustomerRole' => ['name'],
    ];
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

            Text::make('Ext Code')
                ->creationRules(
                    'nullable',
                    'unique:customers,ext_code',
                    'max:255',
                    'string'
                )
                ->updateRules(
                    'nullable',
                    'unique:customers,ext_code,{{resourceId}}',
                    'max:255',
                    'string'
                )
                ->placeholder('Ext Code')
                ->hideFromIndex(),

            Text::make('Name')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Name'),

            Image::make('Image')
                ->rules('nullable', 'image', 'max:1024')
                ->placeholder('Image')
                ->hideFromIndex(),

            Text::make('Email')
                ->creationRules('required', 'email')
                ->updateRules(
                    'required',
                    'unique:customers,email,{{resourceId}}',
                    'email'
                )
                ->placeholder('Email'),

            Text::make('Mobile')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Mobile'),

            Text::make('Phone')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Phone')
                ->hideFromIndex(),

            Text::make('Address')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Address')
                ->hideFromIndex(),

            Text::make('Postal Code')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Postal Code')
                ->hideFromIndex(),

            Text::make('City')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('City')
                ->hideFromIndex(),

            Text::make('District')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('District')
                ->hideFromIndex(),

            Country::make('Country')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Country')
                ->hideFromIndex()
                ->default('CY'),

            Trix::make('Notes')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Notes')
                ->hideFromIndex(),

            HasMany::make('Listings', 'listings'),
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
