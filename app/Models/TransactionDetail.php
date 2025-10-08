<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionDetail extends Model
{
    use SoftDeletes; //fungsinya data yang terhapus  sebenernya ga kehapus masih terseimpan di table cuman diberikan flag

    protected $fillabe = [ //fillable -> attribut yang ada pada table tersebut
        'transaction_id',
        'product_id',
        'quantity',
        'note',
    ];

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
