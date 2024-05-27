@extends('layouts.app')

@section('content')

    <div class="container col-9 py-5">

        <h1 class="py-2 mb-3">Ordini del tuo ristorante</h1>

        <table class="table">

            {{-- Intestazione Tabella --}}
            <thead class="bg-transparent">
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Cognome</th>
                    <th scope="col">Indirizzo consegna</th>
                    <th scope="col">Recapiti</th>
                    <th scope="col" class="text-center">Data Ordine</th>
                    <th scope="col" class="text-center">Totale ordine</th>
                    

                </tr>
            </thead> 
            


            {{-- Inizio t-body tabella ordini --}}

            <tbody>
                @foreach ($orders as $order)


                <tr class="orders-shadow">

                    {{-- Nome Cognome utente --}}

                    <th class="align-middle" scope="row">
                        <div class="fw-bold">
                            {{ $order->customer_name }}
                        </div>
                    </th>

                    <th class="align-middle" scope="row">
                        <div class="fw-bold">
                            {{ $order->customer_surname }}
                        </div>
                    </th>


                    {{-- Indirizzo consegna --}}
                    <th class="align-middle" scope="row">
                        <div class="fw-normal">
                            {{ $order->customer_address }}
                        </div>
                    </th>

                    {{-- Recapiti utente --}}

                    <th class="orders-data align-middle" scope="row">
                    
                        <div class="fw-normal">
                            <i class="fa-solid fa-envelope"></i>
                            {{ $order->customer_email }}
                        </div>
                        <div class="fw-normal">
                            <i class="fa-solid fa-phone"></i>
                            {{ $order->customer_phone }}
                        </div>
                        
                    </th>

                    {{-- data ordine --}}

                    <th scope="row">
                        <div class="fw-normal d-flex justify-content-center align-items-center">
                            <?php
                                setlocale(LC_TIME, 'it_IT.UTF-8'); // Imposta la lingua italiana
                                $created_at = $order->created_at;
                                $timestamp = strtotime($created_at);
                                $formatted_date = strftime('%d %b %Y', $timestamp);
                                $formatted_time = date('H:i', $timestamp);
                            ?>
                            <span class="order-date bg-success text-white px-2 py-1 rounded mb-1"><?php echo $formatted_date . ' ' . $formatted_time; ?></span>
                        </div>
                    </th>
                    
                    {{-- Prezzo totale ordine --}}

                    <th class="orders-price text-center" scope="row">
                        <span class="fw-normal fs-5 ">
                            {{ $order->total_price }} €
                        </span>
                    </th>



                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    
@endsection