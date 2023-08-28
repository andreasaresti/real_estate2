<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ListingFeed extends Model
{
    use HasFactory;

    protected $table = 'listing_feed';

    public function feed()
    {
        return $this->belongsTo(Feed::class, 'feed_id');
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'listing_id');
    }
}
