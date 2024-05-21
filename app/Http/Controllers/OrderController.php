<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $restaurant = $user->restaurant;
    
        if (!$restaurant) {
            return redirect()->route('admin.dashboard')->with('error', 'No restaurant associated with this user.');
        }
    
        $orders = $restaurant->orders()->get();
    
        return view('admin.orders.index', compact('orders'));
    }
}

