<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
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
}
