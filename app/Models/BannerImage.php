<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BannerImage extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'banner_id',
        'image',
        'name',
        'description',
        'button_text',
        'link',
        'sort_order',
        'language_id',
        'active',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'banner_images';

    protected $casts = [
        'name' => 'array',
        'button_text' => 'array',
        'active' => 'boolean',
    ];

    public function language()
    {
        return $this->belongsTo(Language::class);
    }

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
}
