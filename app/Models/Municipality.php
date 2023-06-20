<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Municipality extends Model
{
    use HasFactory;
    use Searchable;
	use HasTranslations;
	
	public $translatable = ['name'];

    protected $fillable = [
        'district_id',
        'name',
        'sequence',
        'listingRequest_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function listingRequest()
    {
        return $this->belongsTo(ListingRequest::class, 'listingRequest_id');
    }
}
