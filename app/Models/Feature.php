<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Feature extends Model
{
    use HasFactory;
    use Searchable;
	use HasTranslations;
	
	public $translatable = ['name'];

    protected $fillable = ['ext_code', 'image', 'name', 'sequence'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
    ];
}
