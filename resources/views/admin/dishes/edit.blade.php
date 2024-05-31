@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row">

        <div class="mt-2 mb-4">
            <a href="{{route('admin.dishes.index')}}" class="mb-3 return-button"><i class="fa-solid fa-arrow-left"></i> Torna indietro</a>
        </div>

        <h1 class="mb-4">Modifica il piatto</h1>

        <div class="col-12 col-md-6 col-lg-7 py-4">

            <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
    
                {{-- NOME DEL PIATTO --}}
        
                <div class="form-group mt-2">
                    <label for="dish_name">Nome del piatto</label>
                    <input type="text" class="form-control @error('dish_name') is-invalid @enderror" id="dish_name" name="dish_name" value="{{ old('dish_name', $dish->dish_name) }}" required>
                    @error('dish_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
    
                {{-- PREZZO DEL PIATTO --}}
        
                <div class="form-group mt-2">
                    <label for="dish_price">Inserisci il prezzo</label>
                    <input type="number" class="form-control @error('dish_price') is-invalid @enderror" id="dish_price" name="dish_price" value="{{ old('dish_price', $dish->dish_price) }}" min="0" max="999.99" step="0.01" required>
                    @error('dish_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
    
                {{-- IMMAGINE DEL PIATTO --}}
        
                <div class="mb-4 row d-flex flex-column mt-2">
                    <label for="dish_image">Inserisci un'immagine</label>
                    <div class="col-md-6">
                        <input id="dish_image" type="file" class="form-control @error('dish_image') is-invalid @enderror" name="dish_image" accept=".jpg,.bmp,.png">
                        @error('dish_image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
    
                {{-- INGREDIENTI DEL PIATTO --}}
        
                <div class="mb-3">
                    <label for="ingredients" class="form-label">Ingredienti</label>
                    <textarea class="form-control" id="ingredients" rows="3" name="ingredients">{{ old('ingredients', $dish->ingredients) }}</textarea>
                </div>
    
                <div class="d-flex justify-content-start align-items-center gap-3">
    
                    {{-- BOTTONE SUBMIT --}}
    
                    <button type="submit" class="btn button-primary">Salva</button>
    
                    {{-- VISIBILITA' PIATTO --}}
    
                    <div class="form-check mb-3">
                        <input type="checkbox" class="form-check-input" value="1" id="visible" name="visible" {{ old('visible', $dish->visible) ? 'checked' : '' }}>
                        <label class="form-check-label" for="visible">Nascondi piatto</label>
                    </div>
    
                </div>
        
            </form>

        </div>

        <div class="col-md-6 col-lg-5 d-none d-md-block right-part py-4">

            <div class="img-quote">
                <img src="{{Vite::asset('resources/img/customer_care.png')}}" alt="">
                <h3 class="pt-4 text-center">
                    Per qualunque problema non esitare a contattare il nostro servizio clienti!
                </h3>
            </div>

        </div>


    </div>

</div>
@endsection