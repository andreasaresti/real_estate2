<?php

namespace App\Nova;

use App\Models\SalesRequestMunicipality;
use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Fields\Datetime;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Boolean;
use ZiffMedia\NovaSelectPlus\SelectPlus;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\FormData;
use App\Models\Listing;

class SalesRequestAppointment extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SalesRequestAppointment::class;

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
        // $listing_arr = ['1' =>'232323','2' =>'2323232'];

        return [
            ID::make('id')->sortable(),

            BelongsTo::make('Sales Request', 'salesRequest'),
            BelongsTo::make('Listing', 'listing')->hideWhenCreating()->hideWhenUpdating(),

            Select::make('Listing', 'listing_id')
                ->required()
                ->dependsOn(
                        ['salesRequest'],
                        function (Select $field, NovaRequest $request, FormData $formData) {

                            $listings = DB::table('listings')
                                        ->join('sales_request_listings', 'listings.id', '=', 'sales_request_listings.listing_id')
                                        ->select('listings.*')
                                        ->where("sales_request_listings.sales_request_id", $formData->salesRequest)->get();
                            $listing_arr = [];
                            for ($i = 0; $i < count($listings); $i++){
                                $listing_name = json_decode( $listings[$i]->name,true);
                                $first_key = array_key_first($listing_name);
                                $listing_arr[$listings[$i]->id] = $listing_name[$first_key];
                            }
                            $field->options($listing_arr);
                        }
                    )
                // ->options($listing_arr)
                ->hideFromIndex(),

            DateTime::make('Date')
                ->rules('required', 'max:255', 'string')
                ->placeholder('Date'),

            Select::make('Status')
                ->rules('nullable', 'max:255', 'string')
                ->options([
                    'open' => 'Open',
                    'completed' => 'Completed',
                    'cancelled' => 'Cancelled',
                ])
                ->displayUsingLabels()
                ->placeholder('Type')
                ->default('open')
                ->hideFromIndex(),

            Boolean::make('Signed')
                ->rules('nullable', 'boolean')
                ->placeholder('Signed')
                ->default(false),

            DateTime::make('Date Signed')
                ->rules('nullable', 'max:255', 'string')
                ->dependsOn(
                    ['signed'],
                    function (DateTime $field, NovaRequest $request, FormData $formData) {
                        if ($formData->signed === true) {
                            $field->rules(['required'])->show();
                        }
                    }
                )
                ->hide()
                ->placeholder('Date Signed')
                ->hideFromIndex(),

            Image::make('Signature')
                ->rules('nullable', 'image', 'max:1024')
                ->dependsOn(
                    ['signed'],
                    function (Image $field, NovaRequest $request, FormData $formData) {
                        if ($formData->signed === true) {
                            $field->rules(['required'])->show();
                        }
                    }
                )
                ->hide()
                ->placeholder('Image')
                ->hideFromIndex(),

            
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
