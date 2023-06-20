<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyTypeSalesPeople extends Model
{
    use HasFactory;
    use Searchable;


    protected $searchableFields = ['*'];

    public function propertyType()
    {
        return $this->belongsTo(propertyType::class);
    }
    public function salesPeople()
    {
        return $this->belongsTo(SalesPeople::class);
    }
}

