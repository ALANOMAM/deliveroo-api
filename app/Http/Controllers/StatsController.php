<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class StatsController extends Controller
{
    public function OrderChart(){

     /* $ordini = FacadesDB::select("SELECT COUNT(total_price) AS 'numero_di_ordini', MONTH(`created_at`) AS 'mese_di_ordine' 
                                   FROM `orders` 
                                   GROUP BY MONTH(`created_at`)"); */
     //"SELECT * FROM `orders` ORDER BY `orders`.`customer_name`"

  /*foreach($resultX as $val){
     $data = $val;
  }
   dd($data);*/
   //dd($resultX);

   // Ottiengo l'ID del ristorante dell'utente loggato
   $restaurantId = Auth::user()->restaurant->id;

   // Recupero gli ordini che appartengono ai piatti di questo ristorante
   $orders = Order::whereHas('dishes', function ($query) use ($restaurantId) {
    $query->where('restaurant_id', $restaurantId);
})->with('dishes')->orderBy('created_at', 'desc')->get();


 /*$topRestaurants = facadesDB::table('dishes')
->join('restaurants', 'dishes.restaurant_id', '=', 'restaurants.id')
->join('dish_order', 'dishes.id', '=', 'dish_order.dish_id')
->join('orders', 'dish_order.order_id', '=', 'orders.id')
->select(
    'dishes.restaurant_id',
    'restaurants.restaurant_name',
    'orders.id as id_ordine',
    'orders.created_at as creazione_ordine',
    facadesDB::raw('COUNT(DISTINCT orders.id) as total_orders' ),
) 
->groupBy('dishes.restaurant_id', 'restaurants.restaurant_name' ,'orders.id','orders.created_at')
->orderByDesc('restaurants.id')
//->take(5)
->get();*/


return view('admin.orders.statistics' , compact('orders'));

    }

    
}
