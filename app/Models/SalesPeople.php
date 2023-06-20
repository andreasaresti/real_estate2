<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesPeople extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['customer_id', 'agent_id', 'name', 'active'];

    protected $searchableFields = ['*'];

    protected $table = 'sales_people';

    protected $casts = [
        'active' => 'boolean',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function salesRequests()
    {
        return $this->hasMany(SalesRequest::class);
    }

    public function salesPeopleAgreements()
    {
        return $this->hasMany(SalesPeopleAgreement::class);
    }

    public function listingTypes()
    {
        return $this->belongsToMany(ListingType::class);
    }

    public function districts()
    {
        return $this->belongsToMany(District::class);
    }

    public function propertyTypes()
    {
        return $this->belongsToMany(PropertyType::class);
    }
}
