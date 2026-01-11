<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //
    public function cart(Request $request)
    {
        $store = User::where('username', $request->username)->first(); // pencarian tokonya siapa

        if (!$store) {
            abort(404);
        }

        return view('pages.cart', compact('store'));
    }


}
