@extends('layouts.info')

@section('content')

    <div class="row">
        <img src="{{asset((isset($user->img))? 'storage/img/'.$user->img : 'storage/img/genericUser.png')}}" class="ml-3 rounded-circle img-usuario border">
        <h5 class="ml-3 my-auto">{{$user->name.' '.$user->last_name}}</h5>
        @if(Auth::id() != $user->id)
            @if($added)
                <form action="{{ route('user.deletecontact') }}" method="post" class="my-auto ml-auto mr-3">
                    @csrf
                    <button type="submit" name="id" value="{{$user->id}}" class="btn btn-secondary"><i class="fas fa-user-slash"></i> Borrar contacto</button>
                </form>
                @if(!Auth::user()->sentReports()->count())
                    <form action="{{ route('user.reportuser') }}" method="post" class="my-auto mr-3">
                        @csrf
                        <button type="submit" name="id" value="{{$user->id}}" class="btn btn-secondary"><i class="fas fa-thumbs-down"></i> Reportar contacto</button>
                    </form>
                @endif
            @elseif(!$sentRequest && !$receivedRequest)
                <form action="{{ route('user.requestcontact') }}" method="post" class="my-auto ml-auto mr-3">
                    @csrf
                    <button type="submit" name="id" value="{{$user->id}}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Enviar solicitud de contacto</button>
                </form>
            @elseif($receivedRequest)
                <form action="{{ route('user.addcontact') }}" method="post" class="my-auto ml-auto mr-3">
                    @csrf
                    <button type="submit" name="id" value="{{$user->id}}" class="btn btn-primary"><i class="fas fa-user-plus"></i> Añadir contacto</button>
                </form>
                <form action="{{ route('user.deleterequest') }}" method="post" class="my-auto mr-3">
                    @csrf
                    <button type="submit" name="id" value="{{$user->id}}" class="btn btn-danger"><i class="fas fa-user-plus"></i> Rechazar contacto</button>
                </form>
                @if(!Auth::user()->sentReports()->count())
                    <form action="{{ route('user.reportuser') }}" method="post" class="my-auto mr-3">
                        @csrf
                        <button type="submit" name="id" value="{{$user->id}}" class="btn btn-secondary"><i class="fas fa-thumbs-down"></i> Reportar contacto</button>
                    </form>
                @endif
            @endif
            @if($user->receivedReports()->count() >= 3 && $user->receivedReports()->count() <= 10 && !$user->blocked)
                <form action="{{ route('user.blockuser') }}" method="post" class="my-auto mr-3">
                    @csrf
                    <button type="submit" name="id" value="{{$user->id}}" class="btn btn-danger"><i class="fas fa-lock"></i> Bloquear usuario</button>
                </form>
            @elseif($user->receivedReports()->count() >= 10)
                <form action="{{ route('user.show', $user->id) }}" method="post" class="my-auto mr-3">
                    @csrf
                    @method('DELETE')
                    <button type="submit" name="id" class="btn btn-danger"><i class="fas fa-user-minus"></i> Borrar usuario</button>
                </form>
            @endif
            @if($user->blocked)
                    <small class="text-secondary my-auto mr-3"><i class="fas fa-lock"></i> Usuario bloqueado</small>
            @endif
        @endif
    </div>
    <hr>
    <p><strong>Email: </strong>{{$user->email}}</p>
    <p><strong>Género: </strong>{{$user->gender->description}}</p>
    <p><strong>Dirección</strong>: </strong>{{$user->address}}</p>
    <p><strong>Número de teléfono: </strong>{{$user->phone_number}}</p>
@endsection