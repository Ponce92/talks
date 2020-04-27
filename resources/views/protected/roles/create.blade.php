

<form action="#" method="post" data-url="{{ route('roles.store') }}" id="formCreate">
{{--    <input type="text" name="rol_id" value="" id="rol_id">--}}
    <div class="form-body">
        <div class="row">
            <div class="col col-sm-12 col-md-12">
                <label class="label" for="name">Nombre <span class="red">*</span>:</label>
                <div class="form-group mb-1">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $errors->any() ? $name:'' }}"
                           class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">

                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>

                </div>
                <div class="form-group mb-0">
                    <label class="desc" for="desc">Descripcion <span class="red">*</span>:</label>
                    <textarea name="desc"
                              class="form-control {{ $errors->has('desc') ? 'border-danger':'' }}"
                              id="desc"
                              cols="30"
                              rows="3">{{ $errors->any() ? $desc:'' }}</textarea>
                    <div class="text-danger">
                        {{ $errors->first('desc') }}
                    </div>
                </div>
                <br>
                <div class="form-group mb-0">
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
    <div class="form-actions center" style="padding: 10px;">
        <button type="button"
                onclick="loadCardAjax('{{route('roles.create')}}',$('#rol_card_trg'))"
                class="btn btn-outline-danger btn-cancel"
                data-dismiss="modal">Cancelar</button>
        <button type="button"
                form="formCreate"
                onclick="loadCardPostAjax($('#formCreate'),$('#rol_card_trg'))"
                class="btn btn-outline-green">Agregar</button>
    </div>


</form>

