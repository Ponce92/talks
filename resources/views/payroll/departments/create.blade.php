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

<form action="#" method="post" data-url="{{ route('departments.store') }}" id="formCreate">
{{--    <input type="text" name="rol_id" value="" id="rol_id">--}}
    <div class="form-body">
        <div class="row">
            <div class="col col-sm-8 col-md-8">
                <label class="label" for="name">Nombre :</label>
                <fieldset class="form-group">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $errors->any() ? $obj->getName():'' }}"
                           class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('name') }}
                        </small>

                    </p>
                </fieldset>
            </div>
            <div class="col col-md-4">
                <label class="label" for="name">Codigo :</label>
                <fieldset class="form-group">
                    <input type="text"
                           id="code"
                           name="code"
                           value="{{ $errors->any() ? $obj->getCode():'' }}"
                           class="form-control {{ $errors->has('code') ? 'border-danger':'' }} ">
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('code') }}
                        </small>

                    </p>
                </fieldset>
            </div>
            <div class="col col-md-12">
                <div class="form-group">
                    <label class="desc" for="desc">Descripcion :</label>
                    <textarea name="desc"
                              class="form-control mb-5 {{ $errors->has('desc') ? 'border-danger':'' }}"
                              id="desc"
                              cols="30"
                              rows="3">{{ $errors->any() ? $obj->getDesc():'' }}</textarea>
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('desc') }}
                        </small>
                    </p>
                </div>
            </div>

        </div>
    </div>
</form>

