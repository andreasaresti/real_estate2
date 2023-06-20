<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AgentAgreement extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'listing_type_id',
        'agent_id',
        'agency_commission_percentage',
        'salespeople_commission_percentage',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'agent_agreements';

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
