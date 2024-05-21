@extends('layouts.app')

@section('content')

    <div class="container py-5">

        <h1 class="py-2">Ordini del ristorante:</h1>

        @foreach($orders as $order)
        <h2>Order #{{ $order->id }}</h2>
        <div><strong>Prezzo ordine:</strong> {{ $order->total_price }} </div>
        <div class="mb-3" ><strong>Data ordine:</strong> {{ $order->created_at }} </div>

        <div><strong>Ordinato da:</strong> {{ $order->customer_name }} {{ $order->customer_surname }} </div>
        <div>Ordinato da: {{ $order->customer_email }} {{ $order->customer_phone }} </div>
        <div><strong>Indirizzo consegna: </strong>{{ $order->customer_address }} </div>
    

        <p>Piatti ordinati:</p>
        <ul>
            @foreach($order->dishes as $dish)
                <li>Nome Piatto: {{ $dish->dish_name }} - Ristorante: {{ $dish->restaurant->restaurant_name }}</li>
            @endforeach
        </ul>
        @endforeach
    </div>
    
@endsection