@extends('layouts.app')

@section('content')

<div class="container py-5">
    <h1>Crea un nuovo piatto</h1>

    <form action="{{ route('admin.dishes.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="dish_name">Nome del piatto</label>
            <input type="text" class="form-control" id="dish_name" name="dish_name" value="{{ old('dish_name') }}">
        </div>

        <div class="form-group">
            <label for="dish_price">Inserisci il prezzo</label>
            <input type="text" class="form-control" id="dish_price" name="dish_price" value="{{ old('dish_price') }}">
        </div>

        <div class="mb-3">
            <label for="ingredients" class="form-label">Ingredienti</label>
            <textarea class="form-control" id="ingredients" rows="3" name="ingredients">{{ old('ingredients') }}</textarea>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" value="0" id="visible" name="visible" {{ old('visible') ? 'checked' : '' }}>
            <label class="form-check-label" for="visible">Rendere Invisibile il tuo piatto</label>
        </div>

        <button type="submit" class="btn btn-primary">Crea</button>
    </form>
</div>

@endsection