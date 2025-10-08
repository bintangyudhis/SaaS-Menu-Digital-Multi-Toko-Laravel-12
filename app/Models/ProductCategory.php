<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// php artisan make:model ProductCategory -m itu membuat model beserta migrationya (model adalah yg berhubungan dengan databasenya, migration yg create databsenya)
class ProductCategory extends Model
{
    use SoftDeletes; // fungsinya data yang terhapus  sebenernya ga kehapus masih terseimpan di table cuman diberikan flag

    protected $fillable = [
        'user_id',
        'name',
        'slug', // slug -> id unik ketika kita melakukan filter brdasarkan product category slug ini yang akan dimunculkan daripada kita menggunakan id
    ];

    public function user()
    {
        return $this->belongsTo(User::class); // relasi
    }

     public function products() // 1 productcategory bisa memiliki banyak product
    {
        return $this->hasMany(Product::class);
    }
}
