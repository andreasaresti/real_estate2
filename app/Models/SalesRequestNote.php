<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesRequestNote extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sales_request_id',
        'sales_request_note_type_id',
        'description',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_request_notes';

    public function salesRequest()
    {
        return $this->belongsTo(SalesRequest::class);
    }

    public function salesRequestNoteType()
    {
        return $this->belongsTo(SalesRequestNoteType::class);
    }
}
