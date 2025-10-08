<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'code',
        'name',
        'table_number',
        'payment_method',
        'total_price',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }
}
