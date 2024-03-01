<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComments extends Model
{
    protected $table = 'UserComments';
    protected $primaryKey = 'id';
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer');
    }
    public function reviewee()
    {
        return $this->belongsTo(User::class, 'reviewee');
    }
    protected $fillable = ['reviewer, reviewee, review'];
}
