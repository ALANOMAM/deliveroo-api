<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {

        // Ottiengo l'ID del ristorante dell'utente loggato
        $restaurantId = Auth::user()->restaurant->id;

        // Recupero gli ordini che appartengono ai piatti di questo ristorante
        // $orders = Order::whereHas('dishes', function ($query) use ($restaurantId) {
        //     $query->where('restaurant_id', $restaurantId);
        // })->with('dishes')->orderBy('created_at', 'desc')->get();

        $orders = Order::whereHas('dishes', function ($query) use ($restaurantId) {
            $query->where('restaurant_id', $restaurantId);
        })->with(['dishes' => function ($query) {
            $query->withPivot('quantity', 'price');
        }])->orderBy('created_at', 'desc')->get();
    
        return view('admin.orders.index', compact('orders'));
    }
}

