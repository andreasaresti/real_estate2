<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequestNoteType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    protected $table = 'sales_request_note_types';

    public function SalesRequestNote()
    {
        return $this->hasMany(SalesRequestNote::class);
    }
}
