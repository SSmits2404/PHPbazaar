<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
      /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pdf_file',
        'approved',
        'subject_user_id', 

    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'approved' => 'boolean',
    ];

    /**
     * Get the user associated with the contract.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'subject_user_id');
    }
}
