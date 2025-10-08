<?php

namespace App\Models;

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
    ];

    protected $casts = [ // nanti price nya akan ditampilkan desimal
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // relasi maksudnya di product ini dia memiliki user terkait
    }
    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }
}
