@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1>Ordini del ristorante</h1>
        @foreach($orders as $order)
        <h2>Order #{{ $order->id }}</h2>
        <p>Dishes:</p>
        <ul>
            @foreach($order->dishes as $dish)
                <li>{{ $dish->dish_name }} - {{ $dish->restaurant->restaurant_name }}</li>
            @endforeach
        </ul>
        @endforeach
</div>
@endsection