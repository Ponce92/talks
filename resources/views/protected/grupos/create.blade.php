
<form action="#" method="post" data-url="{{ route('groups.store') }}" id="formCreate">
{{--    <input type="text" name="rol_id" value="" id="rol_id">--}}
    <div class="form-body">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <label class="label" for="name">Nombre del grupo :</label>
                <div class="form-group">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $group->getName() }}"
                           class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">
                        <div class="text-danger col-md-12">
                            {{ $errors->first('name') }}
                        </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12  mb-1">
                <label for="group">Seleccione grupo <span class="red"> *</span></label>
                <div class="form-group">
                    <select name="groupType"
                            class="form-control {{ $errors->has('groupType')? 'border-danger':'' }}"
                            id="groupType">
                        <option value="">Seleccione clasificacion</option>
                        <option value="Planilla">Planillas</option>
                        <option value="Administrador">Administrador</option>
                        <option value="Recursos">Recursos</option>
                        <option value="Otros">Otros</option>
                    </select>
                    <div class="col-md-12 text-danger">
                        {{$errors->first('groupType')}}
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="form-group">
                    <label class="desc" for="desc">Descripcion :</label>
                    <textarea name="desc"
                              class="form-control {{ $errors->has('desc') ? 'border-danger':'' }}"
                              id="desc"
                              cols="30"
                              rows="3">{{ $group->getDesc() }}</textarea>
                    <div class="col-md-12 text-danger">
                        {{ $errors->first('desc') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="input-group">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="checkbox"
                               id="estado"
                               name="estado"
                               @if($group->isActivo())
                               checked
                               @endif
                               value="true">
                        <label class="form-check-label" for="estado">Activo</label>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions right">
        <button type="button"
                onclick="loadCardAjax('{{route('groups.create')}}',$('#card_group'))"
                class="btn btn-danger btn-cancel"
                data-dismiss="modal">Cancelar</button>
        <button type="button"
                onclick="loadCardPostAjax($('#formCreate'),$('#card_group'))"
                class="btn btn-green">Agregar</button>
    </div>
</form>


