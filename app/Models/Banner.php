<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Banner extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'image', 'title', 'description', 'active'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'title' => 'array',
        'active' => 'boolean',
    ];

    public function bannerImages()
    {
        return $this->hasMany(BannerImage::class);
    }
}
