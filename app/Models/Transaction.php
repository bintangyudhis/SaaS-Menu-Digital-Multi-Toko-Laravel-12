<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes; // fungsinya data yang terhapus  sebenernya ga kehapus masih terseimpan di table cuman diberikan flag

    protected $fillable = [
        'user_id',
        'code',
        'name',
        'table_number',
        'payment_method',
        'total_price',
        'status',
    ];

    public static function boot() // melakukan generate slug otomatis
    {
        parent::boot();

        static::creating(function ($model) {
            if (Auth::user()->role == 'store') {
                $model->user_id = Auth::user()->id; // ketika sedang create otomatis menginjek si user id nya beserta slugnya
            }
        });

        static::updating(function ($model) {
            if (Auth::user()->role == 'store') {
                $model->user_id = Auth::user()->id; // ketika sedang update otomatis menginjek si user id nya beserta slugnya
            }
            // $model->slug = str()->slug($model->name); // generate slug dari name
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
