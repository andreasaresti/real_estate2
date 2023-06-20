<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequestMunicipality extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['salesRequest_id', 'municipality_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sales_request_municipalities';

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }

    public function salesRequest()
    {
        return $this->belongsTo(SalesRequest::class, 'salesRequest_id');
    }
}
