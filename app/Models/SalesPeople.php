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

    public function listingRequests()
    {
        return $this->hasMany(ListingRequest::class);
    }

    public function ListingType(){
        return $this->belongsToMany(ListingType::class,'listing_type_sales_people','sales_people_id','listing_type_id');
    }

    public function PropertyType(){
        return $this->belongsToMany(PropertyType::class,'property_type_sales_people','sales_people_id','property_type_id');
    }

    public function District(){
        return $this->belongsToMany(District::class,'district_sales_people','sales_people_id','district_id');
    }

    public function SalesPeopleAgreement()
    {
        return $this->hasMany(SalesPeopleAgreement::class);
    }
}
