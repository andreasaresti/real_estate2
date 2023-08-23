<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Listing extends Model implements HasMedia
{
    use HasFactory;
    use Searchable;
	use HasTranslations;
    use InteractsWithMedia;
	
	public $translatable = ['name','description'];

    protected $fillable = [
        'name',
        'ext_code',
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
        'property_type_id',
        'status_id',
        'delivery_time_id',
        'internal_status_id',
        'owner_id',
        'developer_id',
        'listingRequest_id',
        'request_appointment_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
        'description' => 'array',
        'featured' => 'boolean',
        'published' => 'boolean',
    ];

    public function Featured(){
        return $this->belongsToMany(Feature::class,'feature_listing','listing_id','feature_id');
    }

    public function Marketplaces(){
        return $this->belongsToMany(Marketplace::class,'listing_marketplace','listing_id','marketplace_id');
    }

    

    public function ListingType(){
        return $this->belongsToMany(ListingType::class,'listing_listing_type','listing_id','listing_type_id');
    }
    
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

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
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

    public function listingAttachment()
    {
        return $this->hasMany(ListingAttachment::class);
    }

    public function floorPlan()
    {
        return $this->hasMany(FloorPlan::class);
    }

    public function listingAdditionalDetail()
    {
        return $this->hasMany(ListingAdditionalDetail::class);
    }

    public function requestAppointment()
    {
        return $this->belongsTo(RequestAppointment::class);
    }

    public function listingRequest()
    {
        return $this->belongsTo(ListingRequest::class, 'listingRequest_id');
    }
    
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')->useDisk('public');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('large-size')
        ->width(1024)
        ->height(768);
        
        $this->addMediaConversion('medium-size')
        ->width(768)
        ->height(576);

        $this->addMediaConversion('thumb')
        ->width(368)
        ->height(232);
    }
}
