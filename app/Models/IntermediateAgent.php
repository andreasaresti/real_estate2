<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class IntermediateAgent extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'address',
        'city',
        'country',
        'telephone',
        'email',
        'website',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'intermediate_agents';

    public function salesRequests()
    {
        return $this->hasMany(SalesRequest::class);
    }
}
