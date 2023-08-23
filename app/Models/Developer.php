<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Developer extends Model
{
    use HasFactory;
    use Searchable;

    

    protected $fillable = [
        'ext_code',
        'name',
        'mobile',
        'phone',
        'postal_code',
        'image',
        'email',
        'address',
        'city',
        'country',
        'latitude',
        'longitude'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'developers';

    public function listings()
    {
        return $this->hasMany(Listing::class, 'developer_id');
    }
  
}
