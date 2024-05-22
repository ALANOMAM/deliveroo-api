<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dish;
use App\Models\Order;
use Braintree;
use Braintree\Gateway;
use Illuminate\Http\Request;


class PaymentController extends Controller
{
    public function getToken()
    {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $clientToken = $gateway->clientToken()->generate();

        return response()->json([
            'token' => $clientToken,
        ]);
    }


    public function payment(Request $request)
    {
        $gateway = new Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);

        $nonce = $request->input('nonce');
        $totalAmount = $request->input('totalPrice');

        $result = $gateway->transaction()->sale([
            'amount' => $totalAmount,
            'paymentMethodNonce' => $nonce,
            'options' => [
                'submitForSettlement' => true
            ]
        ]);

        if ($result->success) {
            $newOrder = Order::create([
                'customer_name' => $request->customer_name,
                'customer_surname' => $request->customer_surname,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'customer_address' => $request->customer_address,
                'total_price' => $totalAmount,
                'message' => $request->message,
            ]);

            foreach ($request->cart as $item) {
                // Trova il piatto dal suo ID
                $dish = Dish::findOrFail($item['id']);

                // Aggiungi una riga nella tabella pivot con le informazioni del piatto e dell'ordine
                $newOrder->dishes()->attach($dish->id, [
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            return response()->json([
                'success' => true,
                'transaction_id' => $result->transaction->id,
                'order_id' => $newOrder->id
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => $result->message
            ], 500);
        }
    }
}
