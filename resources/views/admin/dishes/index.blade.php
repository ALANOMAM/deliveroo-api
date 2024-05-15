@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1 class="mb-5">Lista dei piatti</h1>

    <div class="d-flex justify-content-between align-items-start gap-3 ">
        <div class="dish-container col-9">

            @foreach ($dishes as $dish)
            <div class=" d-flex align-items-center justify-content-between bg-light mb-3 rounded-4 shadow">
                <div class="d-flex align-items-center gap-3 p-3">
                    <div class="image rounded-4">
                        @if ($dish->dish_image)
                        <img src="{{ asset('storage/' . $dish->dish_image )}}" alt="{{ $dish->dish_name }}">
                        @else
                        <img src="{{ asset('https://img.freepik.com/free-photo/penne-pasta-tomato-sauce-with-chicken-tomatoes-wooden-table_2829-19739.jpg') }}" alt="Placeholder">
                        @endif
                    </div>
                    <div>
                        <h2>
                            {{ $dish->dish_name }}
                        </h2>
                        <h5>
                            {{$dish->dish_price}} €
                        </h5>
                        <div class="ingredients">
                            {{$dish->ingredients}}
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-center justify-content-center p-2 gap-2">
                    <span class="d-flex justify-content-between align-items-center">
                        <a class="text-decoration-none" href="{{route('admin.dishes.edit', $dish->id)}}">
                            <div class="button d-flex justify-content-center align-items-center">
                                <i class="fa-solid fa-pen-to-square fs-1"></i>
                            </div>
                        </a>
                    </span>
                    <div>
                        <form action="{{ route('admin.dishes.destroy', $dish) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="delete border-0" onclick="return confirm('Vuoi cancellare questo piatto?')"><i class="fa-solid fa-trash fs-1"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>


        <div class="bg-light mb-3 d-flex justify-content-end rounded-4 col-3 shadow">
            <span class="d-flex justify-content-between align-items-center gap-3 py-3">
                <h4>Aggiungi un piatto</h4>
                <a class="text-decoration-none" href="{{route('admin.dishes.create')}}">
                    <div class="button me-2 d-flex justify-content-center align-items-center">
                        <i class="fa-solid fa-plus fs-1"></i>
                    </div>
                </a>
            </span>
        </div>

    </div>

</div>


@endsection