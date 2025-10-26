<?php

namespace App\Models;


use Illuminate\Support\Facades\Auth;
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


    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
           $model->user_id = Auth::user()->id;
           $model->end_date = now()->addDays(30);
        });
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subscriptionPayment()
    {
        return $this->hasOne(SubscriptionPayment::class);
    }

}
