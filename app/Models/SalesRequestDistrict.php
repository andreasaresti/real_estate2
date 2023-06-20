<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequestDistrict extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['salesRequest_id', 'district_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sales_request_districts';

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function salesRequest()
    {
        return $this->belongsTo(SalesRequest::class, 'salesRequest_id');
    }
}
