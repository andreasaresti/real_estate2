<?php

namespace App\Nova;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class Marketplace extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Marketplace::class;

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
				->rules('required', 'max:255')
                ->placeholder('Name')
                ->sortable(),

            Select::make('Export')
				->rules('required', 'max:255')
                ->placeholder('Export')
                ->options(['xml' => 'XML', 'csv' => 'CSV', 'json' => 'JSON'])
                ->sortable(),

            Boolean::make('Reissue Key')
                ->rules('nullable', 'boolean')
                ->placeholder('Reissue Key')
                ->default(false)
                ->sortable(),
                
            Text::make('Feedkey')
				->rules('nullable', 'max:255')
                ->placeholder('Feedkey')
                ->sortable(),

            BelongsTo::make('Feed', 'feed')
                ->nullable()
                ->showCreateRelationButton()
                ->display(function ($feed) {
                    return $feed->name;
                })
                ->hideFromIndex(),

            Boolean::make('Active')
                ->rules('nullable', 'boolean')
                ->placeholder('Active')
                ->default(true)
                ->sortable(),	
            
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