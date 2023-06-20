<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FloorPlan extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'listing_id',
        'name',
        'image',
        'description',
        'sequence',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'floor_plans';

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
