<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\OrderConfirmationMail;
use App\Mail\RestaurantConfirmationMail;
use App\Models\Dish;
use App\Models\Order;
use App\Models\Restaurant;
use Braintree;
use Braintree\Gateway;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


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

        // Regole di validazione
        $validator = Validator::make($request->all(), [

            'customer_name' => 'required|string|max:20',
            'customer_surname' => 'required|string|max:30',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'required|string|max:80',
            'totalPrice' => 'required|min:0|max:9999',

            'nonce' => 'required',
            'cart' => 'required|array',
            'cart.*.id' => 'required|exists:dishes,id',
            'cart.*.quantity' => 'required|integer|min:1',
            'cart.*.price' => 'required|numeric|min:0|max:9999',
            'restaurantId' => 'required|exists:restaurants,id'

        ], [

            // Messaggi di errore personalizzati
            'customer_name.required' => 'Il campo nome è obbligatorio.',
            'customer_name.max' => 'Il campo nome non può superare i :max caratteri',
            'customer_surname.required' => 'Il campo cognome è obbligatorio.',
            'customer_surname.max' => 'Il campo cognome non può superare i :max caratteri',

            'customer_email.required' => 'Il campo email è obbligatorio.',
            'customer_email.email' => 'Deve essere un indirizzo email valido.',
            'customer_email.max' => 'Il campo email non può superare i :max caratteri',

            'customer_phone.required' => 'Il campo telefono è obbligatorio.',
            'customer_phone.max' => 'Il campo telefono non può superare i :max caratteri',
            // 'customer_phone.min' => 'Il campo telefono deve avere almeno :min cifre',


            'customer_address.required' => 'Il campo indirizzo è obbligatorio.',
            'customer_address.max' => 'Il campo indirizzo non può superare i :max caratteri',

            'totalPrice.required' => 'Il campo prezzo totale è obbligatorio.',
            // 'totalPrice.numeric' => 'Il campo prezzo totale deve essere un numero.',
            'totalPrice.max' => 'Il campo prezzo totale non può superare :max €',
            'totalPrice.min' => 'Il campo prezzo totale deve essere almeno 0.',

            'nonce.required' => 'Il campo nonce è obbligatorio.',
            'cart.required' => 'Il carrello è obbligatorio.',
            'cart.array' => 'Il carrello deve essere un array.',
            'cart.*.id.required' => 'L\'ID del piatto è obbligatorio.',
            'cart.*.id.exists' => 'Il piatto selezionato non è valido.',
            'cart.*.quantity.required' => 'La quantità è obbligatoria.',
            'cart.*.quantity.integer' => 'La quantità deve essere un numero intero.',
            'cart.*.quantity.min' => 'La quantità deve essere almeno 1.',
            'cart.*.price.required' => 'Il prezzo è obbligatorio.',
            'cart.*.price.numeric' => 'Il prezzo deve essere un numero.',
            'cart.*.price.min' => 'Il prezzo deve essere almeno 0.',
            'cart.*.price.max' => 'Il prezzo non può superare 9999',


        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // if($validator->fails()) {
        //     return response()->json([
        //         'success' => false,
        //         'errors' => $validator->errors()
        //     ]);

        // }


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

            // Caricamento dei piatti associati all'ordine
            // $newOrder->load('dishes');
            $restaurant = Restaurant::findOrFail($request->restaurantId);
            // Invia l'email di conferma ordine
            Mail::to($newOrder->customer_email)->send(new OrderConfirmationMail($newOrder));
            Mail::to($restaurant->user->email)->send(new RestaurantConfirmationMail($newOrder));

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
