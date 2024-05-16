@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1 class="mb-5">Lista dei piatti</h1>

    <div class="d-flex justify-content-between align-items-start gap-3 ">

        <div class="dish-container col-9">

            <table class="table">

                {{-- Intestazione Piatti --}}
                <thead class="bg-transparent">
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Nome</th>
                        <th scope="col">Prezzo</th>
                        <th scope="col">Ingredienti</th>
                        <th class="text-center" scope="col">Modifica/Cancella</th>
                    </tr>
                </thead>

                {{-- Inizio t-body tabella Piatti --}}

                <tbody>
                    @foreach ($dishes as $dish)


                    <tr class="shadow">

                        {{-- Immagine Piatto --}}
                        <th class="img-dish-row d-flex align-items-center gap-3 " scope="row">
                            <div class="image rounded-4">
                                @if ($dish->dish_image)
                                @if (Str::startsWith($dish->dish_image, ['http://', 'https://']))
                                <img src="{{ $dish->dish_image }}" alt="{{ $dish->dish_name }}" width="100">
                                @else
                                <img src="{{ asset('storage/' . $dish->dish_image) }}" alt="{{ $dish->dish_name }}" width="100">
                                @endif
                                @else
                                <img src="{{ Vite::asset('resources/img/Default_different_food_0.jpg') }}" alt="Placeholder" width="100">
                                @endif
                            </div>
                            <div>
                                @if ($dish->visible)
                                <i class="fa-sharp fa-solid fa-eye-slash"></i>
                                @else
                                <i class="fa-solid fa-eye"></i>
                                @endif
                            </div>
                        </th>

                        {{-- Nome piatto --}}
                        <th class="title-dish-row" scope="row">
                            <h4>
                                {{ $dish->dish_name }}
                            </h4>
                        </th>

                        {{-- prezzo piatto --}}
                        <th class="title-dish-row" scope="row">
                            <span>
                                {{ $dish->dish_price }} €
                            </span>
                        </th>

                        {{-- Ingredienti piatto --}}
                        <th class="ingedients-dish-row" scope="row">
                            @if ($dish->ingredients)
                            <small>
                                {{$dish->ingredients}}
                            </small>
                            @else
                            <h4>
                                Nussun Ingrediente inserito
                            </h4>
                            @endif
                        </th>

                        {{-- Pulsanti --}}
                        <th class="modify-dish-row" scope="row">
                            <div class="d-flex align-items-center justify-content-center p-2 gap-2">
                                <span class="d-flex justify-content-between align-items-center">
                                    <a class="text-decoration-none" href="{{route('admin.dishes.edit', $dish->id)}}">
                                        <div class="d-flex justify-content-center align-items-center">
                                            <i class="fa-solid fa-pen-to-square fs-1"></i>
                                        </div>
                                    </a>
                                </span>
                                <div>
                                    <button type="button" class="delete border-0" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-trash fs-2"></i></button>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered ">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Elimina Piatto</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    Sei sicuro che vuoi eliminare il piatto "{{$dish->dish_name}}" ?
                                                </div>


                                                <div class="modal-footer">

                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                                                    <form action="{{route('admin.dishes.destroy', $dish) }}" method="POST">
                                                        @csrf
                                                        @method("DELETE")

                                                        <button class="btn btn-danger">Elimina</button>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </th>

                    </tr>
                    @endforeach

                </tbody>
            </table>

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