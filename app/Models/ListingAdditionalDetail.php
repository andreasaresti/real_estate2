<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class ListingAdditionalDetail extends Model
{
    use HasFactory;
    use Searchable;
	use HasTranslations;
	
	public $translatable = ['title','value'];

    protected $fillable = ['title', 'value', 'listing_id', 'sequence'];

    protected $searchableFields = ['*'];

    protected $table = 'listing_additional_details';

    protected $casts = [
        'title' => 'array',
        'value' => 'array',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
