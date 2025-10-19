<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes; // buat soft delete (fungsinya data yang terhapus  sebenernya ga kehapus masih terseimpan di table cuman diberikan flag)

    protected $fillable = [
        'user_id',
        'product_category_id',
        'image',
        'name',
        'description',
        'price',
        'rating',
        'is_popular',
    ];

    protected $casts = [ // nanti price nya akan ditampilkan desimal
        'price' => 'decimal:2',
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
        return $this->belongsTo(User::class); // relasi maksudnya di product ini dia memiliki user terkait
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productIngredients() // 1 product bisa memiliki banyak ingredients
    {
        return $this->hasMany(ProductIngredient::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }


}
