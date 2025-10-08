<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'end_date',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptionPayment()
    {
        return $this->hasOne(SubscriptionPayment::class);
    }

}
