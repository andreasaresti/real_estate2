<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Feature extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['ext_code', 'image', 'name', 'sequence'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
    ];

    public function listings()
    {
        return $this->belongsToMany(Listing::class);
    }
}
