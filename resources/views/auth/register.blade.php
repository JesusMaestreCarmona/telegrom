@extends('layouts.welcome')

@section('content')

    <div class="card-header">Registrarse</div>

    <div class="card-body">
        @include('partials.userForm')
        <div class="mt-2">
            <a class="btn btn-secondary" href="{{ route('login') }}">Login</a>
        </div>
    </div>

@endsection
