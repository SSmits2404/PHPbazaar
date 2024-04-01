<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class connectedads extends Model
{
    use HasFactory;

    protected $table = 'connectedads'; // Explicitly defining the table name

    protected $fillable = [
        'subject',
        'connected',
    ];

    /**
     * Relationship to the Advert model for the 'subject'.
     */
    public function subjectAd()
    {
        return $this->belongsTo(Advert::class, 'subject');
    }
}