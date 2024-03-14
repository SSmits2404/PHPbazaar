<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $primaryKey = 'owner_id';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $fillable = ['url', 'owner_id'];
}
