<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvertComments extends Model
{
    protected $table = 'AdvertComments';
    protected $primaryKey = 'id';
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer');
    }
    public function Advert()
    {
        return $this->belongsTo(User::class, 'advert');
    }
    protected $fillable = ['reviewer, advert, review'];
}
