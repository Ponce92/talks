<form action="#" method="post" data-url="{{ route('jobs.store') }}" id="formCreate">
    <div class="form-body">

        <div class="col col-md-12">
            <label class="label" for="department">Departamento:</label>
            <div class="form-group">
                <select name="department"
                        onchange="fillSelect($('#department'),$('#areas'));"
                        class="form-control"
                        id="department">
                        <option value="" selected disabled >Seleccione departamento </option>
                        @foreach($departments as $dep)
                            <option value="{{ route('postions.area',$dep->getId()) }}">
                                    {{ $dep->getName() }}
                            </option>
                        @endforeach
                </select>
                <div class="col-md-12 text-danger">
                    {{ $errors->first('department') }}
                </div>
            </div>
        </div>
        <div class="col col-md-12">
            <label class="label" for="positionSel">Area :</label>
            <div class="form-group">
                <select name="areas"

                        disabled class="form-control" id="areas">
                    <option value="">Seleccione puesto</option>
                </select>
                <div class="col-md-8">
                    {{ $errors->first('positionSel') }}
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-2">
            <label for="none">Puesto <span class="red"></span>:</label>
            <fieldset>
                <div class="input-group bootstrap-touchspin">
                    <input type="text"
                           name="none"
                           id="none"
                           style="background: white;"
                           readonly
                           class="touchspin form-control"
                           value=""
                           placeholder="Agregar cargo"
                           min="1"
                           max="10">
                    <span class="input-group-btn input-group-append bootstrap-touchspin-injected">
                            <button class="btn btn-primary bootstrap-touchspin-up"
                                    id="btn_less_0p"
                                    onclick="loadCardAjax('{{route('areas.get.positions',["dep"=>$('#department').val(),"area"=>$('#area').val()])}}',$('#addCargoModal'));"
                                    data-toggle="modal"
                                    data-target="#modalCargos"
                                    type="button">
                                <i class="icon-list"></i>
                            </button>
                        </span>
                </div>
            </fieldset>
{{--            <label for="">Cargo de la/s plazas</label>--}}
{{--            <div class="form-inline ">--}}
{{--                <input type="text"--}}
{{--                       readonly--}}
{{--                       placeholder="Agregre cargo"--}}
{{--                       style="background-color: white;"--}}
{{--                       class="form-control"--}}
{{--                       id="posName">--}}
{{--                <button class="btn btn-sm btn-info"--}}
{{--                        form="__blank"--}}
{{--                        onclick="return 0;" >--}}
{{--                    <i class="icon-list2"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
        </div>

        <div class="col-md-12">
            <label for="vacantes">Cantidad de vacantes :</label>
            <div class="">
                <fieldset>
                    <div class="input-group bootstrap-touchspin">
                        <span class="input-group-btn input-group-prepend bootstrap-touchspin-injected">
                            <button class="btn btn-primary bootstrap-touchspin-down"
                                    onclick="updateRangeInput('less','#vacantes')"
                                    id="btn_add_01"
                                    type="button">
                                <i class="icon-minus"></i>
                            </button>
                        </span>
                        <input type="text"
                               name="vacantes"
                               id="vacantes"
                               style="background: white;"
                               readonly
                               class="touchspin form-control"
                               value="{{ $errors->any() ? $vacantes:1 }}"
                               min="1"
                               max="10">
                        <span class="input-group-btn input-group-append bootstrap-touchspin-injected">
                            <button class="btn btn-primary bootstrap-touchspin-up"
                                    onclick="updateRangeInput('add','#vacantes')"
                                    id="btn_less_01"
                                    type="button">
                                <i class="icon-plus"></i>
                            </button>
                        </span>
                    </div>
                </fieldset>
            </div>
        </div>

        <br>
    </div>
    <div class="form-actions right">
            <button class="btn btn-red"
                    type="button"
                    onclick="$('#createBtn').click();">
                Cancelar
            </button>
            <button type="button"
                    onclick=""
                    data-toggle="modal"
                    data-target="#modalCargos"
                    class="btn btn-green">
                Agregar vacantes
            </button>

    </div>
</form>

