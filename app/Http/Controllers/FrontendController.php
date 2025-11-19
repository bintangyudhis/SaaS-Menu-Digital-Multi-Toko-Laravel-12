<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {

        $store = User::where('username', $request->username)->first();

        if (!$store) {
            return abort(404);
        }

        $populars = Product::where('user_id', $store->id)->where('is_popular', true)->get();
        $products = Product::where('user_id', $store->id)->where('is_popular', false)->get();

        return view('pages.index', compact('store', 'populars', 'products')); // compact fungsinya melempar variabel yg udah dibuat di controller ke dalam view
    }
}
