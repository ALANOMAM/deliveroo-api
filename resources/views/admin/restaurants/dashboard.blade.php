@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <p>Bentornato/a, {{ Auth::user()->name }}!</p>


                    <h3>Dati del tuo Ristorante</h3>
                    <ul>
                        <li><strong>Nome Attività:</strong> {{ $restaurant->restaurant_name }}</li>
                        <li><strong>Partita IVA:</strong> {{ $restaurant->vat }}</li>
                        <li><strong>Indirizzo:</strong> {{ $restaurant->address }}</li>
                        <li><strong>Telefono:</strong> {{ $restaurant->phone }}</li>
                        <li><strong>Descrizione:</strong> {{ $restaurant->description }}</li>
                        @if ($restaurant->image)
                        <li><strong>Immagine:</strong> <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->restaurant_name }}" width="100"></li>
                        @endif
                    </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection