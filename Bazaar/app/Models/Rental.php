<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    // Specify which attributes can be mass assignable
    protected $table = 'rentals';
    protected $fillable = ['advert_id', 'renter_id', 'start_date', 'end_date'];

    /**
     * Get the advert associated with the rental.
     */
    public function advert()
    {
        return $this->belongsTo(Advert::class, 'advert_id');
    }

    /**
     * Get the user (renter) associated with the rental.
     */
    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }
}
