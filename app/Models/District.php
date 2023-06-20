<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class District extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['ext_code', 'country', 'name'];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'array',
    ];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }

    public function salesRequestDistricts()
    {
        return $this->hasMany(SalesRequestDistrict::class);
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
