<?php

namespace App\Nova;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class ListingType extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\ListingType>
     */
    public static $model = \App\Models\ListingType::class;

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
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make('id')->sortable(),

            Text::make('Name')
				->translatable()
                ->rules('required', 'max:255')
                ->placeholder('Name'),

            Text::make('Ext Code')
                ->creationRules(
                    'nullable',
                    'unique:features,ext_code',
                    'max:255',
                    'string'
                )
                ->updateRules(
                    'nullable',
                    'unique:features,ext_code,{{resourceId}}',
                    'max:255',
                    'string'
                )
                ->placeholder('Ext Code')
                ->hideFromIndex(),

            Image::make('Image')
                ->rules('nullable', 'image', 'max:1024')
                ->placeholder('Image'),

            Number::make('Sequence')
                ->rules('required', 'numeric')
                ->placeholder('Sequence')
                ->default('0')
                ->hideFromIndex()
                ->hideFromIndex()
                ->hideWhenCreating()
                ->hideWhenUpdating(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
