<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;

class CheckoutController extends Controller
{
    public function checkoutForm(Product $product)
    {
        return view('userpages.checkout', compact('product'));
    }
    public function processCheckout(Request $request)
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$clientKey = env('MIDTRANS_CLIENT_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        $transactionDetails = array(
            'order_id' => 'order_' . time(),
            'gross_amount' => (int) Product::where('id', $request->product_id)->first()->price,
        );
        $customerDetails = array(
            'first_name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        );
        $payment = array(
            'payment_type' => $request->payment_method,
        );
        $transaction = array(
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'payment' => $payment,
        );
        try {
            $snapToken = Snap::getSnapToken($transaction);
            $product = Product::where('id', $request->product_id)->first();
            return view('userpages.payment', compact('snapToken','product'));
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
    public function storeTransaction(Request $request)
    {
        try {
            $transaction = Transaction::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'transaction_status' => $request->transaction_status,
                'transaction_id' => $request->transaction_id,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Transaksi berhasil disimpan.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
