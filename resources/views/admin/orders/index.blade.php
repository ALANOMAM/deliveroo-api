@extends('layouts.app')

@section('content')

    <div class="container py-5 position-relative">

        <h1 class="py-2 mb-3">Ordini del tuo ristorante</h1>

        <table id="orders-table" class="table table-responsive table-borderless table-striped">

            {{-- Intestazione Tabella --}}
            <thead class="order-int">
                <tr>

                    <th scope="col" class="hidden-user">Cliente</th>
                    <th scope="col">Recapiti</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col" class="text-center">In data</th>
                    <th scope="col" class="text-center">Tot. €</th>
                    <th scope="col" class="text-center">Riepilogo</th>

                </tr>
            </thead> 
        
            {{-- Inizio t-body tabella ordini --}}

            <tbody>
                @foreach ($orders as $order)


                <tr class="orders-shadow" class="table table-responsive table-borderless orders-table-striped"> 

                    {{-- Nome Cognome utente --}}

                    <th class="orders-data align-middle hidden-user" scope="row">
                        <div class="fw-normal">
                            {{ $order->customer_name }} {{ $order->customer_surname }}
                        </div>
                    </th>

                    {{-- Recapiti utente --}}

                    <th class="orders-data align-middle" scope="row">

                        <div class="mail_phone">
                            <i class="fa-solid fa-phone">
                                <div class="phone-show">
                                    {{ $order->customer_phone }}
                                </div>
                            </i>
                            <i class="fa-solid fa-envelope">
                                <div class="mail-show">
                                    {{ $order->customer_email }}
                                </div>
                            </i>
                        </div>

                        <div class="hidden fw-normal">
                            <i class="fa-solid fa-envelope"></i>
                            {{ $order->customer_email }}
                        </div>
                        <div class="hidden fw-normal">
                            <i class="fa-solid fa-phone"></i>
                            {{ $order->customer_phone }}
                        </div>
                        
                    </th>


                    {{-- Indirizzo consegna --}}
                    <th class="orders-data align-middle" scope="row">
                        <div class="fw-normal">
                            {{ $order->customer_address }}
                        </div>
                    </th>

                    {{-- data ordine --}}

                    <th class="orders-data align-middle" scope="row">
                        <div class="fw-normal d-flex justify-content-center align-items-center">
                            <?php
                                setlocale(LC_TIME, 'it_IT.UTF-8'); // Imposta la lingua italiana
                                $created_at = $order->created_at;
                                $timestamp = strtotime($created_at);
                                
                                // Aggiungo due ore al timestamp
                                $timestamp_plus_two_hours = $timestamp + 2 * 3600;

                                // Formattazione data e ora con il nuovo timestamp
                                $formatted_date = strftime('%d %b %Y', $timestamp_plus_two_hours);
                                $formatted_time = date('H:i', $timestamp_plus_two_hours);
                            ?>
                            <span class="order-date text-center px-2 py-1 rounded mb-1"><?php echo $formatted_date . ' ' . $formatted_time; ?></span>

                            <span class="order-date-small text-center px-2 py-1 rounded mb-1"><?php echo $formatted_date ?></span>
                        </div>
                    </th>
                    
                    {{-- Prezzo totale ordine --}}

                    <th class="orders-data align-middle text-center" scope="row">
                        <span class="order-price fw-normal">
                            {{ $order->total_price }}€
                        </span>
                    </th>

                    {{-- Riepilogo ordine --}}
                    
                    <th class="button-summary align-middle text-center" scope="row">
                        <i id="eye-icon-{{ $order->id }}" class="fa-solid fa-eye eye-icon"></i>
                    </th>

                </tr>


                <!-- Modale nascosto -->
                <div id="orderDetailsModal-{{ $order->id }}" class="order_modal">
                    <div class="summary-content">
                        <div class="riepilogo d-flex flex-column align-items-cennter gap-1 mt-5">
                            <span class="close-order">
                                <i class="fa-solid fa-x"></i>
                            </span>
                            @foreach($order->dishes as $dish)
                            <div class="position-relative d-flex gap-3 align-items-center w-100">
                                @if ($dish->dish_image)
                                @if (Str::startsWith($dish->dish_image, ['http://', 'https://']))
                                    <img class="img-dish" src="{{ $dish->dish_image }}" alt="{{ $dish->dish_name }}">
                                @else
                                    <img class="img-dish" src="{{ asset('storage/' . $dish->dish_image) }}" alt="{{ $dish->dish_name }}">
                                @endif
                                @else
                                    <img class="img-dish" src="{{ Vite::asset('resources/img/Default_different_food_0.jpg') }}" alt="{{ $dish->dish_name }}">
                                @endif
                                <div class="order-details d-flex flex-column justify-content-center align-items-start">
                                    <div class="name-dish"> {{ $dish->dish_name }} x {{ $dish->pivot->quantity }} </div>
                                    <span class="single-price fw-bold">{{ $dish->pivot->price }} €</span>
                                    <div class="ingredients-dish text-start"> {{ $dish->ingredients }} </div>
                                </div>  
                            </div>

                            <hr>
                            
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach


            </tbody>

        </table>

    </div>
    
@endsection

