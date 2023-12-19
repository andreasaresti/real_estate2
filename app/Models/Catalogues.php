<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalogues extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'token',
        'feed_id',
        'export_type',
        'active',
        'created_at',
        'updated_at'
    ];

    public function feed_id()
    {
        return $this->belongsTo(Feed::class);
    }
}
