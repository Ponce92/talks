<form action="#"
      data-url="{{route('roles.update',$Object->getId()) }}"
      method="PUT"  id="formEdit">
    <div class="form-body">
        <div class="row">
            <div class="col col-sm-12 col-md-12">
                <label class="label" for="name">Nombre :</label>
                <fieldset class="form-group">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $errors->any() ? $name:$Object->getName() }}"
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
                              rows="3">{{ $errors->any() ? $desc:$Object->getDesc() }}</textarea>
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
                                   @if($errors->any())
                                       {{ $state ? 'checked': ''}}
                                   @else
                                        {{ $Object->isActive() ? 'checked':'' }}
                                   @endif
                                   value="true">
                            <label class="form-check-label" for="estado">Activo</label>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions center" style="padding: 10px;">
        <button type="button"
                onclick="loadCardAjax('{{route('roles.create')}}',$('#rol_card_trg'));$('#card_pemissions').html('');"
                class="btn btn-outline-danger btn-cancel"
                data-dismiss="modal">Cancelar</button>
        <button type="button"
                form="formCreate"
                onclick="loadCardPostAjax($('#formEdit'),$('#rol_card_trg'))"
                class="btn btn-outline-green">Guardar</button>
    </div>
</form>
