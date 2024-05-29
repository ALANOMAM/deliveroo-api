@extends('layouts.app')

@section('content')

    <div class="container col-9 py-5 position-relative">

        <h1 class="py-2 mb-3">Ordini del tuo ristorante</h1>

        <table class="table table-responsive table-borderless">

            {{-- Intestazione Tabella --}}
            <thead class="bg-transparent">
                <tr>

                    <th scope="col">Cliente</th>
                    <th scope="col">Recapiti</th>
                    <th scope="col">Indirizzo</th>
                    <th scope="col" class="text-center">In data</th>
                    <th scope="col" class="text-center">Tot.</th>
                    <th scope="col" class="text-center">Riepilogo</th>

                </tr>
            </thead> 
        
            {{-- Inizio t-body tabella ordini --}}

            <tbody>
                @foreach ($orders as $order)


                <tr class="orders-shadow"> 

                    {{-- Nome Cognome utente --}}

                    <th class="orders-data align-middle" scope="row">
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
                                $formatted_date = strftime('%d %b %Y', $timestamp);
                                $formatted_time = date('H:i', $timestamp);
                            ?>
                            <span class="order-date bg-success text-center text-white px-2 py-1 rounded mb-1"><?php echo $formatted_date . ' ' . $formatted_time; ?></span>
                        </div>
                    </th>
                    
                    {{-- Prezzo totale ordine --}}

                    <th class="orders-data align-middle text-center" scope="row">
                        <span class="order-price fw-normal fs-6">
                            {{ $order->total_price }} €
                        </span>
                    </th>

                    {{-- Riepilogo ordine --}}
                    
                    <th class="align-middle text-center" scope="row">
                        <i id="eye-icon-{{ $order->id }}" class="fa-solid fa-eye eye-icon"></i>
                    </th>

                </tr>


                <!-- Modale nascosto -->
                <div id="orderDetailsModal-{{ $order->id }}" class="order_modal">
                    <div class="summary-content">
                        <span class="close-order">
                            <i class="fa-solid fa-x"></i>
                        </span>
                        <div class="riepilogo d-flex flex-column justify-content-between align-items-start gap-4">
                            @foreach($order->dishes as $dish)
                            <div>
                                @if ($dish->dish_image)
                                @if (Str::startsWith($dish->dish_image, ['http://', 'https://']))
                                    <img src="{{ $dish->dish_image }}" alt="{{ $dish->dish_name }}">
                                @else
                                    <img src="{{ asset('storage/' . $dish->dish_image) }}" alt="{{ $dish->dish_name }}" alt="Placeholder">
                                @endif
                                @else
                                    <img src="{{ Vite::asset('resources/img/Default_different_food_0.jpg') }}" alt="Placeholder">
                                @endif

                                <span id="order-details">{{ $dish->pivot->quantity }} x {{ $dish->dish_name }} = {{ $dish->pivot->price }}€</span>
                                
                            </div>
                            
                            @endforeach
                        </div>
                    </div>
                </div>
                @endforeach


            </tbody>

        </table>

    </div>
    
@endsection

