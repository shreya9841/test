<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transac extends Model
{
    protected $fillable = [
        'user_id',
        'item',
        'amount',
        'details',
        
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
