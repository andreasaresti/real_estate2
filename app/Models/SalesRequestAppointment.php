<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequestAppointment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sales_request_id',
        'listing_id',
        'date',
        'status',
        'signed',
        'date_signed',
        'signature',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_request_appointments';

    protected $casts = [
        'date' => 'datetime',
        'signed' => 'boolean',
        'date_signed' => 'datetime',
    ];

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }

    public function salesRequest()
    {
        return $this->belongsTo(SalesRequest::class);
    }
}
