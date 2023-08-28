<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncludedListingFeed extends Model
{
    use HasFactory;

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }

    public function feed()
    {
        return $this->belongsTo(Feed::class, 'feed_id');
    }
}
