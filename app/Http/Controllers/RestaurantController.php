<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $restaurants = Restaurant::where('user_id', Auth::id())->get();
    return view('admin.restaurants.dashboard', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::all();

        return view('admin.restaurants.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $restaurant = new Restaurant;

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('images', $request->image);
            $restaurant->image = $path;
        };
        //assegnazione dello user_id al nuovo ristorante
        $restaurant->user_id = Auth::id();

        $restaurant->save();

        if(Arr::exists($data,'categories')){
            $restaurant->categories()->attach($data['categories']);
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
