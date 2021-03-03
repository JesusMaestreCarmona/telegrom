@extends('layouts.app')

@section('content')
        <table class="table table-hover">
        <thead>
        <tr>
            <th></th>
            <th>Asunto</th>
            <th>Cuerpo</th>
            <th>Fecha</th>
        </tr>
        </thead>
        <tbody class="pt-4">
        @foreach($messages as $message)
            <tr class="{{($message->read)? 'read' : ''}}" data-url="{{ route('message.show', $message->id) }}">
                <td class="pl-4"><div>{{Route::is('home')? 'De: '.$message->getWriter->name : 'Para: '.$message->getRecipient->name}}</div></td>
                <td><div>{{$message->subject}}</div></td>
                <td><div>{!!$message->body!!}</div></td>
                <td>{{$message->created_at}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <script>
        $('tbody tr').on('click', function () {
           window.location = $(this).data('url');
        });
    </script>
@endsection
