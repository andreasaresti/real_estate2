<?php

namespace App\Nova;

use App\Models\SalesRequestMunicipality;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Datetime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use ZiffMedia\NovaSelectPlus\SelectPlus;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class SalesRequestListing extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SalesRequestListing::class;

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

            BelongsTo::make('Sales Request', 'salesRequest'),
            BelongsTo::make('Listing', 'listing')->searchable(),

            Trix::make('Notes')
						->rules('nullable')
						->placeholder('notes')
						->hideFromIndex(),

            Select::make('Status')
                        ->rules('required', 'max:255', 'string')
                        ->options([
                            'open' => 'Open',
                            'not_interested' => 'Not Interested',
                        ])
                        ->displayUsingLabels()
                        ->placeholder('Status')
                        ->default('open'),
                        
            Boolean::make('Emailed')
                ->rules('nullable', 'boolean')
                ->placeholder('Emailed')
                ->default(false),

            Boolean::make('Active')
                ->rules('nullable', 'boolean')
                ->placeholder('Active')
                ->default(true),
            
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
