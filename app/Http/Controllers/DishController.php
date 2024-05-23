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
        $validated = $request->validated();

        $newDish = new Dish();

        //image upload
        if ($request->hasFile('dish_image')) {
            $path = Storage::disk('public')->put('dish_images', $request->dish_image);
            $newDish->dish_image = $path;
        }

        $newDish->fill($validated);

        $newDish->restaurant_id = Auth::id();

        //'visible' checkbox
        $newDish->visible = $request->has('visible') ? 1 : 0;

        $newDish->save();

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
        // Verifica se il piatto appartiene al ristorante dell'utente autenticato
        if ($dish->restaurant_id !== Auth::id()) {
            // Se il piatto non appartiene al ristorante dell'utente autenticato, reindirizza alla pagina iniziale
            abort(404);
        }

        return view('admin.dishes.edit', compact('dish'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDishRequest $request, Dish $dish)
    {
        $data = $request->all();

        //'visible' checkbox (sarà '0' se unchecked, e '1' se checked)
        $data['visible'] = $request->has('visible') ? 1 : 0;

        //Aggiorna i dish
        $dish->update($data);

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
