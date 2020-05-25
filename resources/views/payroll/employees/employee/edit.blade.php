@extends('layout.layout')
@section('title') Edit @endsection
@section('hrow')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
        <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Home</a>
                    </li>
                    <li class="breadcrumb-item">Payroll</li>
                    <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Empleados</a>
                    </li>
                    <li class="breadcrumb-item">Edit
                    </li>
                </ol>
            </div>
        </div>
    </div>
@endsection

@section('body')

    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">:: Empleado</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements"></div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active show"
                                   id="baseIcon-tab11"
                                   data-toggle="tab"
                                   aria-controls="tabIcon11"
                                   href="#tabIcon11"
                                   aria-expanded="true">
                                    <i class="icon-cog"></i> Datos del empelado</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link"
                                   id="baseIcon-tab12"
                                   data-toggle="tab"
                                   aria-controls="tabIcon12"
                                   href="#tabIcon12"
                                   aria-expanded="false"><i class="icon-user"></i> Datos personales</a>
                            </li>
                        </ul>
                        <div class="tab-content px-1 pt-1">

                            {{--|====================================================================
                                |   Div que contiene el formulario de edicion del empleado . . .
                                |===================================================================
                            --}}
                            <div role="tabpanel"
                                 class="tab-pane active show"
                                 id="tabIcon11"
                                 aria-expanded="true"
                                 aria-labelledby="baseIcon-tab11">
                                <div class="row">
                                    <div class="col-md-9 offset-md-2">
                                        <form  action="{{ route('employee.update',$employee->getId()) }}"
                                                class="form"
                                                name="frmEditEmployee"
                                                method="post"
                                                id="frmEditEmployee">

                                            @csrf
                                            <div class="row">
                                                <br>
                                                <div class="col-md-3">
                                                    <label for="employeeCode">Codigo :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               id="employeeCode"
                                                               class="form-control @if($errors->has("employeeCode")) border-danger @endif"
                                                               readonly
                                                               value="{{$employee->getCode() }}"
                                                               name="employeeCode">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="employeeStatus">Estado:</label>
                                                    <div class="form-group">
                                                        <input  class="form-control"
                                                                readonly
                                                                value="{{$employee->employeeStatus->getName()}}"
                                                            type="text">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="employeePosition">Cargo</label>
                                                        <div class="input-group">
                                                            <input readonly
                                                                   class="form-control"
                                                                   value="{{$employee->getPosition()->getName()}}"
                                                                   type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="payrollname">Nombre segun planilla :</label>
                                                    <div class="form-group">
                                                        <input  type="text"
                                                                class="form-control"
                                                                readonly
                                                                name="payrollname"
                                                                id="payrollname"
                                                                value="{{ $employee->person->getLastName() }}, {{ $employee->person->getName() }}">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="contractsTypes">Tipo contrato :</label>
                                                    <div class="form-group">
                                                        <select name="contractsTypes"
                                                                id="contractsTypes"
                                                                class="form-control @if($errors->has("contractsTypes")) border-danger @endif">
                                                            <option value="" disabled {{ $errors->any() ?'':'selected' }}>
                                                                Selecione el estado
                                                            </option>
                                                            @foreach($contractsTypes as $pivot)
                                                                <option value="{{$pivot->getId()}}"
                                                                @if($errors->any())
                                                                    {{ old('contractsTypes')== $pivot->getId() ? 'selected':'' }}
                                                                    @else
                                                                    {{ $employee->contractType->getId()== $pivot->getId() ? 'selected':'' }}
                                                                    @endif>
                                                                    {{ $pivot->getName() }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("contractsTypes") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="entryDate">Fecha ingreso:</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               class="form-control @if($errors->has("entryDate")) border-danger @endif"
                                                               id="entryDate"
                                                               value="{{$employee->getEntryDate() }}"
                                                               placeholder="-- / -- /--"
                                                               name="entryDate">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("entryDate") }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="endDate">Fecha baja :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               readonly
                                                               id="endDate"
                                                               value="{{ $employee->getEndDate()}}"
                                                               class="form-control @if($errors->has("endDate")) border-danger @endif"
                                                               placeholder="--/--/--"
                                                               name="endDate">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("endDate") }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="employee_park">Parqueo :</label>
                                                    <div class="form-group">
                                                        <select name="parkingTypes"
                                                                id="parkingTypes"
                                                                class="form-control @if($errors->has("parkingTypes")) border-danger @endif">
                                                            <option value="" disabled>Selecione tipo parqueo
                                                            </option>
                                                            @foreach($parkingTypes as $pivot)
                                                                <option value="{{$pivot->getId()}}"
                                                                @if($errors->any())
                                                                    {{ old('parkingTypes')== $pivot->getId() ? 'selected':'' }}
                                                                    @else
                                                                    {{ $employee->parkingType->getId()== $pivot->getId() ? 'selected':$employee->parkingType }}
                                                                    @endif>
                                                                    {{ $pivot->getName() }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("parkingTypes") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="mail">Correo intitucional :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               id="mail"
                                                               value="{{ $employee->getEmail() }}"
                                                               class="form-control @if($errors->has("mail")) border-danger @endif"
                                                               placeholder="usuario@talkamericas.com"
                                                               name="mail">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("mail") }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label for="userVicidial">Usuario vicidial :</label>
                                                        <input type="text"
                                                               id="userVicidial"
                                                               class="form-control @if($errors->has("userVicidial")) border-danger @endif"
                                                               value="{{ $employee->getUserVic()}}"
                                                               name="userVicidial">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("userVicidial") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="headsetCode">Codigo headset :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               id="headsetCode"
                                                               value="{{$employee->getHeadsetCode()}}"
                                                               class="form-control @if($errors->has("headsetCode")) border-danger @endif"
                                                               placeholder="RJ45-B"
                                                               name="headsetCode">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("headsetCode") }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="loker">Loker :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               name="loker"
                                                               id="loker"
                                                               value="{{ $employee->getLoker()}}"
                                                               placeholder="AB34"
                                                               class="form-control @if($errors->has("loker")) border-danger @endif">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("loker") }}
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="biometric">Accesso biometrico :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               id="biometric"
                                                               name="biometric"
                                                               value="{{$employee->getBiometric()}}"
                                                               placeholder="code"
                                                               class="form-control @if($errors->has("biometric")) border-danger @endif">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("biometric") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions col-md-9 right">
                                                    <button class="btn btn-success"
                                                            type="submit"
                                                            form="frmEditPerson">
                                                        <i class="icon-save"></i> Guardar
                                                    </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{--
                                |   La pestania contiene el formulario para editar los datos personales y los datos
                                |   del  empleado ..................
                                |
                            --}}
                            <div class="tab-pane" id="tabIcon12" aria-labelledby="baseIcon-tab12">
                                <div class="row">
                                    <br>
                                    <div class="col-md-9 offset-md-2">
                                        <form action="{{route('person.update',$employee->getId())}}"
                                              id="frmEditPerson"
                                              class="form"
                                              name="frmEditPerson"
                                              method="post">
                                            @csrf
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label for="nombres">Nombres :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               id="nombres"
                                                               class="form-control @if($errors->has("nombres")) border-danger @endif"
                                                               placeholder="nombres"
                                                               value="{{$employee->person->getName()}}"
                                                               name="nombres">
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $errors->first("nombres") }}
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="col-md-4">
                                                    <label for="lastname">Apellidos :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               id="lastName"
                                                               class="form-control @if($errors->has("lastName")) border-danger @endif"
                                                               placeholder="name"
                                                               value="{{$employee->person->getLastName()}}"
                                                               name="lastName">
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $errors->first("lastName") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="birthDate">Fecha de nacimiento  :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               readonly
                                                               data-toggle="datepicker"
                                                               id="birthDate"
                                                               value="{{$employee->person->getBirthDate()}}"
                                                               class="form-control @if($errors->has("birthDate")) border-danger @endif"
                                                               name="birthDate">
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $errors->first("birthDate") }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="#">Sexo :</label>
                                                    <div class="form-group">
                                                        <div class="col-md-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input"
                                                                       type="radio"
                                                                       name="sexo"
                                                                       id="optr1"
                                                                       @if($employee->person->getSexo()==0) checked @endif
                                                                       value="0">
                                                                <label class="form-check-label" for="optr1">Masculino</label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input"
                                                                       type="radio"
                                                                       name="sexo"
                                                                       @if($employee->person->getSexo()==1) checked @endif
                                                                       id="optr2"
                                                                       value="1">
                                                                <label class="form-check-label" for="optr2">
                                                                    Femenino
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("sexo") }}
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                    <label for="marital_status">Estado civil  :</label>
                                                    <div class="form-group">
                                                        <select name="maritalStatus"
                                                                class="form-control @if($errors->has("maritalStatus")) border-danger @endif"
                                                                id="maritalStatus">
                                                            @foreach($maritalStatus as $pivot)
                                                                <option value="{{$pivot->getId()}}"
                                                                    {{ $employee->person->maritalStatus->id==$pivot->getId() ? "selected":"" }} >
                                                                    {{ $pivot->getName() }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("maritalStatus") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3">
                                                    <label for="nit">Nit :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               id="nit"
                                                               data-mask="0000-000000-000-0"
                                                               value="{{ $employee->person->getNit()}}"
                                                               class="form-control @if($errors->has("nit")) border-danger @endif"
                                                               placeholder="0000 - 0000000 - 000 - 0"
                                                               name="nit">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("nit") }}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="dui">DUI :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               id="dui"
                                                               data-mask="00000000-0"
                                                               value="{{ $employee->person->getDui()}}"
                                                               class="form-control @if($errors->has("dui")) border-danger @endif"
                                                               placeholder="00000000-0"
                                                               name="dui">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("dui") }}
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-md-9">
                                                    <label for="nombres">Direccion :</label>
                                                    <div class="form-group">
                                                        <input type="text"
                                                               id="address"
                                                               class="form-control @if($errors->has("address")) border-danger @endif"
                                                               placeholder="direccion"
                                                               value="{{$employee->person->getAddress()}}"
                                                               name="address">
                                                        <div class="col-md-12 invalid-feedback text-danger">
                                                            {{ $errors->first("address") }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-9">
                                                    <label for="correo">Correo electronico</label>
                                                    <div class="position-relative has-icon-left">
                                                        <input type="mail"
                                                               name="emaill"
                                                               id="emaill"
                                                               value="{{$employee->person->getEmail()}}"
                                                               class="form-control @if($errors->has("emaill")) border-danger @endif "
                                                               placeholder="user@example.com">
                                                        <div class="form-control-position">
                                                            <i class="icon-email2"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 invalid-feedback text-danger">
                                                        {{ $errors->first("emaill") }}
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="form-actions col-md-9 right">
                                                <div class="row">
                                                    <button class="btn btn-success"
                                                            type="submit"
                                                            form="frmEditPerson">
                                                        <i class="icon-save"></i> Guardar
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script src="{{ asset('plugins/Mask/jquery.mask.js') }}"></script>
    <script type="text/javascript">
        @if(isset($status))

            @if($status=="success")
                showMesssage('success','Datos actualizados correctamente');

            @endif
            @if($status=="form_error")
                showMesssage('notice','Se econtraron errores en el formulario...');
            @endif
        @endif
        @if(isset($person))
            $('#baseIcon-tab12').click();
        @endif
    </script>

@endsection

