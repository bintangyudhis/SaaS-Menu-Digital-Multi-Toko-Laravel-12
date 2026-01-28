<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class MidtransController extends Controller
{
    public function callback(Request $request)
    {

        $serverKey = config('midtrans.serverKey');
        $hashedKey = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hashedKey != $request->signature_key) {
            return response()->json(['message' => 'Invalid signature key'], 403);
        }

        $transactionStatus = $request->transaction_status;
        $orderId = $request->order_id;
        $transaction = Transaction::where('code', $orderId)->first();

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }


        switch ($transactionStatus) {
            case 'capture':
                if ($request->payment_type == 'credit_card') {
                    if ($request->fraud_status == 'challenge') {
                        $transaction->update(['status' => 'pending']);
                    } else {
                        $transaction->update(['status' => 'success']);
                    }
                }
                break;
            case 'settlement':
                $transaction->update(['status' => 'success']);
                break;
            case 'pending':
                $transaction->update(['status' => 'pending']);
                break;
            case 'deny':
                $transaction->update(['status' => 'failed']);
                break;
            case 'expire':
                $transaction->update(['status' => 'failed']);
                break;
            case 'cancel':
                $transaction->update(['status' => 'failed']);
                break;
            default:
                $transaction->update(['status' => 'failed']);
                break;
        }

        return response()->json(['message' => 'Callback received successfully']);
    }
}
