<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'ext_code',
        'municipality_id',
        'name',
        'sequence',
        'laditude',
        'longitude',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
    ];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function salesRequestLocations()
    {
        return $this->hasMany(SalesRequestLocation::class);
    }
}
