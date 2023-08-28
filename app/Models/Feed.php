<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feed extends Model
{
    use HasFactory;

    public function listingFeed(){
        return $this->hasMany(ListingFeed::class);
    }

   
    public function includedListingFeed()
    {
        return $this->hasMany(IncludedListingFeed::class);
    }
}
