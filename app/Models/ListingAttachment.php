<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ListingAttachment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['listing_id', 'name', 'attachment'];

    protected $searchableFields = ['*'];

    protected $table = 'listing_attachments';

    public function listing()
    {
        return $this->belongsTo(Listing::class);
    }
}
