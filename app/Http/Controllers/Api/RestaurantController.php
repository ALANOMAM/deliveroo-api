<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function index()
    {

        $restaurants = Restaurant::with(['categories', 'dishes'])->get();

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
}
