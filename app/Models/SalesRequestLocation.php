<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequestLocation extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['salesRequest_id', 'location_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sales_request_locations';

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function salesRequest()
    {
        return $this->belongsTo(SalesRequest::class, 'salesRequest_id');
    }
}
