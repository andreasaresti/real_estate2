<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesPeopleAgreement extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sales_people_id',
        'district_id',
        'property_type_id',
        'salespeople_commission_percentage',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_people_agreements';

    public function salesPeople()
    {
        return $this->belongsTo(SalesPeople::class);
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
