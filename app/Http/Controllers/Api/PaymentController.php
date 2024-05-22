<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
}
