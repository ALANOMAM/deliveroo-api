@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center pt-3">

        <div class="col-md-8">

            <div class="bg-light mb-3 rounded-4 shadow p-3 my-5 px-5">

                <div>
                    <p class="fs-3 text-center">Bentornato/a, {{ Auth::user()->name }}!</p>


                    <h1 class="text-center">{{ $restaurant->restaurant_name }} è su JustBool!</h1>

                    <div class="d-flex flex-column">
                        <div>
                            @if ($restaurant->image)
                            @if (Str::startsWith($restaurant->image, ['http://', 'https://']))
                            <img src="{{ $restaurant->image }}" alt="{{ $restaurant->restaurant_name }}" width="100">
                            @else
                            <img src="{{ asset('storage/' . $restaurant->image) }}" alt="{{ $restaurant->restaurant_name }}" width="100">
                            @endif
                            @else
                            <img src="{{ Vite::asset('resources/img/restaurant_placeholder.jpg') }}" alt="Placeholder" width="100">
                            @endif
                        </div>

                        <h2 class="text-center mt-3">Informazioni sul ristorante</h2>
                        <div class="ps-3 my-5 d-flex jusify-content-between gap-5">

                            <div class="fs-5 d-flex flex-column">
                                <div>
                                    <strong>Nome Attività: </strong> {{ $restaurant->restaurant_name }}
                                </div>
                              
                                <!--dove visualizzo le tipologie una volta creato il profilo start-->
                                <div class="list-group-item">
                                    <strong>Tipologia/e:</strong>
                                    {{--@dd($categories)--}}
                                    @foreach ($restaurant->categories as $category)
                                    <span class="badge rounded-pill text-bg-success">{{$category->category_name}}</span>
                                    @endforeach
                                </div>
                              <!--dove visualizzo le tipologie una volta creato il profilo end-->

                                <div>
                                    <strong>Indirizzo:</strong> {{ $restaurant->address }}
                                </div>
                                <div>
                                    <strong>Telefono:</strong> {{ $restaurant->phone }}
                                </div>
                                <div>
                                    @if ($restaurant->description)
                                    <strong>Descrizione:</strong> {{ $restaurant->description }}
                                    @endif
                                </div>
                            </div>


                            <div class="fs-5">
                                <strong>Partita IVA:</strong> {{ $restaurant->vat }}
                            </div>


                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection