<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RestaurantController extends Controller
{
    public function index(Request $request)
    {
        $query = Restaurant::with('categories');

        if ($request->has('categories')) {
            $categories = $request->input('categories');
            $categoriesArray = explode(',', $categories);

            $query->whereHas('categories', function ($query) use ($categoriesArray) {
                $query->whereIn('category_name', $categoriesArray);
            });

            $query->whereHas('categories', function ($query) use ($categoriesArray) {
                $query->whereIn('category_name', $categoriesArray);
            }, '=', count($categoriesArray));
        }

        $restaurants = $query->paginate(5);

        return response()->json([
            "success" => true,
            "results" => $restaurants
        ]);
    }


    public function show($id)
    {
        $restaurant = Restaurant::with(['categories', 'dishes'])->find($id);

        if ($restaurant) {
            return response()->json([
                "success" => true,
                "restaurant" => $restaurant
            ]);
        } else {
            return response()->json([
                "success" => false,
                "error" => "Restaurant not found"
            ]);
        }
    }


    // Metodo per ottenere i 5 ristoranti con più ordini
    public function topRestaurants()
    {
        $topRestaurants = DB::table('dishes')
            ->join('restaurants', 'dishes.restaurant_id', '=', 'restaurants.id')
            ->join('dish_order', 'dishes.id', '=', 'dish_order.dish_id')
            ->join('orders', 'dish_order.order_id', '=', 'orders.id')
            ->select(
                'dishes.restaurant_id',
                'restaurants.restaurant_name',
                'restaurants.image',
                DB::raw('COUNT(DISTINCT orders.id) as total_orders'),
            )
            ->groupBy('dishes.restaurant_id', 'restaurants.restaurant_name', 'restaurants.image')
            ->orderByDesc('total_orders')
            ->take(5)
            ->get();

        return response()->json([
            "success" => true,
            "results" => $topRestaurants
        ]);
    }
}
