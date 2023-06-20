<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'ext_code',
        'name',
        'email',
        'phone',
        'image',
        'address',
        'postal_code',
        'city',
        'map',
        'country',
        'comments',
        'active',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function salesPeople()
    {
        return $this->hasMany(SalesPeople::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class,'agent_property_type','agent_id','agent_id');
    }
    public function agentAgreement()
    {
        return $this->hasMany(AgentAgreement::class);
    }
}

