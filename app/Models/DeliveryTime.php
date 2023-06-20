<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryTime extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['ext_code', 'name', 'image', 'color', 'sequence'];

    protected $searchableFields = ['*'];

    protected $table = 'delivery_times';

    protected $casts = [
        'name' => 'array',
    ];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }
}
