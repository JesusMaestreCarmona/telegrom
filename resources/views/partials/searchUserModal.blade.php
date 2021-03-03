<div class="modal fade" id="searchModal" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h6 class="modal-title">Buscar usuario</h6>
                <span class="closeModal" data-dismiss="modal">Cerrar</span>
            </div>
            <form action="{{ route('user.findbyemail') }}" method="post">
                @csrf
                <div class="modal-body">
                    <input type="email" name="email" placeholder="Email del usuario (example@example.com)" class="form-control" autofocus>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary"><i class="fas fa-eraser"></i> Borrar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar usuario</button>
                </div>
            </form>
        </div>
    </div>
</div>