<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Restaurant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        //mi salva tutte le tipologie prese dal database in una variabile
        $categories = Category::all();

        //mando tutte le catgorie nella vita delle registrazioni 
        return view('auth.register',compact('categories'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],

            'categories' => ['required', 'exists:categories,id'],

            'vat' => ['required', 'string', 'min:11', 'max:11', 'unique:' . Restaurant::class],

            'restaurant_name' => 'required|string|max:255',
            // 'vat' => 'required|unique|string|min:11|max:11',
            'address' => 'required|string|max:255',
            'image' => 'file|max:3000|nullable|mimes:jpg,bmp,png',
            'phone' => 'nullable|string|min:13|max:16',
        ], [

            // messaggi in italiano per nome
            'name.max' => 'Il campo nome può avere massimo :max caretteri',
            'name.required' => 'Il nome è obbligatorio',

            // messaggi in italiano per campo email
            'email.required' => 'Il campo mail è obbligatoria',
            'email.email' => 'Inserisci un indirizzo mail valido',
            'email.unique' => 'Questo indirizzo mail è già stato utilizzato',

            // messaggi in italiano per campo password
            'password.required' => 'Il campo della password è obbligatoria',
            'password.confirmed' => 'Conferma la password',

            // messaggi in italiano per checkbox categorie
            'categories.required' => 'Scegli almeno una categoria!',
            'categories.exists' => 'Scegli almeno una categoria!',
        
            // messaggi in italiano per restaurant_name
            'restaurant_name.required' => "Il campo del nome dell'attività è obbligatorio",
            'restaurant_name.max' => 'Questo campo può avere massimo :max caratteri',

            // messaggi in italiano per vat
            'vat.required' => "Il campo della p.iva è obbligatorio",
            'vat.min' => "Il campo della p.iva deve avere minimo :min cifre",
            'vat.max' => "Il campo della p.iva può avere massimo :max cifre",
            'vat.unique' => 'Il campo della p.iva è già stato utilizzata',

            // messaggi in italiano per address
            'address.required' => "Il campo dell'indirizzo è obbligatorio",
            'address.max' => "Il campo dell'indirizzo può avere massimo :max caratteri",

            // messaggi in italiano per phone
            'phone.min' => "Il campo del telefono deve avere minimo :min numeri",
            'phone.max' => "Il campo del telefono può avere massimo :max numeri",

            // messaggi in italiano per immagine
            'image.file' => "L'immagine del ristorante deve essere un file",
            'image.max' => "La dimensione del file non deve superare i 3000 KB",
            'image.mimes' => "Il file deve essere un'immagine con estensione jpg, bmp o png",


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

        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('images', $request->image);
            $restaurant->image = $path;
        };

        // Salvataggio del ristorante associato all'utente
        $user->restaurant()->save($restaurant);

        //Questa riga di codice è responsabile dell'associazione di categorie a un ristorante specifico nella tua applicazione Laravel. 
        //Recupera le categorie esistenti collegate al ristorante utilizzando il metodo categories() e successivamente utilizza il metodo 
        //attach per aggiungere ulteriori categorie specificate nei dati della richiesta in arrivo ($request->categories). 
        //Questo ti consente di gestire dinamicamente le categorie associate a ciascun ristorante.
        $restaurant->categories()->attach($request->categories);

        // Invio dell'evento di registrazione
        event(new Registered($user));

        // Login dell'utente
        Auth::login($user);

        // Reindirizzamento alla dashboard degli amministratori
        return redirect(RouteServiceProvider::HOME);
    }
}
