<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlogPost extends Model
{
    use HasFactory;
    use Searchable;

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

    protected $table = 'blog_posts';

    protected $casts = [
        'name' => 'array',
        'publish_on' => 'date',
        'published' => 'boolean',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
