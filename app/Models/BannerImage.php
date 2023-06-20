<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Outl1ne\NovaSortable\Traits\HasSortableRows;
use Spatie\EloquentSortable\Sortable;
use Spatie\Translatable\HasTranslations;
use Spatie\EloquentSortable\SortableTrait;

class BannerImage extends Model
{
    use HasFactory;
    use Searchable;
    use HasTranslations;
    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
      ];
    

	
	public $translatable = ['name','description'];

    protected $fillable = [
        'banner_id',
        'image',
        'name',
        'description',
        'button_text',
        'link',
        'language_id',
        'sort_order',
        'active',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'banner_images';

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
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
