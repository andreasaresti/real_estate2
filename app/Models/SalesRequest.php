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
        'property_type_id',
        'minimum_budget',
        'maximum_budget',
        'minimum_size',
        'maximum_size',
        'minimum_bedrooms',
        'minimum_bathrooms',
        'description',
        'assigned',
        'sales_people_id',
        'accepted_status',
        'status',
        'active',
        'listing_id',
        'agreement_price',
        'agency_percentage',
        'salespeople_percentage',
        'sales_lost_reason_id',
        'intermediate_percentage',
        'final_status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_requests';

    protected $casts = [
        'date' => 'date',
        'assigned' => 'boolean',
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

    public function salesRequestLocations()
    {
        return $this->hasMany(SalesRequestLocation::class, 'salesRequest_id');
    }

    public function salesRequestDistricts()
    {
        return $this->hasMany(SalesRequestDistrict::class, 'salesRequest_id');
    }

    public function salesRequestMunicipalities()
    {
        return $this->hasMany(
            SalesRequestMunicipality::class,
            'salesRequest_id'
        );
    }

    public function salesRequestListingTypes()
    {
        return $this->hasMany(SalesRequestListingType::class);
    }

    public function salesRequestAppointments()
    {
        return $this->hasMany(SalesRequestAppointment::class);
    }

    public function salesRequestListings()
    {
        return $this->hasMany(SalesRequestListing::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function salesLostReason()
    {
        return $this->belongsTo(SalesLostReason::class);
    }
}
