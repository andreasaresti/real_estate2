<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeatureListing extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['customer_id', 'listing_id'];

    protected $searchableFields = ['*'];

    protected $table = 'feature_listing';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
