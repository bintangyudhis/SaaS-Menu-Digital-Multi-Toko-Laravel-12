<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

// daftarkan controller ke router
Route::get('/{username}', [FrontendController::class, 'index'])->name('index'); //memanggil frontendcontrooller dan memanggil fungsi index
