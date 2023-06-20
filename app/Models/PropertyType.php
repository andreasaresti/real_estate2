<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PropertyType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['ext_code', 'name', 'color', 'sequence'];

    protected $searchableFields = ['*'];

    protected $table = 'property_types';

    protected $casts = [
        'name' => 'array',
    ];

    public function salesRequests()
    {
        return $this->hasMany(SalesRequest::class);
    }

    public function agentAgreements()
    {
        return $this->hasMany(AgentAgreement::class);
    }

    public function salesPeopleAgreements()
    {
        return $this->hasMany(SalesPeopleAgreement::class);
    }

    public function customerAgreements()
    {
        return $this->hasMany(CustomerAgreement::class);
    }

    public function allSalesPeople()
    {
        return $this->belongsToMany(SalesPeople::class);
    }
}
