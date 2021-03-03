<div class="modal fade big-modal" id="writeModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h6 class="modal-title">Redactar mensaje</h6>
                <span class="closeModal" data-dismiss="modal">Cerrar</span>
            </div>
            @if($users->isEmpty())
                <div class="alert alert-warning text-center mb-0">No tienes contactos a los que mandar un mensaje</div>
            @endif
            <form action="{{ route('message.store') }}" method="post">
                @csrf

                <div class="modal-body">
                    <div class="form-group">
                        <label>Para:</label>
                        <select class="form-control" name="recipient" {{($users->isEmpty())? 'disabled' : '' }}>
                            @foreach($users as $user)
                                <option value="{{$user->id}}">{{$user->name.' ('.$user->email.')'}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Asunto:</label>
                        <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" required>

                        @error('subject')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <hr>
                    <div class="form-group">
                        <div id="editor"></div>
                        <input type="hidden" id="quill-html" name="body" class="@error('body') is-invalid @enderror" required>

                        @error('body')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mt-2" id="limpiarQuill"><i class="fas fa-eraser"></i> Borrar</button>
                    <button type="submit" class="btn btn-primary mt-2" name="insertar" {{($users->isEmpty())? 'disabled' : '' }}><i class="fas fa-envelope"></i> Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>
