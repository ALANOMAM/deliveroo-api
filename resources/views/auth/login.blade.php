@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12 col-sm-10 col-lg-6">


            <div class="card reg-form">

                <div class="card-header py-4 border-bottom-0">
                    <h2>Bentornato!</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4 row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Indirizzo email') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4 row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Ricordami') }}
                                    </label>
                                </div>
                            </div>
                        </div>


                        <div class="mb-4 row mb-0 d-flex align-items-center">
                            @if (Route::has('password.request'))
                            <a class="btn btn-link text-dark text-center" href="{{ route('password.request') }}">
                                {{ __('Hai dimenticato la tua password?') }}
                            </a>
                            @endif
                            <div class="text-center mb-3">
                                <button type="submit" class="btn button-primary accedi">
                                    {{ __('Accedi') }}
                                </button>
                            </div>

                            <div class="text-center">
                                <span>
                                    Non hai un account?
                                    <a class="btn-link text-dark" href="{{ route('register') }}">
                                        {{ __('Registrati') }}
                                    </a>
                                </span>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endsection