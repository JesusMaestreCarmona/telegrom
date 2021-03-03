@extends('layouts.welcome')

@section('content')

    <div class="card-header">Login</div>

    <div class="card-body">
        @error('auth')
        <div class="alert alert-danger" role="alert">
            <strong>{{ $message }}</strong>
        </div>
        @enderror

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group row mx-auto">
                <label for="email" class="col-md-4 col-form-label">Email:</label>

                <div class="col-md-6">
                    <input id="text" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" autofocus>

                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mx-auto">
                <label for="password" class="col-md-4 col-form-label">Contraseña:</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="current-password">

                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0 mx-auto">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        Iniciar sesión
                    </button>
                    @if (Route::has('password.request'))
                        <a class="ml-4 text-decoration-none" href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    @endif
                </div>
            </div>
            <div class="mt-2">
                <a class="btn btn-secondary" href="{{ route('register') }}">Registrarse</a>
            </div>
        </form>
    </div>

@endsection
