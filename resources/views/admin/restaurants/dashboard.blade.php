@extends('layouts.app')

@section('content')
<div class="container p-0 position-relative overflow-hidden">
    <div class="jumbo mt-4">
        <div class="welcome-message">
            <div class="fs-5">Ciao {{ Auth::user()->name ?? 'Ristoratore' }},</div>
            <h1 class="text-white  display-4 fw-normal">{{ $restaurant->restaurant_name }} è su JustBool!</h1>
            <div class="list-group-item d-flex flex-wrap mt-4 gap-2 pb-5">
                @foreach ($restaurant->categories as $category)
                <span class="badge rounded-pill bg-white text-dark fw-normal" style="font-size: 14px;">{{ $category->category_name }}</span>
                @endforeach
            </div>
        </div>

        <a href="{{ route('admin.dishes.index') }}" class="btn btn-primary d-md-block d-none menu-button position-absolute p-2 px-3" style="bottom: 60px; left: 60px;" onclick="setMenuActiveLink()">Vai al tuo menu</a>

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

    <div class="info-section mt-5 ms-5">
        <div class="row">

            <div class="col-md-12">
                <h3 class="fw-semibold text-dark">{{ $restaurant->restaurant_name }}</h3>
            </div>

            <div class="col-md-6">
                <div class="pb-4 fs-5">
                    {{ $restaurant->address }}
                </div>
                <div class="pb-1">
                    {{ $restaurant->phone }}
                </div>
                <div class="pb-4">
                    P. IVA {{ $restaurant->vat}}
                </div>
            </div>


            <div class="col-md-6">
                <div class="pb-1">
                    <p class="text-wrap me-5 " style="word-wrap: break-word;">{{ $restaurant->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function setMenuActiveLink() {
        const menuLink = document.getElementById('menu-link');
        if (menuLink) {
            localStorage.setItem('activeLinkId', 'menu-link');
            setActiveLink(menuLink);
        }
    }
</script>
@endsection