<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ChargeRequestCollectMoney extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sales_request_id',
        'sales_people_id',
        'amount',
        'commission_amount',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'charge_request_collect_monies';

    public function salesRequest()
    {
        return $this->belongsTo(SalesRequest::class);
    }

    public function salesPeople()
    {
        return $this->belongsTo(SalesPeople::class);
    }
}
