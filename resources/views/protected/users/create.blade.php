<form action="#" method="post" data-url="{{ route('users.store') }}" autocomplete="nope" id="formCreate">
    <div class="form-body">
        <div class="row">
            <div class="col col-sm-12 col-md-12">
                <label class="label" for="name">Nombre de usuario :</label>
                <div class="form-group">
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
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <label for="password">Password</label>
                <div class="form-group">
                    <input type="password"
                           name="password"
                           class="form-control {{ $errors->has('password') ? 'border-danger':'' }}"
                           autocomplete="none">
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('password') }}
                        </small>

                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Repita password</label>
                    <input type="password"
                           name="password_confirmation"
                           class="form-control {{ $errors->has('password') ? 'border-danger':'' }} "
                           autocomplete="off" >
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="Rol">Seleccione</label>
                    <select name="rol" id="rol"  class="form-control {{ $errors->has('rol') ? 'border-danger':'' }}">
                        <option value="">Selecione rol</option>

                            @if($errors->any())
                                @foreach($roles as $obj)
                                    <option value="{{ $obj->getId() }}" {{ $obj->getId() == $rol ? 'selected':'' }}  >
                                        {{ $obj->getName() }}
                                    </option>
                                @endforeach
                            @else
                                @foreach($roles as $obj)
                                    <option value="{{ $obj->getId() }}">{{ $obj->getName() }}</option>
                                @endforeach
                            @endif

                    </select>
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('rol') }}
                        </small>

                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="input-group">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="checkbox"
                                   id="estado"
                                   name="estado"
                                   @if($errors->any())
                                   {{ $estado ? 'checked': '' }}
                                   @else
                                       checked
                                   @endif
                                   value="true"
                            >
                            <label class="form-check-label" for="estado">Activo</label>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions right">
        <button type="button"
                onclick="loadCardAjax('{{ route('users.create') }}',$('#card_usuario'))"
                class="btn btn-danger  "
                data-dismiss="modal">Cancelar</button>
        <button type="button"
                onclick="loadCardPostAjax($('#formCreate'),$('#card_usuario'))"
                class="btn btn-green">Agregar</button>
    </div>
</form>

