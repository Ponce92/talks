<form action="#"
      method="POST"
      data-url="{{ route('jobs.store') }}"
      id="formCreate">
    <input type="number"
           id="position"
           name="position"
           hidden
           value="{{ $job->position->getId() }}" >


    <div class="form-body">
        @if($job->position->reqArea())
            <div class="row">
                <div class="col col-md-12">
                    <input type="text"
                           hidden
                           name="reqDep"
                           value="true">
                    <label class="label" for="department">Departamento:</label>
                    <div class="form-group">
                        <select name="department"
                                onchange="fillSelect($('#department'),$('#areas'));"
                                data-url="{{ route('postions.area') }}"
                                class="form-control"
                                id="department">
                            <option value="" selected disabled >Seleccione departamento </option>
                            @foreach($departments as $dep)
                                <option value="{{ $dep->getId() }}"
                                        {{ $job->getDep()->getId()==$dep->getId() ? 'selected':'' }}
                                >
                                    {{ $dep->getName() }}
                                </option>
                            @endforeach
                        </select>
                        <div class="col-md-12 text-danger">
                            {{ $errors->has('department') ? 'Debe selecionar un departamento ':'' }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                        <div class="col col-md-12">
                            <input type="text"
                                   hidden
                                   name="reqArea"
                                   value="true">
                            <label class="label" for="positionSel">Area :</label>
                            <div class="form-group">
                                <select name="area"
                                        disabled
                                        class="form-control"
                                        id="areas">
                                    <option value="" >Seleccione area</option>
                                </select>

                            </div>
                            <div class="col-md-12 text-danger">
                                {{ $errors->has('area') ? 'Debe selecionar el area ':'' }}
                            </div>
                        </div>
            </div>
        @else
            @if($job->position->reqDep())
                <div class="row">
                    <div class="col col-md-12">
                        <input type="text"
                               hidden
                               name="reqDep"
                               value="true">
                        <label class="label" for="department">Departamento:</label>
                        <div class="form-group">
                            <select name="department"
                                    data-url="{{ route('postions.area') }}"
                                    class="form-control"
                                    id="department">
                                <option value="" selected disabled >Seleccione departamento </option>
                                @foreach($departments as $dep)
                                    <option value="{{ $dep->getId() }}"
                                        {{ $job->getDep()->getId()==$dep->getId() ? 'selected':'' }}
                                    >
                                        {{ $dep->getName() }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="col-md-12 text-danger">
                                {{ $errors->has('department') ? 'Debe selecionar un departamento ':'' }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endif

        <div class="col-md-12">
            <label for="vacantes">Cantidad de vacantes :</label>
            <div class="">
                <fieldset>
                    <div class="input-group bootstrap-touchspin">
                        <span class="input-group-btn input-group-prepend bootstrap-touchspin-injected">
                            <button class="btn btn-success bootstrap-touchspin-down"
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
                            <button class="btn btn-success bootstrap-touchspin-up"
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

    </div>
    <div class="form-actions right">
            <button class="btn btn-grey"
                    type="button"
                    onclick="$('#createBtn').click();">
                    <i class="icon-close"></i>                Cancelar
            </button>
            <button type="button"
                    onclick="loadCardPostAjax($('#formCreate'),$('#mainCard'))"
                    class="btn btn-green">
                <i class="icon-save"></i> Crear
            </button>

    </div>
</form>

