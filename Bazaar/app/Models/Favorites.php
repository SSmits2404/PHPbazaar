<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorites extends Model
{
    protected $table = 'Favorites';
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class, 'user');
    }
    protected $fillable = ['user, advert, added'];
}
