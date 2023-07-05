<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequest extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'date',
        'customer_id',
        'source_id',
        'sales_people_id',
        'property_type_id',
        'minimum_budget',
        'maximum_budget',
        'minimum_bedrooms',
        'maximum_bedrooms',
        'minimum_bathrooms',
        'maximum_bathrooms',
        'minimum_size',
        'maximum_size',
        'intermediate_percentage',
        'intermediate_agent_id',
        'intermediate_amount',
        'budget',
        'description',
        'salesRequestStatus_id',
        'sales_lost_reason_id',
        'active',
        'sales_request_districts',
        'sales_request_listing_types',
        'sales_request_locations',
        'sales_request_municipalities'
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_requests';

    protected $casts = [
        'date' => 'date',
        'active' => 'boolean',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }


    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function salesPeople()
    {
        return $this->belongsTo(SalesPeople::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function salesLostReason()
    {
        return $this->belongsTo(SalesLostReason::class);
    }

    public function intermediateAgent()
    {
        return $this->belongsTo(IntermediateAgent::class);
    }



    public function salesRequestLocations()
    {
        return $this->belongsToMany(Location::class, 'sales_request_locations', 'salesRequest_id', 'location_id');
    }

    public function salesRequestListingType()
    {
        return $this->belongsToMany(ListingType::class, 'sales_request_listing_types', 'sales_request_id', 'listing_type_id');
    }
    public function salesRequestStatus()
    {
        return $this->belongsTo(
            SalesRequestStatus::class,
            'salesRequestStatus_id'
        );
    }

    public function salesRequestDistricts()
    {
        return $this->belongsToMany(District::class, 'sales_request_districts', 'salesRequest_id', 'district_id');
    }

    public function salesRequestMunicipalities()
    {
        return $this->belongsToMany(Municipality::class, 'sales_request_municipalities', 'salesRequest_id', 'municipality_id');
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class, 'feature_sales_request', 'sales_request_id', 'feature_id');
    }

    public function salesRequestAppointment()
    {
        return $this->hasMany(SalesRequestAppointment::class);
    }

    public function salesRequestListing()
    {
        return $this->hasMany(SalesRequestListing::class);
    }

    public function chargeRequestCollectMoney()
    {
        return $this->hasMany(ChargeRequestCollectMoney::class);
    }
    public function SalesRequestNote()
    {
        return $this->hasMany(SalesRequestNote::class);
    }
}