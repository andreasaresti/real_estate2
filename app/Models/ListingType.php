<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['ext_code', 'name', 'image', 'sequence'];

    protected $searchableFields = ['*'];

    protected $table = 'listing_types';

    protected $casts = [
        'name' => 'array',
    ];

    public function salesRequestListingTypes()
    {
        return $this->hasMany(SalesRequestListingType::class);
    }

    public function allSalesPeople()
    {
        return $this->belongsToMany(SalesPeople::class);
    }

    public function listings()
    {
        return $this->belongsToMany(Listing::class);
    }
}
