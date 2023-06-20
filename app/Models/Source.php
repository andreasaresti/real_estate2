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

    public function listingRequests()
    {
        return $this->hasMany(ListingRequest::class);
    }

    public function source()
    {
        return $this->hasMany(Source::class);
    }
}
