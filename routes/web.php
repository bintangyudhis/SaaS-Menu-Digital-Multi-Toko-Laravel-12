<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\TransactionController;

// daftarkan controller ke router
Route::get('/{username}', [FrontendController::class, 'index'])->name('index'); //memanggil frontendcontrooller dan memanggil fungsi index

// route  //username toko              // class controller      //fungsi        // nama
Route::get('/{username}/find-product', [ProductController::class, 'find'])->name('product.find');
Route::get('/{username}/find-product/result', [ProductController::class, 'findResults'])->name('product.find-results');
Route::get('/{username}/product/{id}', [ProductController::class, 'show'])->name('product.show');

Route::get('/{username}/cart', [TransactionController::class, 'cart'])->name('cart');

Route::get('/{username}/customer-information', [TransactionController::class, 'customerInformation'])->name('customer-information');


Route::post('/{username}/checkout', [TransactionController::class, 'checkout'])->name('payment');
Route::get('/transaction/succes', [TransactionController::class, 'succes'])->name('succes');
