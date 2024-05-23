@extends('layouts.app')

@section('content')
<div>
    <div class="d-flex flex-column pb-2">
        <div class="jumbo">
            <div class="welcome-message">
                <h2 class="fs-3">Bentornato/a, {{ Auth::user()->name === null ? 'Ristoratore' : Auth::user()->name }}!</h2>
                <h1>{{ $restaurant->restaurant_name }} è su JustBool!</h1>
            </div>
            @if ($restaurant->image)
            @if (Str::startsWith($restaurant->image, ['http://', 'https://']))
            <img src="{{ $restaurant->image }}" alt="{{ $restaurant->restaurant_name }}">
            @else
            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->restaurant_name }}">
            @endif
            @else
            <img src="{{ Vite::asset('resources/img/restaurant_placeholder.jpg') }}" alt="Placeholder">
            @endif
        </div>
    </div>

    <!-- CATEGORIE RISTORANTE -->
    <div>
        <div class="list-group-item d-flex justify-content-center mt-4 gap-2">
            @foreach ($restaurant->categories as $category)
            <span class="badge rounded-pill text-bg-success fs-5">{{ $category->category_name }}</span>
            @endforeach
        </div>

        <div class="col-md-12 my-5 d-flex justify-content-between m-auto gap-5">
            <div class="fs-5 d-flex flex-column">
                <div class="pb-1">
                    <strong>Nome Attività: </strong> {{ $restaurant->restaurant_name }}
                </div>
                <div class="pb-1">
                    @if ($restaurant->address)
                    <strong>Indirizzo:</strong> {{ $restaurant->address }}
                    @endif
                </div>
                <div class="pb-1">
                    @if ($restaurant->phone)
                    <strong>Telefono:</strong> {{ $restaurant->phone }}
                    @endif
                </div>
                <div class="pb-1">
                    @if ($restaurant->description)
                    <strong>Descrizione:</strong> {{ $restaurant->description }}
                    @endif
                </div>
            </div>
            <div class="fs-5">
                <strong>P. IVA:</strong> {{ $restaurant->vat }}
            </div>
        </div>
    </div>
</div>
@endsection