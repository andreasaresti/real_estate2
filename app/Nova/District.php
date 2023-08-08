<?php

namespace App\Nova;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use NormanHuth\IframePopup\IframePopup;

class District extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\District::class;

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
                return '/positionModal?flag=districts&index='.$this->resource->id;
            })->hideWhenCreating()->hideWhenUpdating(),

            ID::make('id')->sortable(),

            Text::make('Name')
				->translatable(DB::table('languages')->select('encoding','name')->orderBy('sequence')->pluck('name', 'encoding')->toArray())
                ->rules('required', 'max:255')
                ->placeholder('Name'),


            Text::make('Ext Code')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Ext Code')
                ->hideFromIndex(),

            Image::make('Image')
				->rules('nullable', 'max:255')
                ->placeholder('Image'),

            Country::make('Country')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Country')
                ->default('CY'),

            Text::make('Latitude')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Latitude')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Text::make('Longitude')
                ->rules('nullable', 'max:255', 'string')
                ->placeholder('Longitude')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            HasMany::make('Municipalities', 'municipalities'),
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