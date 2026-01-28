<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Transaction;
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

    public function customerInformation(Request $request)
    {
        $store = User::where('username', $request->username)->first(); // pencarian tokonya siapa

        if (!$store) {
            abort(404);
        }

        return view('pages.customer-information', compact('store'));
    }

    public function checkout(Request $request)
    {
        $store = User::where('username', $request->username)->first(); // pencarian tokonya siapa

        if (!$store) {
            abort(404);
        }

        $carts = json_decode($request->cart, true);

        $totalPrice = 0;

        foreach ($carts as $cart) {
            $product = Product::where('id', $cart['id'])->first();
            $totalPrice += $product->price * $cart['qty'];
        }

        $transaction = $store->transactions()->create([
            'code' => 'TRX-' . mt_rand(10000, 99999),
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'table_number' => $request->table_number,
            'payment_method' => $request->payment_method,
            'total_price' => $totalPrice,
            'status' => 'pending'
        ]);

        foreach ($carts as $cart) {
            $product = Product::where('id', $cart['id'])->first();

            $transaction->transactionDetails()->create([
                'product_id' => $product->id,
                'quantity' => $cart['qty'],
                'note' => $cart['notes']
            ]);
        }

        if ($request->payment_method === 'cash') {
            return redirect()->route('succes', ['username' => $store->username,  'order_id' => $transaction->code]);
        } else {

            // kode yang disediakan midtrans untuk intgrasi payment gateway
            //set your merchant server key
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            // set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            \Midtrans\Config::$isProduction = config('midtrans.isProduction');
            // set sanitization on (default)
            \Midtrans\Config::$isSanitized = config('midtrans.isSanitized');
            // set 3DS transaction for credit card to true
            \Midtrans\Config::$is3ds = config('midtrans.is3ds');


            $params = [
                'transaction_details' => [
                    'order_id' => $transaction->code,
                    'gross_amount' => $totalPrice,
                ],
                'customer_details' => [
                    'first_name' => $request->name,
                    'phone' => $request->phone_number,
                ],
            ];

            $paymentUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;

            return redirect($paymentUrl);
        }

    }


    public function succes(Request $request)
    {
        $transaction =  Transaction::where('code', $request->order_id)->first();
        $store = User::where('id', $transaction->user_id)->first(); // pencarian tokonya siapa

        if (!$store) {
            abort(404);
        }

        return view('pages.succes', compact('store', 'transaction'));

    }

}
