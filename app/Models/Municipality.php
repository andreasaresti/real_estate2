<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Municipality extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['ext_code', 'district_id', 'name', 'sequence'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function salesRequestMunicipalities()
    {
        return $this->hasMany(SalesRequestMunicipality::class);
    }
}
