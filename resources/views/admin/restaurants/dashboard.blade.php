@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center pt-3">

        <div class="col-md-8">

            <div class="card">

                <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        <p>Bentornato/a, {{ Auth::user()->name }}!</p>


                        <h3>{{ $restaurant->restaurant_name }} è su JustBool!</h3>

                        <div class="d-flex ">
                            @if ($restaurant->image)
                            <img src="{{ $restaurant->image }}" alt="{{ $restaurant->restaurant_name }}" width="100">
                            @endif
                            <div class="ps-3">
                                <div>
                                    <strong>Nome Attività:</strong>{{ $restaurant->restaurant_name }}
                                </div>
                                <div>
                                    <strong>Partita IVA:</strong> {{ $restaurant->vat }}
                                </div>
                                <div>
                                    <strong>Indirizzo:</strong> {{ $restaurant->address }}
                                </div>
                                <div>
                                    <strong>Telefono:</strong> {{ $restaurant->phone }}
                                </div>

                                @if ($restaurant->description)
                                <div>
                                    <strong>Descrizione:</strong> {{ $restaurant->description }}
                                </div>
                                @endif

                            </div>
                            

                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>
@endsection