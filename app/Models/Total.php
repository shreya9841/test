<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Total extends Model
{
    protected $fillable = [
        'user_id',
        'total_amount',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
