<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use ZiffMedia\NovaSelectPlus\SelectPlus;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class SalesPeople extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SalesPeople::class;

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
        'Agent' => ['name'],        
        'Customer' => ['name'],        
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

            Text::make('Name')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Name'),

            SelectPlus::make('Property Type', 'PropertyType', PropertyType::class)->hideFromIndex(),

            SelectPlus::make('Department', 'ListingType', ListingType::class)->hideFromIndex(),

            SelectPlus::make('District', 'District', District::class)->hideFromIndex(),
            
            BelongsTo::make('Customer', 'customer')->showCreateRelationButton(),

            BelongsTo::make('Agent', 'agent')->showCreateRelationButton(),

            Boolean::make('Active')
                ->rules('required', 'boolean')
                ->placeholder('Active')
                ->default('1'),
            
            HasMany::make('Sales People Agreement', 'SalesPeopleAgreement'),
            
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
