<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class RequestType extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $name = 'Property Type';

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
        return $query->where('property_type_id', $value);
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        $result = array();
        $array = DB::select('SELECT id, name FROM property_types');
        for($i=0;$i<count($array);$i++){
            $newarray = json_decode($array[$i]->name,true);
            $first_key = array_key_first($newarray);
            $result = Arr::add($result, $newarray[$first_key] , $array[$i]->id);//$array[$i]->id, );
        }
        $result = Arr::add($result, 0 , 'No Property Type');
        return $result;
    }
}
