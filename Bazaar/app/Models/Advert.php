<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    
    protected $table = 'adverts';
    protected $primaryKey = 'id';
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $fillable = ['user_id', 'price','advertisement_text','title'];
}