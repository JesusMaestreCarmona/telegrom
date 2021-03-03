<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <ul class="navbar-nav">
        <a class="navbar-brand my-auto" href="{{ route('home') }}">
            TELEGROM
        </a>
        <li class="nav-item my-auto">
            <a class="nav-link" href="{{ route('home') }}">
                <i class="fas fa-inbox"></i> Bandeja de entrada
            </a>
        </li>
        <li class="nav-item my-auto">
            <a class="nav-link" href="{{ route('sentmessages') }}">
                <i class="fas fa-envelope"></i> Mensajes enviados
            </a>
        </li>
        <li class="nav-item my-auto">
            <a class="nav-link" href="{{ route('confirmedcontacts') }}">
                <i class="fas fa-address-book"></i> Contactos
            </a>
        </li>
        <li class="nav-item my-auto">
            <a class="nav-link" href="{{ route('contactrequests') }}">
                <i class="fas fa-users"></i>
                @if(isset($contactRequests) && $contactRequests->count() != 0)
                    <span class="badge rounded-circle badge-danger">{{$contactRequests->count()}}</span>
                @endif
                <span>Peticiones de contacto</span>
            </a>
        </li>
        <li class="nav-item my-auto">
            <span class="nav-link" data-toggle="modal" data-target="#searchModal">
                <i class="fas fa-search"></i> Buscar usuario
            </span>
        </li>
        @if(Auth::user()->roles()->where('name', 'admin')->exists())
            <li class="nav-item my-auto">
                <a class="nav-link" href="{{ route('admin') }}">
                    <i class="fas fa-user-lock"></i> Funciones administrador
                </a>
            </li>
        @endif
    </ul>
    <div class="ml-auto">
        <span id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{Auth::user()->name.' '.Auth::user()->last_name}}
            <img src="{{asset((isset(Auth::user()->img))? 'storage/img/'.Auth::user()->img : 'storage/img/genericUser.png')}}" class="rounded-circle img-usuario border">
        </span>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{ route('user.edit') }}">
                <i class="fas fa-user-cog"></i> Modificar datos
            </a>
            <hr class="hrMenu">
            <a class="dropdown-item" href="{{ route('logout') }}"
               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i> Cerrar sesión
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
</nav>
