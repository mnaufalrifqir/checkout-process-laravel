<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class MidtransController extends Controller
{
    public function checkout(Request $request)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(env('MIDTRANS_SERVER_KEY') . ':')
        ])->post('https://api.sandbox.midtrans.com/v2/charge', [
            'payment_type' => 'bank_transfer',
            'transaction_details' => [
                'order_id' => 'ORDER-' . time(),
                'gross_amount' => $request->gross_amount
            ],
            'customer_details' => [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone
            ],
            'item_details' => [
                [
                    'id' => 'ITEM1',
                    'price' => $request->gross_amount,
                    'quantity' => 1,
                    'name' => 'Product'
                ]
            ]
        ]);

        $result = $response->json();

        return view('midtrans.result', compact('result'));
    }
}