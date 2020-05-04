
<form action="#"
      method="put"
      data-url="{{ route('users.update',$user->getId()) }}"
      autocomplete="off"
      id="formEdit">
    <div class="form-body mb-0">
        <div class="row">
            <div class="col col-sm-12 col-md-12">
                <label class="label" for="name">Nombre de usuario :</label>
                <div class="form-group">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $user->getName() }}"
                           class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">
                    <div class="col-md-12 text-danger">
                        {{ $errors->first('name') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <label for="rol">Rol de usuario : </label>
                <div class="form-group">
                    <select name="rol"
                            id="rol"
                            class="form-control {{ $errors->has('rol') ? 'border-danger':'' }}">
                        @foreach($roles as $pvt)
                            <option value="{{ $pvt->getId() }}" {{ $pvt->getId() == $user->rol->getId() ? 'selected':'' }}  >
                                {{ $pvt->getName() }}
                            </option>
                        @endforeach
                    </select>
                    <div class="col col-md-12 text-danger">
                        {{ $errors->first('rol') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">


                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="checkbox"
                               id="estado"
                               name="estado"
                               {{ $user->getState() ?  "checked":""}}
                               value="true"
                        >
                        <label class="form-check-label" for="estado">Activo</label>
                    </div>
            </div>
        </div>

    </div>
    <div class="form-actions right">
        <button type="button"
                onclick="loadCardAjax('{{ route('users.create') }}',$('#card_user'));clearCard($('#card_permission'));clearCard($('#card_groups'));"
                class="btn btn-outline-danger btn-cancel"
                >Cancelar</button>
        <button type="button"
                onclick="loadCardPostAjax($('#formEdit'),$('#card_user'))"
                class="btn btn-outline-green">Guardar</button>
    </div>
</form>

