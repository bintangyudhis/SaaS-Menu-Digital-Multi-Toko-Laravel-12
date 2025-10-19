<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductIngredient extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'name',
    ];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
