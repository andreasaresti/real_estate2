<?php

namespace App\Nova\Filters;

use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class CustomerEmail extends Filter
{
    /**
     * The filter's component.
     *
     * @var string
     */
    public $name = 'With Email';
    
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
        if($value == 'yes'){
            return $query->whereNotNull('email');
        }
        else if($value == 'no'){
            return $query->whereNull('email');
        }
        else{
            return $query;
        }
        
    }

    /**
     * Get the filter's available options.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function options(NovaRequest $request)
    {
        return [
            'yes' => 'With Email',
            'no' => 'Without Email',
        ];
    }
}
