<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class PropertyType extends Model
{
    use HasFactory;
    use Searchable;
	use HasTranslations;
	
	public $translatable = ['name'];

    protected $fillable = ['ext_code', 'name', 'color', 'sequence'];

    protected $searchableFields = ['*'];

    protected $table = 'property_types';

    protected $casts = [
        'name' => 'array',
    ];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
