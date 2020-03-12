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
<form action="#" method="put" data-url="{{ route('groups.update',$Object->getId())}}" id="formEdit">
    <input type="text" name="id" value="{{ $Object->getId() }}" id="id" hidden>
    <div class="form-body">
        <div class="row">
            <div class="col col-sm-12 col-md-12">
                <label class="label" for="name">Nombre :</label>
                <fieldset class="form-group">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $Object->getName() }}"
                           class="form-control
                                   @if($errors->any() && $errors->has('name'))
                                       border-danger
                                   @endif"
                    >
                    <p class="text-right">
                        @if($errors->any() && $errors->has('name'))
                            <small class="danger text-muted">
                                {{ $errors->first('name') }}
                            </small>
                        @endif
                    </p>
                </fieldset>
                <div class="form-group">
                    <label class="desc" for="desc">Descripcion :</label>
                    <textarea name="desc"
                              class="form-control @if($errors->any() && $errors->has('desc'))
                                    border-danger @endif"
                              id="desc"
                              cols="30"
                              rows="3">{{ $Object->getDesc() }}</textarea>
                    <p class="text-right">
                        @if($errors->any() && $errors->has('desc'))
                            <small class="danger text-muted">
                                {{ $errors->first('desc') }}
                            </small>
                        @endif
                    </p>
                </div>
                <div class="form-group">
                    <div class="input-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="estado"
                                   name="estado"

                                   {{ $Object->getState() ? 'checked':'' }}
                                   value="true">
                            <label class="form-check-label" for="estado">Activo</label>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
