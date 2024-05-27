<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class StatsController extends Controller
{
    public function OrderChart(){

    
// Ottiengo l'ID del ristorante dell'utente loggato
$restaurantId = Auth::user()->restaurant->id;

// Recupero gli ordini che appartengono ai piatti di questo ristorante
$orders = Order::whereHas('dishes', function ($query) use ($restaurantId) {
  $query->where('restaurant_id', $restaurantId);
})
->with('dishes')
->select(FacadesDB::raw('SUM(total_price) as money_per_month'), FacadesDB::raw('MONTH(created_at) as month_number')) // Add price sum and month selection
->groupBy(FacadesDB::raw('MONTH(created_at)')) // Group by month
->orderBy(FacadesDB::raw('MONTH(created_at)'), 'asc') // Order by month (optional)
->get();

return view('admin.orders.statistics' , compact('orders'));

    }

    
}
