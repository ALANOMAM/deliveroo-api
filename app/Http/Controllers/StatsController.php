<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class StatsController extends Controller
{
  public function OrderChart()
  {


    // Ottiengo l'ID del ristorante dell'utente loggato
    $restaurantId = Auth::user()->restaurant->id;

    // Recupero la somma delle vendite  fatte per mese partendo dagli ordini che appartengono ai piatti di questo ristorante
    $orders = Order::whereHas('dishes', function ($query) use ($restaurantId) {
      $query->where('restaurant_id', $restaurantId);
    })
      ->with('dishes')
      ->select(FacadesDB::raw('SUM(total_price) as money_per_month'), FacadesDB::raw('MONTH(created_at) as month_number'))
      ->groupBy(FacadesDB::raw('MONTH(created_at)'))
      ->orderBy(FacadesDB::raw('MONTH(created_at)'), 'asc')
      ->get();


     // Ottiengo l'ID del ristorante dell'utente loggato
     $restaurantId = Auth::user()->restaurant->id;

     // Recupero il numero di ordini fatti per mese partendo dagli ordini che appartengono ai piatti di questo ristorante
      $orders2 = Order::whereHas('dishes', function ($query) use ($restaurantId) {
          $query->where('restaurant_id', $restaurantId);
      })->with('dishes')
      ->select(FacadesDB::raw('COUNT(total_price) as orders_per_month'), FacadesDB::raw('MONTH(created_at) as month_number'))
      ->groupBy(FacadesDB::raw('MONTH(created_at)'))
      ->orderBy(FacadesDB::raw('MONTH(created_at)'), 'asc')
      ->get();


    return view('admin.orders.statistics', compact('orders','orders2'));
  }

  public function OrderChart2()
  {

     // Ottiengo l'ID del ristorante dell'utente loggato
     $restaurantId = Auth::user()->restaurant->id;

     // Recupero il numero di ordini fatti per mese partendo dagli ordini che appartengono ai piatti di questo ristorante
      $orders2 = Order::whereHas('dishes', function ($query) use ($restaurantId) {
          $query->where('restaurant_id', $restaurantId);
      })->with('dishes')
      ->select(FacadesDB::raw('COUNT(total_price) as orders_per_month'), FacadesDB::raw('MONTH(created_at) as month_number'))
      ->groupBy(FacadesDB::raw('MONTH(created_at)'))
      ->orderBy(FacadesDB::raw('MONTH(created_at)'), 'asc')
      ->get();


    return view('admin.orders.statistics2', compact('orders2'));
  }







}
