<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingRequest extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'date_created',
        'customer_id',
        'source_id',
        'sales_people_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'listing_requests';

    protected $casts = [
        'date_created' => 'datetime',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function source()
    {
        return $this->belongsTo(Source::class);
    }

    public function requestAppointments()
    {
        return $this->hasMany(RequestAppointment::class, 'listingRequest_id');
    }

    public function salesPeople()
    {
        return $this->belongsTo(SalesPeople::class);
    }
}
