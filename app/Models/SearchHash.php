<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SearchHash extends Model
{
    use HasFactory;

    protected $fillable = ['hash', 'info'];


    protected $table = 'search_hash';
}
