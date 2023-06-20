<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Banner extends Model
{
    use HasFactory;
    use Searchable;
	use HasTranslations;
	
	public $translatable = ['title','description'];

    protected $fillable = [
        'name',
        'image',
        'title',
        'description',
        'active',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
        'active' => 'boolean',
    ];

    public function bannerImages()
    {
        return $this->hasMany(BannerImage::class);
    }
}
