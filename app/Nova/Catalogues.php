<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use App\Nova\Feed;
use Laravel\Nova\Http\Requests\NovaRequest;

class Catalogues extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Catalogues>
     */
    public static $model = \App\Models\Catalogues::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('required', 'max:255', 'string')
                ->sortable()
                ->placeholder('Name'),

            Text::make('Token')
                ->rules('required', 'unique', 'max:255', 'string')
                ->sortable()
                ->placeholder('Token'),
                


            BelongsTo::make('Feed_Id', 'feed_id', Feed::class)
                ->nullable()
                ->sortable(),
                

            Text::make('Export Type')
                ->rules('required', 'max:255', 'string')
                ->default('json')
                ->placeholder('Export Type'),

            Boolean::make('Active')
                ->rules('boolean')
                ->default(true),

            Date::make('Created At')
                ->rules('nullable', 'date')
                ->placeholder('Created At'),

            Date::make('Updated At')
                ->rules('nullable', 'date')
                ->placeholder('Updated At'),

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
