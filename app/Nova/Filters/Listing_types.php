<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class Listing_types extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $name = 'Listing Types';

    public $component = 'select-filter';

    /**
     * Apply the filter to the given query.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  mixed  $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function apply(NovaRequest $request, $query, $value)
    {
        return $query->join('listing_listing_type', 'listings.id', '=', 'listing_listing_type.listing_id')
                     ->where('listing_listing_type.listing_type_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        //$result = DB::table('listing_types')->select('id','name')->pluck('id', 'name')->toArray();
        //$array = ['12'=>'{"en":"Apartment Building","gr":"ddd"}','32'=>'{"en":"Flat"}','53'=>'{"en":"House"}','34'=>'{"en":"Land"}','15'=>'{"en":"Office"}','36'=>'{"en":"Plot"}','27'=>'{"en":"Shop"}'];
        // foreach($array as $key => $helparray){
        //     $newarray = json_decode($helparray, true);
        //     $first_key = array_key_first($newarray);
        //     $array[$key] = $newarray[$first_key];
        //  }
        $result = array();
        $array = \DB::select('SELECT id, name FROM listing_types');
        for($i=0;$i<count($array);$i++){
            $newarray = json_decode($array[$i]->name,true);
            $first_key = array_key_first($newarray);
            $result = Arr::add($result, $newarray[$first_key] , $array[$i]->id);
        }
        return $result;
    }
}
