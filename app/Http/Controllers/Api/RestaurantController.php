<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use Illuminate\Http\Request;

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
        }

        $restaurants = $query->get();

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
