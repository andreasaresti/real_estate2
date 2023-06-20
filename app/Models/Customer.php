<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'ext_code',
        'type',
        'name',
        'surname',
        'company_name',
        'image',
        'email',
        'password',
        'mobile',
        'phone',
        'address',
        'postal_code',
        'city',
        'district',
        'country',
        'notes',
        'customer_role_id',
    ];

    protected $searchableFields = ['*'];

    protected $hidden = ['password'];

    public function listings()
    {
        return $this->hasMany(Listing::class, 'owner_id');
    }

    public function customerRole()
    {
        return $this->belongsTo(CustomerRole::class);
    }

    public function salesPeople()
    {
        return $this->hasMany(SalesPeople::class);
    }

    public function listingRequests()
    {
        return $this->hasMany(ListingRequest::class);
    }
    public function CustomerPropertyType()
    {
        return $this->hasMany(CustomerPropertyType::class);
    }
    public function customerAgreement()
    {
        return $this->hasMany(CustomerAgreement::class);
    }
}
