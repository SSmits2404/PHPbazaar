<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Advert extends Model
{
    
    protected $table = 'adverts';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    protected $fillable = ['user_id', 'price','advertisement_text','title','expires_at','bid','bidder_id','advert_type' , 'afbeelding', 'company_id', 'sold', 'isrental', 'durability', 'wear'];

    public function status()
    {
        if (!$this->sold) {
            return __('sold');
        }
        if ($this->isrental) {
            return __('rental');
        }
        if($this->advert_type == __('auction')) {
            if($this->expires_at < now()) {
                return __('expired');
            }
            if($this->bid > 0) {
                return __('to the highest bidder');
            }
        }
        return __('unknown');
    }
}