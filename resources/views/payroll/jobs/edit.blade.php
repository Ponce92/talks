@include('layout.flash')

<form action="#" method="post" data-url="{{ route('jobs.update',$obj->getId()) }}" id="formEdit">
    <div class="form-body">
        <div class="row match-height">
            <div class="col col-md-6">
                <label class="label" for="code">Codigo:</label>
                <fieldset class="form-group">
                    <input type="text"
                           class="form-control"
                           readonly
                           value="{{$obj->getCode()}}"
                           id="code"
                           name="code">
                    <p class="text-right">
                        <small class="danger text-muted">
                            {{ $errors->first('code') }}
                        </small>
                    </p>
                </fieldset>
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label for="status">Estado del puesto </label>
                    </div>
                    <div class="col-md-10 offset-md-1" style="padding-top: 5px;">
                        <input class="js-switch"
                               id="status"
                               {{ $obj->getState() ? 'checked':'' }}
                               name="status"
                               type="checkbox"/>
                    </div>
                </div>

                <br>

            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="position_md">Departamento :</label>
                <fieldset class="form-group">
                    <select name="department_md"
                            class="custom-select form-control"
                            disabled
                            id="department_md">
                        <option value="{{$obj->getId()}}">{{$obj->getCode()}}</option>
                    </select>
                </fieldset>
            </div>
            <div class="col-md-6">
                <label for="position_md">Cargo :</label>
                <fieldset class="form-group">

                    <select name="position_md"
                            class="custom-select form-control"
                            disabled
                            id="position_md">
                        <option value="{{$obj->getId()}}">{{$obj->getCode()}}</option>

                    </select>
                </fieldset>
            </div>
        </div>
        <br>
        <p>Empleado asignado:</p>
        <hr>
        <div class="row"></div>
        <br>
    </div>
</form>
@include('layout.flash')
