<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequestListing extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sales_request_id',
        'listing_id',
        'notes',
        'status',
        'emailed',
        'active',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_request_listings';

    protected $casts = [
        'emailed' => 'boolean',
        'active' => 'boolean',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
    public function salesRequest()
    {
        return $this->belongsTo(SalesRequest::class);
    }
}
