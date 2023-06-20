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

    public function allSalesPeople()
    {
        return $this->hasMany(SalesPeople::class);
    }

    public function salesRequests()
    {
        return $this->hasMany(SalesRequest::class);
    }

    public function customerAgreements()
    {
        return $this->hasMany(CustomerAgreement::class);
    }

    public function favoriteProperties()
    {
        return $this->hasMany(FavoriteProperty::class);
    }
}
