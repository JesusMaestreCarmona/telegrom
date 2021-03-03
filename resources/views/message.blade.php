@extends('layouts.info')

@section('content')
    <div class="row">
        <a href="{{ route('user.show', $message->getWriter->id) }}" class="text-dark text-decoration-none">
            <div class="media ml-4 mt-2">
                <img src="{{asset((isset($message->getWriter->img))? 'storage/img/'.$message->getWriter->img : 'storage/img/genericUser.png')}}" class="rounded-circle img-usuario border my-auto">
                <div class="media-body ml-3">
                    <h6 class="my-auto">De: {{$message->getWriter->name}}</h6>
                    <p class="text-muted">{{$message->getWriter->email}}</p>
                </div>
            </div>
        </a>
        <a href="{{ route('user.show', $message->getRecipient->id) }}" class="text-dark text-decoration-none ml-auto">
            <div class="media mr-4 mt-2">
                <div class="media-body mr-3">
                    <h6 class="my-auto">Para: {{$message->getRecipient->name}}</h6>
                    <p class="float-right text-muted">{{$message->getRecipient->email}}</p>
                </div>
                <img src="{{asset((isset($message->getRecipient->img))? 'storage/img/'.$message->getRecipient->img : 'storage/img/genericUser.png')}}" class="rounded-circle img-usuario border my-auto">
            </div>
        </a>
    </div>
    <h6 class="mt-4 ml-3 pb-1">
        Asunto: {{$message->subject}}
        @if($message->getWriter->id == Auth::id() && $message->read)
            <small class="float-right text-secondary my-auto mr-3"><i class="fas fa-eye"></i> Leído</small>
        @endif
    </h6>
    <hr>
    <div class="px-3 py-1 text-justify">
        {!! $message->body !!}
    </div>
@endsection