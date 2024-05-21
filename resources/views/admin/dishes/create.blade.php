@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h1 class="mb-4">Crea un nuovo piatto</h1>

    <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- NOME DEL PIATTO --}}

        <div class="form-group mt-2">
            <label for="dish_name">Nome del piatto</label>
            <input type="text" class="form-control @error('dish_name') is-invalid @enderror" id="dish_name" name="dish_name" value="{{ old('dish_name') }}" required>
            @error('dish_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- PREZZO DEL PIATTO --}}

        <div class="form-group mt-2">
            <label for="dish_price">Inserisci il prezzo</label>
            <input type="number" class="form-control @error('dish_price') is-invalid @enderror" id="dish_price" name="dish_price" value="{{ old('dish_price') }}"  min="0" max="999.99" step="0.01" required>
            @error('dish_price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        {{-- IMMAGINE DEL PIATTO --}}

        <div class="mb-4 d-flex flex-column mt-2">
            <label for="dish_image">Inserisci un'immagine</label>
            <div class="col-md-6">
                <input id="dish_image" type="file" class="form-control @error('dish_image') is-invalid @enderror" accept=".jpg,.bmp,.png" name="dish_image">
                @error('dish_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <span style="color:gray">Opzionale</span>
            </div>
        </div>

        {{-- INGREDIENTI DEL PIATTO --}}

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredienti</label>
            <textarea class="form-control" id="form-control @error('dish_name') is-invalid @enderror" rows="3" name="ingredients">{{ old('ingredients') }}</textarea>
            @error('ingredients')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <span style="color:gray">Opzionale</span>
        </div>

        <div class="d-flex justify-content-start align-content-center gap-3">

            {{-- BOTTONE SUBMIT --}}

            <button type="submit" class="btn button-primary">Crea</button>

            {{-- VISIBILITA' PIATTO --}}

            <div class="form-check mb-3 mt-2">
                <input type="checkbox" class="form-check-input" value="1" id="visible" name="visible" {{ old('visible') ? 'checked' : '' }}>
                <label class="form-check-label" for="visible">Nascondi piatto</label>
            </div>

        </div>



        
    </form>

</div>

@endsection