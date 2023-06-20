<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Translatable\HasTranslations;

class Page extends Model
{
    use HasFactory;
    use Searchable;
	use HasTranslations;
	
	public $translatable = [];

    protected $fillable = [
        'name',
        'layout',
        'data',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'title' => 'array',
        'description' => 'array',
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'parent_page_id');
    }

    public function layout()
    {
        return $this->belongsTo(Layout::class);
    }

    public function pages()
    {
        return $this->hasMany(Page::class, 'parent_page_id');
    }
}
