<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequestListingType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['sales_request_id', 'listing_type_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sales_request_listing_types';

    public function salesRequest()
    {
        return $this->belongsTo(SalesRequest::class);
    }

    public function listingType()
    {
        return $this->belongsTo(ListingType::class);
    }
}
