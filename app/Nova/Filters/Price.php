<?php

namespace App\Nova\Filters;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use DigitalCreative\RangeInputFilter\RangeInputFilter;

class Price extends RangeInputFilter
{
    public $name = 'Price range';

    public function apply(Request $request, $query, $value)
    {
        // $value will always be [ "from" => ?, "to" => ? ]
        if($value["from"] && $value["to"]){
            return $query->where('price','>=', $value["from"])
                        ->where('price','<=', $value["to"]);
        }
    }
    
    public function options(Request $request) : array
    {
        return [
            'fromPlaceholder' => 1,
            'toPlaceholder' => 6000000,
            'dividerLabel' => 'to',
        ];
    }
}