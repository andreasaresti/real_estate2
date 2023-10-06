<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Agent extends Model implements Sortable
{
    use HasFactory;
    use Searchable;

    use SortableTrait;

    public $sortable = [
        'order_column_name' => 'sort_order',
        'sort_when_creating' => true,
    ];

    protected $fillable = [
        'ext_code',
        'name',
        'email',
        'phone',
        'image',
        'address',
        'postal_code',
        'city',
        'country',
        'comments',
        'active',
        'longitude',
        'latitude',
        'district_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function allSalesPeople()
    {
        return $this->hasMany(SalesPeople::class);
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function agentAgreements()
    {
        return $this->hasMany(AgentAgreement::class);
    }
}
