
<form action="#" method="put" data-url="{{ route('groups.update',$group->getId())}}" id="formEdit">
    <input type="text" name="id" value="{{ $group->getId() }}" id="id" hidden>
    <div class="form-body">
        <div class="row">
            <div class="col col-sm-12 col-md-12">
                <label class="label" for="name">Nombre :</label>
                <div class="form-group">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $group->getName() }}"
                           class="form-control
                                   @if($errors->any() && $errors->has('name'))
                                       border-danger
                                   @endif"
                    >
                    <div class="col-md-12 text-danger">
                        {{ $errors->first('name') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 ">
                <label for="groupType">Seleccione grupo <span class="red"> *</span></label>
                <div class="form-group">
                    <select name="groupType"
                            class="form-control {{ $errors->has('groupType')? 'border-danger':'' }}"
                            id="groupType">
                        <option value="Planilla" {{ $group->getGroup()=="Planilla" ? 'checked':'' }}>Planillas</option>
                        <option value="Administrador" {{ $group->getGroup()=="Administrador" ? 'checked':'' }}>Administrador</option>
                        <option value="Recursos" {{ $group->getGroup()=="Recursos" ? 'checked':'' }}>Recursos</option>
                        <option value="Otros" {{ $group->getGroup()=="Otros" ? 'checked':'' }}>Otros</option>
                    </select>
                    <div class="col-md-12 text-danger">
                        {{$errors->first('groupType')}}
                    </div>
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="desc" for="desc">Descripcion :</label>
                    <textarea name="desc"
                              class="form-control @if($errors->any() && $errors->has('desc'))
                                  border-danger @endif"
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
            <div class="col-md-12">
                <div class="form-group">
                    <div class="input-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="estado"
                                   name="estado"
                                   {{ $group->isActivo() ? 'checked':'' }}
                                   value="true">
                            <label class="form-check-label" for="estado">Activo</label>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions right">
        <button type="button"
                onclick="loadCardAjax('{{route('groups.create')}}',$('#card_group'));
                    clearCard($('#card_permission'))"
                class="btn btn-danger btn-cancel"
                >Cancelar</button>
        <button type="button"
                onclick="loadCardPostAjax($('#formEdit'),$('#card_group'))"
                class="btn btn-green">
            Guardar
        </button>
    </div>
</form>
