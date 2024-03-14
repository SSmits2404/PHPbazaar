<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $table = 'Rental';
    protected $primaryKey = 'id';
    public function advert()
    {
        return $this->belongsTo(User::class, 'advert');
    }
    protected $fillable = ['user, advert, startdate, enddate'];
}
