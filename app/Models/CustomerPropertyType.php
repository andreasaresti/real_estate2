<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerPropertyType extends Model
{
    use HasFactory;
    use Searchable;


    protected $searchableFields = ['*'];

    public function propertyType()
    {
        return $this->belongsTo(propertyType::class);
    }
    public function customer()
    {
        return $this->belongsTo(customer::class);
    }
}

