<?php

namespace App\Nova;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class ListingAdditionalDetail extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ListingAdditionalDetail::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = ['title'];
    public static $searchRelations = [
        'Listing' => ['name'],           
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

            Text::make('Title')
                ->translatable(DB::table('languages')->select('encoding','name')->orderBy('sequence')->pluck('name', 'encoding')->toArray())
                ->rules('required', 'max:255')
                ->placeholder('Title'),

            Text::make('Value')
                ->translatable(DB::table('languages')->select('encoding','name')->orderBy('sequence')->pluck('name', 'encoding')->toArray())
                ->rules('required', 'max:255')
                ->placeholder('Value'),

            Number::make('Sequence')
                ->rules('required', 'numeric')
                ->placeholder('Sequence')
                ->default('0')
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make('Listing', 'listing'),
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
