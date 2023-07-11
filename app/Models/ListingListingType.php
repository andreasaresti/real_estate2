<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingListingType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['listing_type_id', 'listing_id'];

    protected $searchableFields = ['*'];

    protected $table = 'listing_listing_type';

    // public function customer()
    // {
    //     return $this->belongsTo(Customer::class);
    // }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
