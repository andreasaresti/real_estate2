<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeatureSalesRequest extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['feature_id', 'sales_request_id'];

    protected $searchableFields = ['*'];

    protected $table = 'feature_sales_request';

    
}
