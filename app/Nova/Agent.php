<?php

namespace App\Nova;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use NormanHuth\IframePopup\IframePopup;

class Agent extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Agent::class;

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
            IframePopup::make(__('Position'), 'position', function () {
                return '/positionModal?flag=agencies&index='.$this->resource->id;
            })->hideWhenCreating()->hideWhenUpdating(),

            ID::make('id')->sortable(),

            Text::make('Name')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Name'),

            Text::make('Ext Code')
                ->creationRules(
                    'nullable',
                    'unique:agents,ext_code',
                    'max:255',
                    'string'
                )
                ->updateRules(
                    'nullable',
                    'unique:agents,ext_code,{{resourceId}}',
                    'max:255',
                    'string'
                )
                ->placeholder('Ext Code')
                ->hideFromIndex(),

            Text::make('Email')
                ->rules('nullable', 'email')
                ->placeholder('Email'),

            Text::make('Phone')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Phone'),

            Image::make('Image')
                ->rules('nullable', 'image', 'max:1024')
                ->placeholder('Image'),

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

            BelongsTo::make('District', 'district')->showCreateRelationButton(),

            Country::make('Country')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Country')
                ->default('CY')
                ->hideFromIndex(),

            Text::make('Map')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('map')
                ->hideFromIndex(),

            Trix::make('Comments')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Comments'),

            Boolean::make('Active')
                ->rules('boolean')
                ->placeholder('Active')
                ->default('1'),
                
            Number::make('Sort Order')
                ->rules('nullable', 'numeric')
                ->placeholder('Sort Order')
                ->default('0')
                ->sortable()
                ->hide(),

            // HasMany::make('Agent Agreement', 'agentAgreement'),
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
