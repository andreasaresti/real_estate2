<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomerRole extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'sequence'];

    protected $searchableFields = ['*'];

    protected $table = 'customer_roles';

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
