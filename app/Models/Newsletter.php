<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Nova\Fields\Searchable;

class Newsletter extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'surname',
        'email',
        'active',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'name' => 'string',
        'surname' => 'string',
        'email' => 'string',
        'active' => 'boolean',
    ];
}
