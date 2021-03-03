@extends('layouts.welcome')

@section('content')

    <div class="card-header">Verifica tu dirección de email</div>

    <div class="card-body">
        @if (session('resent'))
            <div class="alert alert-success" role="alert">
                Un nuevo link ha sido enviado
            </div>
        @endif

        Antes de continuar, compruebe si ha recibido un email con el link de verificación.
        En caso negativo,
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">haga click aquí para enviar otro</button>.
        </form>
    </div>

@endsection
