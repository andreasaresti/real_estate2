<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Location extends Model
{
    use HasFactory;
    use Searchable;
	use HasTranslations;
	
	public $translatable = ['name'];

    protected $fillable = [
        'municipality_id',
        'name',
        'ext_code',
        'sequence',
        'municipality_id',
        'longitude', 
        'latitude'
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
    ];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function listingRequest()
    {
        return $this->belongsTo(ListingRequest::class, 'listingRequest_id');
    }
}
