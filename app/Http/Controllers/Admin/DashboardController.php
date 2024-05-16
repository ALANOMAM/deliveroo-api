<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    //per mostrare la dashboard
    public function index()
    {
         
         $categories = Category::all();

        //utente autenticato
        $user = Auth::user();

        //il suo ristorante
        $restaurant = $user->restaurant;

        //indirizza alla dashboard
        return view('admin.restaurants.dashboard', compact('restaurant','categories'));
    }
}
