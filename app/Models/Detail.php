<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $fillable = [
        'user_id',
        'item',
        'amount',
        'total_amount',       
    ];
}
