@extends('layouts.app')

@section('content')

<div class="container mt-4 ">

    <div class="row justify-content-center pb-5">

        <div class="col-md-6 mb-5">

            <h1 class="mt-3 mb-5">Fai crescere la tua attività online con JustBool!</h1>

            <div class="card reg-form">

                <div class="card-header py-4 border-bottom-0">
                    <h2>Inizia a vendere su JustBool!</h2>
                    <div>Registrarsi su JustBool è facilissimo. Diventa subito nostro partner.</div>
                </div>

                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- NOME PROPRIETARIO --}}

                        <div class="mb-2 row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nome Proprietario') }}</label>
                            <div class="col-md-7 px-0">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" pattern="^[a-zA-Z\s']*$" title="Il nome può contenere solo lettere, spazi e l'apostrofo (')." autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span style="color:gray">Opzionale</span>
                            </div>
                        </div>

                        {{-- NOME RISTORANTE --}}

                        <div class="mb-2 row">
                            <label for="restaurant_name" class="col-md-4 col-form-label text-md-right">{{ __('Nome Attività') }}</label>
                            <div class="col-md-7 px-0">
                                <input id="restaurant_name" type="text" class=" form-control @error('restaurant_name') is-invalid @enderror" name="restaurant_name" value="{{ old('restaurant_name') }}" required autocomplete="restaurant_name" autofocus>
                                @error('restaurant_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- CATEGORIE RISTORANTE --}}

                        <div class="mb-2 d-flex ">
                            <label class="col-md-4 text-md-right">Tipologia Ristorante</label>
                            <div class="row ps-4">
                                @foreach($categories as $category)
                                <div class="px-0 col-6 col-lg-4 d-flex flex-start ">
                                    <div class="form-check p-0">
                                        <input type="checkbox" name="categories[]" value="{{$category->id}}" id="{{$category->id}}" {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}>
                                        <label class="my-checkboxes" for="{{$category->id}}">{{$category->category_name}}</label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @error('categories')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror


                        {{-- EMAIL RISTORANTE --}}

                        <div class="mb-2 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo email') }}</label>
                            <div class="col-md-7 px-0">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" pattern="^[A-Za-z0-9._-']+@[A-Za-z._-]+\.[A-Za-z]{2,}$" required title="Inserisci una email valida, come justbool@example.com" autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        {{-- P.IVA RISTORANTE --}}

                        <div class="mb-2 row">
                            <label for="vat" class="col-md-4 col-form-label text-md-right">{{ __('Partita IVA') }}</label>
                            <div class="col-md-7 px-0">
                                <input id="vat" type="text" class="form-control @error('vat') is-invalid @enderror" name="vat" value="{{ old('vat') }}" required pattern="^IT\d{9}$" title="La partita IVA deve iniziare con 'IT' seguito da 9 numeri, 11 cifre totali" maxlength="11" minlength="11" autocomplete="vat">
                                @error('vat')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        {{-- INDIRIZZO RISTORANTE --}}

                        <div class="mb-2 row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo') }}</label>
                            <div class="col-md-7 px-0">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" required pattern="^[a-zA-Z\s]+\s*,\s*[0-9]+[a-zA-Z]?\s*,\s*[a-zA-Z\s]+$" title="L'indirizzo deve essere nel formato: via o piazza nome via e piazza, numero civico, città" autofocus>
                                @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-- IMMAGINE RISTORANTE --}}

                        <div class="mb-2 row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Immagine') }}</label>
                            <div class="col-md-7 px-0">
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" accept=".jpg,.bmp,.png" name="image">
                                @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span style="color:gray">Opzionale</span>
                            </div>
                        </div>

                        {{-- TELEFONO RISTORANTE --}}

                        <div class="mb-2 row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Telefono') }}</label>
                            <div class="col-md-7 px-0">
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" pattern="\+39\s?[0-9]*" minlength="13" maxlength="16" title="Inserisci un numero di telefono valido (es. +393123456789). Deve iniziare con +39" autocomplete="phone">
                                @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span style="color:gray">Opzionale</span>
                            </div>
                        </div>

                        {{-- DESCRIZIONE RISTORANTE --}}

                        <div class="mb-4 row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descrizione Attività') }}</label>
                            <div class="col-md-7 px-0">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" autocomplete="description">{{ old('description') }}</textarea>
                                @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                                <span style="color:gray">Opzionale</span>
                            </div>
                        </div>

                        {{-- CAMPI PASSWORD --}}

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>
                            <div class="col-md-7 px-0">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Conferma Password') }}</label>
                            <div class="col-md-7 px-0">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" required>
                            </div>
                        </div>

                        {{-- BOTTONE SUBMIT --}}

                        <div class="mb-1 row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn button-primary">
                                    {{ __('Registrati') }}
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>

        </div>

        <div class="col-md-6 right-part">

            <div class="img-quote">
                <img src="{{Vite::asset('resources/img/register-image.jpeg')}}" alt="">
                <h3 class="pt-4">
                    "Eravamo alla ricerca di una strada per entrare nelle case degli italiani e JustBool ci ha fornito la soluzione!"
                </h3>
            </div>

        </div>

    </div>

</div>

{{-- <script>
    document.getElementById('myForm').addEventListener('submit', function(event) {
        var nameInput = document.getElementById('name');
        if (nameInput.value.trim() === '') {
            nameInput.value = 'Ristoratore';
        }
    });
</script> --}}


@endsection