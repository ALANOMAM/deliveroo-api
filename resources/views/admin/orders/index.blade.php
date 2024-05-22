@extends('layouts.app')

@section('content')

    <div class="container col-9 py-5">

        <h1 class="py-2 mb-3">Ordini del tuo ristorante</h1>

        <table class="table">

            {{-- Intestazione Tabella --}}
            <thead class="bg-transparent">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Utente</th>
                    <th scope="col">Recapiti</th>
                    <th scope="col">Indirizzo consegna</th>
                    <th scope="col">Totale ordine</th>
                    <th class="text-center" scope="col">Data Ordine</th>
                </tr>
            </thead> 
            


            {{-- Inizio t-body tabella ordini --}}

            <tbody>
                @foreach ($orders as $order)


                <tr class="shadow">

                    {{-- Id Ordine --}}

                    <th class="img-dish-row d-flex align-items-center gap-3 " scope="row">
                        <div class="fw-bold">
                            {{ $order->id }}
                        </div>
                    </th>

                    {{-- Nome Cognome utente --}}

                    <th class="title-dish-row" scope="row">
                        <div class="fw-bold">
                            {{ $order->customer_name }} {{ $order->customer_surname }}
                        </div>
                    </th>

                    {{-- Recapiti utente --}}

                    <th class="title-dish-row" scope="row">
                        <div class="fw-normal">
                            {{ $order->customer_email }} - {{ $order->customer_phone }}
                        </div>
                    </th>

                    {{-- Indirizzo consegna --}}
                    <th class="ingedients-dish-row" scope="row">
                        <div class="fw-normal">
                            {{ $order->customer_address }}
                        </div>
                    </th>

                    {{-- Prezzo totale ordine --}}

                    <th class="ingedients-dish-row" scope="row">
                        <div class="fw-normal">
                            {{ $order->total_price }} €
                        </div>
                    </th>

                    {{-- data ordine --}}

                    <th class="ingedients-dish-row" scope="row">
                        <div class="fw-normal">
                            {{ $order->created_at }}
                        </div>
                    </th>


                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    
@endsection