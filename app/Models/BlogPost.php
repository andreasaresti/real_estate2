<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class BlogPost extends Model
{
    use HasFactory;
    use Searchable;
    use HasTranslations;

    protected $fillable = [
        'blog_id',
        'name',
        'image',
        'description',
        'publish_on',
        'priority',
        'published',
    ];

    protected $searchableFields = ['*'];

    public $translatable = ['name','description'];

    protected $table = 'blog_posts';

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'publish_on' => 'date',
        'published' => 'boolean',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
