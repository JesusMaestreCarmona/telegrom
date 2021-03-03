<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap y Fontawesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <!-- Quill libraries -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- My style -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

</head>
<body class="bg-light">
    <div id="app">
        @include('partials.navbar')
        @if (session('status') && session('type'))
            <div class="alert alert-{{session('type')}} text-center" role="alert">
                <strong>{{ session('status') }}</strong>
            </div>
        @endif
        <main class="py-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6 my-auto">
                                        @if(Route::is('home'))
                                            {!! (isset($messages->countBy('read')['0']))? '<strong class="text-primary">'.$messages->countBy('read')['0'].' mensaje/s sin leer</strong>' : 'No hay mensajes sin leer' !!}
                                        @elseif(Route::is('sentmessages'))
                                            {{ ($messages->count())? 'Has enviado '.$messages->count().' mensaje/s' : 'No has mandado ningún mensaje todavía' }}
                                        @elseif(Route::is('confirmedcontacts'))
                                            {{ ($users->count())? 'Tienes '.$users->count().' contacto/s' : 'No tienes ningún contacto' }}
                                        @elseif(Route::is('contactrequests'))
                                            {{ ($users->count())? 'Tienes '.$users->count().' peticion/es' : 'No tienes ninguna petición' }}
                                        @elseif(Route::is('admin'))
                                            {!! ($users->count())? '<strong class="text-primary">'.$users->count().' usuario/s han sido reportados varias veces</strong>' : 'No hay usuarios reportados varias veces' !!}
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-body px-0">
                                @yield('content')
                                <button type="button" class="btn btn-primary rounded float-right mr-3" data-toggle="modal" data-target="#writeModal"><i class="fas fa-pen-square"></i> Redactar mensaje</button>
                            </div>
                        </div>
                    </div>
                </div>
                @if(isset($messagesToNotify) && !$messagesToNotify->isEmpty())
                    @foreach($messagesToNotify as $messageToNotify)
                        <div class="toast" data-time="{{strtotime($messageToNotify->created_at)}}">
                            <div class="toast-header">
                                <strong class="text-primary mr-5">Mensaje de {{$messageToNotify->getWriter->name}}</strong>
                                <small class="float-right text-muted"></small>
                            </div>
                            <div class="toast-body">
                                {!! $messageToNotify->subject !!}
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </main>
    </div>
    @include('partials.searchUserModal')
    @include('partials.writeModal')
    <script>
    $(function() {
        var toolbarOptions = [
            [{ 'size': ['small', false, 'large', 'huge'] }],
            ['bold', 'italic', 'underline'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['link', 'image'],
            ['clean']
        ];
        const quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions
            }
        }).on('text-change', function() {
            $('#quill-html').val($('#editor .ql-editor').html());
        });
        $("#limpiarQuill").click(function () {
            var element = document.getElementsByClassName("ql-editor");
            element[0].innerHTML = "";
        });
        function showToast(actualToast) {
            let toasts = $('.toast');
            if (actualToast == toasts.length) {
                return;
            }
            let toast = $('.toast:eq(' + actualToast + ')');
            let time = Math.floor(Date.now() / 1000) - toast.data('time');
            let timeToNotify = 'Hace ';

            if (Math.trunc(time/60) <= 0)
                timeToNotify += time + ' segundo/s';
            else if (Math.trunc(time/3600) <= 0)
                timeToNotify += Math.round(time/60) + ' minuto/s';
            else if (Math.trunc(time/86400) <= 0)
                timeToNotify += Math.round(time/3600) + ' hora/s';
            else
                timeToNotify += 'más de un dia';

            $('.toast:eq(' + actualToast + ') small').text(timeToNotify);
            toast.toast({ delay: 2000 });
            toast.toast('show');
            toast.on('hidden.bs.toast', function () {
                showToast(actualToast + 1);
            });
        }
        showToast(0);
    });
</script>
</body>
</html>
