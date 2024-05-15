<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use App\Http\Requests\StoreDishRequest;
use App\Http\Requests\UpdateDishRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //prende tutti i piatti che si trovano nel restaurant_id, mentre Auth::id() restituisce l'id dell'utente autenticato e
        //poi restituisce tutti i piatti legati a quell'id
        $dishes = Dish::where('restaurant_id', Auth::id())->get();

        return view('admin.dishes.index', compact('dishes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dishes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDishRequest $request)
    {
        //convalida i dati nello StoreDishRequest
        $request->validated();

        $newDish = new Dish();

        //immagine

        if ($request->hasFile('dish_image')) {
            $path = Storage::disk('public')->put('dish_images', $request->dish_image);
            $newDish->dish_image = $path;
        };

        $newDish->fill($request->all());

        //assegnazione dell'id del ristorante associato all'utente
        $newDish->restaurant_id = Auth::id();

        $newDish->save();

        //questa parte ancora non funziona------------------------------------------------------------------------------------------------

        return redirect()->route('admin.dishes.index')->with('success', 'Piatto creato con successo.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dish $dish)
    {
        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $dish->update($request->all());

        if ($request->hasFile('dish_image')) {
            $path = Storage::disk('public')->put('dish_images', $request->dish_image);
            $dish->dish_image = $path;
        };

        $dish->save();

        return redirect()->route('admin.dishes.index', $dish);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $dish)
    {
        $dish->delete();

        return redirect()->route('admin.dishes.index');
    }
}
