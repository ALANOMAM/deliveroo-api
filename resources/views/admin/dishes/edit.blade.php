@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div>

        <h1 class="mb-4">Modifica il piatto</h1>
    
        <form action="{{ route('admin.dishes.update', $dish->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            {{-- NOME DEL PIATTO --}}
    
            <div class="form-group mt-2">
                <label for="dish_name">Nome del piatto</label>
                <input type="text" class="form-control @error('dish_name') is-invalid @enderror" id="dish_name" name="dish_name" value="{{ old('dish_name', $dish->dish_name) }}" pattern="^[a-zA-Z\s']*$" title="Il nome può contenere solo lettere, spazi e l'apostrofo (')." required>
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

</div>
@endsection