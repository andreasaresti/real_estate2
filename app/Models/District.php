<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class District extends Model
{
    use HasFactory;
    use Searchable;
	use HasTranslations;
	
	public $translatable = ['name'];

    protected $fillable = ['ext_code', 'country', 'name', 'listingRequest_id'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
    ];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function listingRequest()
    {
        return $this->belongsTo(ListingRequest::class, 'listingRequest_id');
    }
}
