@extends('layouts.app')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th></th>
            <th>Apellido</th>
            <th>Nombre</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody class="pt-4">
        @foreach($users as $user)
            <tr data-toggle="modal" data-target="#contactModal" data-contact="{{$user}}" data-show-contact-link="{{ route('user.show', $user->id) }}">
                <td class="pl-4">
                    <img src="{{asset((isset($user->img))? 'storage/img/'.$user->img : 'storage/img/genericUser.png')}}" class="rounded-circle img-usuario border">
                </td>
                <td>{{$user->last_name}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    @include('partials.contactModal')
    <script>
        $('tr').on('click', function () {
            $('#name-modal').text($(this).data('contact').name + ' ' + $(this).data('contact').last_name);
            $('#email-modal').text($(this).data('contact').email);
            $('#show-contact-link').attr('href', $(this).data('show-contact-link'));
        });
    </script>
@endsection