<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerAgreement extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'customer_id',
        'district_id',
        'listing_type_id',
        'agency_commission_percentage',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'customer_agreements';

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
