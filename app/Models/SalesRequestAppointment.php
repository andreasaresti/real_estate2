<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequestAppointment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['listing_id', 'date', 'sales_request_id', 'status'];

    protected $searchableFields = ['*'];

    protected $table = 'sales_request_appointments';

    protected $casts = [
        'date' => 'date',
        'date_signed' => 'date',
    ];

    public function salesRequest()
    {
        return $this->belongsTo(SalesRequest::class);
    }

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }


}