<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Listing extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'ext_code',
        'name',
        'image',
        'parent_id',
        'description',
        'price',
        'old_price',
        'price_prefix',
        'price_postfix',
        'area_size',
        'area_size_prefix',
        'area_size_postfix',
        'number_of_bedrooms',
        'number_of_bathrooms',
        'number_of_garages_or_parkingpaces',
        'year_built',
        'featured',
        'published',
        'address',
        'latitude',
        'longitude',
        '360_virtual_tour',
        'energy_class',
        'energy_performance',
        'epc_current_rating',
        'epc_potential_rating',
        'taxes',
        'dues',
        'notes',
        'location_id',
        'status_id',
        'delivery_time_id',
        'internal_status_id',
        'owner_id',
        'agent_id',
        'map',
        'export_all_marketplaces',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'featured' => 'boolean',
        'published' => 'boolean',
        'export_all_marketplaces' => 'boolean',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class, 'parent_id');
    }

    public function listings()
    {
        return $this->hasMany(Listing::class, 'parent_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function deliveryTime()
    {
        return $this->belongsTo(DeliveryTime::class);
    }

    public function internalStatus()
    {
        return $this->belongsTo(InternalStatus::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'owner_id');
    }

    public function listingAttachments()
    {
        return $this->hasMany(ListingAttachment::class);
    }

    public function listingAdditionalDetails()
    {
        return $this->hasMany(ListingAdditionalDetail::class);
    }

    public function floorPlans()
    {
        return $this->hasMany(FloorPlan::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function salesRequestAppointments()
    {
        return $this->hasMany(SalesRequestAppointment::class);
    }

    public function salesRequestListings()
    {
        return $this->hasMany(SalesRequestListing::class);
    }

    public function salesRequests()
    {
        return $this->hasMany(SalesRequest::class);
    }

    public function favoriteProperties()
    {
        return $this->hasMany(FavoriteProperty::class);
    }

    public function marketplaces()
    {
        return $this->belongsToMany(Marketplace::class);
    }

    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function listingTypes()
    {
        return $this->belongsToMany(ListingType::class);
    }
}
