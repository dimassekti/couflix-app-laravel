<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Package;

class TransactionController extends Controller
{
  public function store(Request $request)
  {
    // dd($request->all());

    $package = Package::find($request->package_id);
    $customer = auth()->user();
    $transaction = Transaction::create([
      'package_id' => $package->id,
      'user_id' => $customer->id,
      'amount' => $package->price,
      'transaction_code' => strtoupper(Str::random(10)),
      'status' => 'pending'
    ]);

    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = (bool)env('MIDTRANS_IS_PRODUCTION');
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = (bool)env('MIDTRANS_IS_SANITIZED');
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = (bool)env('MIDTRANS_IS_3DS');

    $params = array(
      'transaction_details' => array(
        'order_id' => $transaction->transaction_code,
        'gross_amount' => $transaction->amount,
      ),
      'customer_details' => array(
        'first_name' => $customer->name,
        'last_name' => $customer->name,
        'email' => $customer->email
      ),
    );

    $createMidtransTransaction = \Midtrans\Snap::createTransaction($params);
    $midtransRedirectUrl = $createMidtransTransaction->redirect_url;

    return redirect($midtransRedirectUrl);
  }
}
