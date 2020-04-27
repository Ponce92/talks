@include('layout.flash')

<form action="#" method="post" data-url="{{ route('jobs.store') }}" id="formCreate">
    <div class="form-body">
        <div class="row">
            <div class="col col-md-6">
                <label class="label" for="department">Departamento:</label>
                <fieldset class="form-group">
                    <select name="department"
                            onchange="fillSelect('{{route('getJobsPost')}}','#positionSel','#department','Seleccione puesto');"
                            class="form-control"
                            id="department">
                        <option value="" disabled selected >Seleccione departamento</option>
                        @if($errors->any())
                            @foreach($departments as $dep)
                                <option value="{{$dep->getId()}}"
                                        {{$dep->getId()==$department ? 'selected':''}}
                                >
                                    {{ $dep->getName() }}
                                </option>
                            @endforeach
                        @else
                            @foreach($departments as $dep)
                                <option value="{{$dep->getId()}}">
                                    {{ $dep->getName() }}
                                </option>
                            @endforeach
                        @endif

                    </select>
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('department') }}
                        </small>
                    </p>
                </fieldset>
            </div>
            <div class="col col-md-6">
                <label class="label" for="positionSel">Puesto :</label>
                <fieldset class="form-group">
                    <select name="positionSel" disabled class="form-control" id="positionSel">
                        <option value="">Seleccione puesto</option>
                    </select>
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('positionSel') }}
                        </small>
                    </p>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="vacantes">Cantidad de vacantes :</label>
            </div>
            <div class="col col-md-6 offset-md-3">
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
</form>

