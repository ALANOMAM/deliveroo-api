<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB as FacadesDB;

class StatsController extends Controller
{
    public function OrderChart(){

      $ordini = FacadesDB::select("SELECT COUNT(total_price) AS 'numero_di_ordini', MONTH(`created_at`) AS 'mese_di_ordine' 
                                   FROM `orders` 
                                   GROUP BY MONTH(`created_at`)"); 
     //"SELECT * FROM `orders` ORDER BY `orders`.`customer_name`"

  /*foreach($resultX as $val){
     $data = $val;
  }
   dd($data);*/
   //dd($resultX);

   /*// Ottiengo l'ID del ristorante dell'utente loggato
   $restaurantId = Auth::user()->restaurant->id;

   // Recupero gli ordini che appartengono ai piatti di questo ristorante
   $orders = Order::whereHas('dishes', function ($query) use ($restaurantId) {
    $query->where('restaurant_id', $restaurantId);
})->with('dishes')->orderBy('created_at', 'desc')->get();*/

    

return view('admin.orders.statistics' , compact('ordini'));

    }

    
}
