<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class RequestSalesPerson extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $name = 'Sales Person';

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
        return $query->where('sales_people_id', $value);
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
        $array = \DB::select('SELECT id, name FROM sales_people');
        for($i=0;$i<count($array);$i++){
            $result = Arr::add($result, $array[$i]->name , $array[$i]->id);
        }
        return $result;
    }
}
