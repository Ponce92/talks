<div class="row">
    @if($errors->any())
        <div class="col col-md-12">
            <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <strong>Error !</strong> Se encontraron errores al processar el formulario.
            </div>
        </div>

    @endif
</div>

<form action="#" method="post" data-url="{{ route('groups.store') }}" id="formCreate">
{{--    <input type="text" name="rol_id" value="" id="rol_id">--}}
    <div class="form-body">
        <div class="row">
            <div class="col col-sm-12 col-md-12">
                <label class="label" for="name">Nombre del grupo :</label>
                <fieldset class="form-group">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $errors->any() ? $name:'' }}"
                           class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('name') }}
                        </small>

                    </p>
                </fieldset>
                <div class="form-group">
                    <label class="desc" for="desc">Descripcion :</label>
                    <textarea name="desc"
                              class="form-control {{ $errors->has('desc') ? 'border-danger':'' }}"
                              id="desc"
                              cols="30"
                              rows="3">{{ $errors->any() ? $desc:'' }}</textarea>
                        <p class="text-right">
                            <small class="danger text-muted">
                                {{ $errors->first('desc') }}
                            </small>
                        </p>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="estado"
                                   name="estado"
                                   @if($errors->any())
                                   {{ $estado ? 'checked': '' }}
                                   @endif
                                   value="true">
                            <label class="form-check-label" for="estado">Activo</label>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

