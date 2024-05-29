<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;
use Illuminate\Support\Facades\Facade;

class StatsController extends Controller {
  public function OrderChart()
  {

    // Ottiengo l'ID del ristorante dell'utente loggato
    $restaurantId = Auth::user()->restaurant->id;

    // Recupero la somma delle vendite  fatte per mese partendo dagli ordini che appartengono ai piatti di questo ristorante
    $orders = Order::whereHas('dishes', function ($query) use ($restaurantId) {
      $query->where('restaurant_id', $restaurantId);
    })
    ->with('dishes')
    ->select(
      FacadesDB::raw('YEAR(created_at) as year'),
      FacadesDB::raw('MONTH(created_at) as month_number'),
      //FacadesDB::raw('COUNT(total_price) as orders_per_month') // Adjusted order for clarity
      FacadesDB::raw('SUM(total_price) as money_per_month')
    )
    ->groupBy(FacadesDB::raw('YEAR(created_at)'), FacadesDB::raw('MONTH(created_at)')) // Group by year and month
    ->orderBy(FacadesDB::raw('YEAR(created_at)'), 'asc') // Order by year (ascending)
    ->orderBy(FacadesDB::raw('MONTH(created_at)'), 'asc') // Order by month within year (ascending)
    ->get();


    // Recupero il numero di ordini fatti per mese partendo dagli ordini che appartengono ai piatti di questo ristorante
    $orders2 = Order::whereHas('dishes', function ($query) use ($restaurantId) {
      $query->where('restaurant_id', $restaurantId);
    })
    ->with('dishes')
    ->select(
      FacadesDB::raw('YEAR(created_at) as year'),
      FacadesDB::raw('MONTH(created_at) as month_number'),
      FacadesDB::raw('COUNT(total_price) as orders_per_month') // Adjusted order for clarity
    )
    ->groupBy(FacadesDB::raw('YEAR(created_at)'), FacadesDB::raw('MONTH(created_at)')) // Group by year and month
    ->orderBy(FacadesDB::raw('YEAR(created_at)'), 'asc') // Order by year (ascending)
    ->orderBy(FacadesDB::raw('MONTH(created_at)'), 'asc') // Order by month within year (ascending)
    ->get();

    return view('admin.orders.statistics', compact('orders', 'orders2'));
  }

}
