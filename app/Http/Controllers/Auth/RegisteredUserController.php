<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Restaurant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'restaurant_name' => ['required', 'string', 'max:255'],
            'vat' => ['required', 'numeric'],
            'address' => ['required', 'string', 'max:255'],
            'image' => ['image', 'max:2048'],
            'phone' => ['string', 'max:255'],
            'description' => ['string'],
        ]);

        // Creazione dell'utente
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Creazione del ristorante associato all'utente
        $restaurant = new Restaurant([
            'restaurant_name' => $request->restaurant_name,
            'vat' => $request->vat,
            'address' => $request->address,
            'phone' => $request->phone,
            'description' => $request->description,
        ]);

        // Salvataggio del ristorante associato all'utente
        $user->restaurant()->save($restaurant);

        // Invio dell'evento di registrazione
        event(new Registered($user));

        // Login dell'utente
        Auth::login($user);

        // Reindirizzamento alla dashboard degli amministratori
        return redirect(RouteServiceProvider::HOME);
    }
}
