<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Http\Requests\NovaRequest;

class IncludedListingFeed extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\IncludedListingFeed>
     */
    public static $model = \App\Models\IncludedListingFeed::class;

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

            BelongsTo::make('Feed', 'feed')
                ->required()
                ->showCreateRelationButton()
                ->display(function ($feed) {
                    return $feed->name;
                }),

            BelongsTo::make('Listing', 'listing')
                ->required()
                ->searchable()
                ->showCreateRelationButton(),
                
            Boolean::make('Schedule')
                ->rules('nullable', 'boolean')
                ->placeholder('Schedule')
                ->default(true)
                ->sortable(),

            Date::make('Start Date')
                ->rules('nullable', 'date')
                ->dependsOn(
                        ['schedule'],
                        function (Date $field, NovaRequest $request, FormData $formData) {
                            $field->readonly(true)->rules(['nullable'])->hide();
                            if ($formData->schedule === true) {
                                $field->readonly(false)->rules(['required'])->show();
                            }
                        }
                    )
                ->hide()
                ->placeholder('Start Date')
                ->sortable(),

            Select::make('Number of Days')
                ->rules('nullable', 'max:255', 'string')
                ->options([''=>'Never Expires', '7'=>'7 days', '14'=>'14 days', '21'=>'21 days'])
                ->dependsOn(
                    ['schedule'],
                    function (Select $field, NovaRequest $request, FormData $formData) {
                        $field->readonly(true)->rules(['nullable'])->hide();
                        if ($formData->schedule === true) {
                            $field->readonly(false)->show();
                        }
                    }
                )
                ->hide()
                ->placeholder('Select Number of Days')
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
