<form method="POST" action="{{ route( (Route::is('register'))? 'register' : 'user.update', Auth::id()) }}" enctype="multipart/form-data">
    @csrf
    @auth()
        @method('PUT')
    @endauth
    <div class="form-group row mx-auto">
        <div class="col-12 text-center my-3">
            <img id="userImage" src="{{ asset((Auth::user() && Auth::user()->img)? 'storage/img/'.Auth::user()->img : 'storage/img/genericUser.png') }}" class="rounded-circle border" width="100px" height="100px">
            <input id="fileInput" type="file" name="image" class="@error('image') is-invalid @enderror" hidden>
            <p class="mt-1">Click en la foto para seleccionar</p>

            @error('image')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

        </div>
    </div>

    <div class="form-group row mx-auto">
        <label for="name" class="col-md-4 col-form-label">Nombre: </label>

        <div class="col-md-6">
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()? Auth::user()->name : old('name') }}" autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mx-auto">
        <label for="last_name" class="col-md-4 col-form-label">Apellido: </label>

        <div class="col-md-6">
            <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ Auth::user()? Auth::user()->last_name : old('last_name') }}" autocomplete="last_name">

            @error('last_name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    @guest
        <div class="form-group row mx-auto">
            <label for="email" class="col-md-4 col-form-label">Email: </label>

            <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()? Auth::user()->email : old('email') }}" autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mx-auto">
            <label for="password" class="col-md-4 col-form-label">Contraseña: </label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="form-group row mx-auto">
            <label for="password-confirm" class="col-md-4 col-form-label">Confirmar contraseña: </label>

            <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password">
            </div>
        </div>
    @endauth

    <div class="form-group row mx-auto">
        <label for="address" class="col-md-4 col-form-label">Dirección: </label>

        <div class="col-md-6">
            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ Auth::user()? Auth::user()->address : old('address') }}">

            @error('address')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mx-auto">
        <label for="phone_number" class="col-md-4 col-form-label">Teléfono: </label>

        <div class="col-md-6">
            <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ Auth::user()? Auth::user()->phone_number : old('phone_number') }}">

            @error('phone_number')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mx-auto">
        <label for="gender" class="col-md-4 col-form-label">Géneros: </label>

        <div class="col-md-6">
            <select id="gender" class="form-control" name="gender">
                @foreach($genders as $gender)
                    <option value="{{$gender->id}}" @auth {{($gender->id == Auth::user()->gender_id)? 'selected' : '' }} @endauth>{{$gender->description}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="form-group row mx-auto">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">{{ (Route::is('register'))? 'Registrarse' : 'Actualizar'}}</button>
        </div>
    </div>
</form>

<script>
    $('#userImage').on('click', function() {
        $('#fileInput').click();
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#userImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#fileInput").change(function(){
        readURL(this);
    });
</script>
