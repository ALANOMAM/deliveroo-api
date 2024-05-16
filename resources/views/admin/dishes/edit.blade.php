@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1>Modifica il piatto</h1>

    <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="dish_name">Nome del piatto</label>
            <input type="text" class="form-control @error('dish_name') is-invalid @enderror" id="dish_name" name="dish_name" value="{{ old('dish_name', $dish->dish_name) }}">
            @error('dish_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="form-group">
            <label for="dish_price">Inserisci il prezzo</label>
            <input type="text" class="form-control @error('dish_price') is-invalid @enderror" id="dish_price" name="dish_price" value="{{ old('dish_price', $dish->dish_price) }}">
            @error('dish_price')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

        <div class="mb-4 row d-flex flex-column">
            <label for="dish_image">Inserisci un'immagine</label>
            <div class="col-md-6">
                <input id="dish_image" type="file" class="form-control @error('dish_image') is-invalid @enderror" name="dish_image">
                @error('dish_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredienti</label>
            <textarea class="form-control" id="ingredients" rows="3" name="ingredients">{{ old('ingredients', $dish->ingredients) }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" class="form-check-input" value="1" id="visible" name="visible" {{ old('visible', $dish->visible) ? 'checked' : '' }}>
            <label class="form-check-label" for="visible">Nascondi piatto</label>
        </div>

        <button type="submit" class="btn btn-primary">Salva</button>
    </form>
</div>

@endsection