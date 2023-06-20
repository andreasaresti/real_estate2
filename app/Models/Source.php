<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Source extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'website', 'sequence'];

    protected $searchableFields = ['*'];

    public function salesRequests()
    {
        return $this->hasMany(SalesRequest::class);
    }
}
