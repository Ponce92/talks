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
<form action="#" method="put" data-url="{{ $obj->getId() ? route('positions.update',$obj->getId()):route('positions.store')}}" id="formEdit">
    <input type="text" name="id" value="{{ $obj->getId() }}" id="id" hidden>
    <div class="form-body">
        <div class="row">
            <div class="col col-sm-8 col-md-8">
                <label class="label" for="name">Nombre :</label>
                <fieldset class="form-group">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $obj->getName() }}"
                           class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('name') }}
                        </small>

                    </p>
                </fieldset>
            </div>
            <div class="col col-md-4">
                <label class="label" for="name">Abreviatura :</label>
                <fieldset class="form-group">
                    <input type="text"
                           id="code"
                           {{ $obj->getId() ? 'readonly':'' }}
                           name="code"
                           value="{{ $obj->getCode() }}"
                           class="form-control {{ $errors->has('code') ? 'border-danger':'' }} ">
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('code') }}
                        </small>

                    </p>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col col-md-8">
                <label class="label" for="lob">LOB:</label>
                <fieldset class="form-group">
                    <input type="text"
                           id="lob"
                           name="lob"
                           value="{{ $obj->getLob() }}"
                           class="form-control {{ $errors->has('lob') ? 'border-danger':'' }} ">
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('lob') }}
                        </small>

                    </p>
                </fieldset>
            </div>
            <div class="col col-md-4">
                <label class="label" for="level">Nivel:</label>
                <fieldset class="form-group">
                    <input type="number"
                           min="1"
                           max="15"
                           id="level"
                           name="level"
                           onkeypress="return false;"
                           contenteditable="false"
                           value="{{ $obj->getLevel() }}"
                           class="form-control {{ $errors->has('level') ? 'border-danger':'' }} ">
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('level') }}
                        </small>

                    </p>
                </fieldset>
            </div>
        </div>
    </div>
</form>
