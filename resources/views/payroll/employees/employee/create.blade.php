@extends('layout.layout')
@section('title') Empleado @endsection

@section('hrow')
    <link  href="{{ asset('plugins/datepiker/css/datepicker.css') }}" rel="stylesheet">
    <div class="col-sm-12 mb-1">
        <div class="content-header-left breadcrumb-new">
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item">Payroll
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{ route('employees.index') }}">Empleados</a>
                        </li>
                        <li class="breadcrumb-item">Crear
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')
    <div class="row">
        @if($errors->any())
            <div class="col col-md-12">
                <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <strong>Error !</strong>
                    Se encontraron errores al processar el formulario.
                    {{ $errors }}
                </div>
            </div>
        @endif
    </div>
    <div class="card">
        <div class="card-header">
            <h4 id="basic-laayout-form"> <strong>::</strong> Ingreso de empleado </h4>
        </div>
        <div class="card-contet">
            <div class="card-body">
                <form class="form" method="post"  action="{{ route('employees.store')  }}" >
                    <br>
                    {{ csrf_field() }}
                    <div class="form-body">
                        <div class="form-row">
                            <div class="col-md-6">
                                <h4 class="form-section">
                                    <i class="icon-person"></i> Datos personales
                                </h4>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="nombres">Nombres <span class="red">*</span> :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   id="nombres"
                                                   class="form-control @if($errors->has("nombres")) border-danger @endif"
                                                   placeholder="nombres"
                                                   value="{{ $errors->any() ? old('nombres'):""}}"
                                                   name="nombres">
                                            <div class="invalid-feedback text-danger">
                                                {{ $errors->first("nombres") }}
                                            </div>
                                        </div>

                                    </div>


                                    <div class="col-md-6">
                                        <label for="lastname">Apellidos <span class="red">*</span> :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   id="lastName"
                                                   class="form-control @if($errors->has("lastName")) border-danger @endif"
                                                   placeholder="name"
                                                   value="{{ $errors->any() ? old('lastName'):""}}"
                                                   name="lastName">
                                            <div class="invalid-feedback text-danger">
                                                {{ $errors->first("lastName") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="birthDate">Fecha de nacimiento <span class="red">*</span> :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   readonly
                                                   data-toggle="datepicker"
                                                   id="birthDate"
                                                   value="{{ $errors->any() ? old('birthDate'):""}}"
                                                   class="form-control @if($errors->has("birthDate")) border-danger @endif"
                                                   name="birthDate">
                                            <div class="invalid-feedback text-danger">
                                                {{ $errors->first("birthDate") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-sm-12">
                                        <label for="#">Sexo <span class="red">*</span> :</label>
                                        <div class="form-group">
                                            <div class="col-md-6">
                                                <div class="form-check">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="sexo"
                                                           id="optr1"
                                                           @if(old('sexo')==0) checked @endif
                                                           value="0">
                                                    <label class="form-check-label" for="optr1">Masculino</label>
                                                </div>
                                            </div>

                                            <div class="col-md-5">
                                                <div class="form-check">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="sexo"
                                                               @if(old('sexo')==1) checked @endif
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
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="nombres">Direccion <span class="red">*</span> :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   id="address"
                                                   class="form-control @if($errors->has("address")) border-danger @endif"
                                                   placeholder="direccion"
                                                   value="{{ $errors->any() ? old('address'):""}}"
                                                   name="address">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("address") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="nit">NIT <span class="red">*</span>:</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   id="nit"
                                                   value="{{ $errors->any() ? old('nit'):""}}"
                                                   class="form-control @if($errors->has("nit")) border-danger @endif"
                                                   placeholder="0000 - 0000000 - 000 - 0"
                                                   name="nit">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("nit") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="dui">DUI <span class="red">*</span> :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   id="dui"
                                                   value="{{ $errors->any() ? old('dui'):""}}"
                                                   class="form-control @if($errors->has("dui")) border-danger @endif"
                                                   placeholder="00000000 - 0"
                                                   name="dui">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("dui") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="marital_status">Estado civil <span class="red">*</span> :</label>
                                        <div class="form-group">
                                            <select name="maritalStatus"
                                                    class="form-control @if($errors->has("maritalStatus")) border-danger @endif"
                                                    id="maritalStatus">
                                                <option value=""
                                                    {{ $errors->any() ?'':'selected' }}>
                                                    Selecione estado civil

                                                </option>
                                                @foreach($maritalStatus as $pivot)
                                                    <option value="{{$pivot->getId()}}"
                                                            {{ old("maritalStatus") ==$pivot->getId() ? "selected":"" }} >
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
                                    <div class="col-md-12">
                                        <label for="correo">Correo electronico</label>
                                        <div class="position-relative has-icon-left">
                                            <input type="mail"
                                                   name="emaill"
                                                   id="emaill"
                                                   value="{{ $errors->any() ? old('emaill'):""}}"
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
{{--        ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ --}}
                            </div>

                            <div class="col-md-6">
                                <h4 class="form-section">
                                    <i class="icon-settings2"></i> Datos de empleado
                                </h4>

                                <div class="row mb-1">
                                    <div class="col-md-5">
                                        <label for="employeeCode">Codigo <span class="red">*</span> :</label>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="text"
                                                       id="employeeCode"
                                                       class="form-control"
                                                       placeholder=""
                                                       value="{{ $errors->any() ? old('employeeCode'):''}}"
                                                       name="employeeCode">
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button" class="btn btn-success">
                                                    <i class="icon-refresh2"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("employeeCode") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <label for="puestoName">Puesto <span class="red">*</span> :</label>
                                        <input type="text"  id="puestoCode" hidden value="{{ $errors->any() ? old('puestoCode'):''}}" name="puestoCode" >
                                        <div class="row">
                                            <div class="col-md-8">
                                                <input type="text"
                                                       class="form-control {{ $errors->has('puestoCode') ? 'border-danger':'' }}"
                                                       readonly
                                                       id="puestoName"
                                                       placeholder="seleccione"
                                                       value="{{ $errors->any() ? old('puestoName'):''}}"
                                                       name="puestoName">
                                                <div class="col-md-12 invalid-feedback text-danger">
                                                    {{ $errors->first("puestoCode") }}
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <button type="button"
                                                        data-toggle="modal"
                                                        data-target="#modalCargos"
                                                        class="btn btn-success">
                                                    <i class="icon-list"></i>
                                                </button>
                                            </div>

                                        </div>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="entryDate">Fecha ingreso <span class="red">*</span> :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   readonly
                                                   data-toggle="datepicker"
                                                   id="entryDate"
                                                   value="{{ $errors->any() ? old('entryDate'):""}}"
                                                   class="form-control @if($errors->has("entryDate")) border-danger @endif"
                                                   placeholder=""
                                                   name="entryDate">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("entryDate") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="employee_contract">Tipo contrato <span class="red">*</span> :</label>
                                        <div class="form-group">
                                            <select name="contractsTypes"
                                                    id="contractsTypes"
                                                    class="form-control @if($errors->has("contractsTypes")) border-danger @endif">
                                                <option value=""
                                                    {{ $errors->any() ?'':'selected' }}>
                                                    Selecione el estado

                                                </option>
                                                @foreach($contractsTypes as $pivot)
                                                    <option value="{{$pivot->getId()}}"
                                                        {{ old("contractsTypes") ==$pivot->getId() ? "selected":"" }} >
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
                                    <div class="col-md-5">
                                        <label for="employee_park">Parqueo :</label>
                                        <div class="form-group">
                                            <select name="parkingTypes"
                                                    id="parkingTypes"
                                                    class="form-control @if($errors->has("parkingTypes")) border-danger @endif">
                                                <option value=""
                                                    {{ $errors->any() ?'':'selected' }}>
                                                    Selecione tipo parqueo
                                                </option>
                                                @foreach($parkingTypes as $pivot)
                                                    <option value="{{$pivot->getId()}}"
                                                        {{ old("parkingTypes") ==$pivot->getId() ? "selected":"" }} >
                                                        {{ $pivot->getName() }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("parkingTypes") }}
                                            </div>
                                        </div>

                                    </div>

                                    <div class="col-md-7">
                                        <label for="mail">Correo intitucional :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   id="mail"
                                                   value="{{ $errors->any() ? old('mail'):""}}"
                                                   class="form-control @if($errors->has("mail")) border-danger @endif"
                                                   placeholder="usuario@talkamericas.com"
                                                   name="mail">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("mail") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">


                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="userVicidial">Usuario vicidial :</label>
                                            <input type="text"
                                                   id="userVicidial"
                                                   class="form-control @if($errors->has("userVicidial")) border-danger @endif"
                                                   placeholder="usuario1"
                                                   value="{{ $errors->any() ? old('userVicidial'):''}}"
                                                   name="userVicidial">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("userVicidial") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="headsetCode">Codigo headset :</label>
                                            <input type="text"
                                                   id="headsetCode"
                                                   value="{{ $errors->any() ? old('headsetCode'):""}}"
                                                   class="form-control @if($errors->has("headsetCode")) border-danger @endif"
                                                   placeholder="RJ45-B"
                                                   name="headsetCode">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("headsetCode") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="loker">Loker :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   name="loker"
                                                   id="loker"
                                                   value="{{ $errors->any() ? old('loker'):""}}"
                                                   placeholder="AB34"
                                                   class="form-control @if($errors->has("loker")) border-danger @endif">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("loker") }}
                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="row"><div class="col-md-12"></div></div>
                                <div class="form-row">

{{--                                    <div class="col-md-4">--}}
{{--                                        <label for="biometric">Accesso biometrico :</label>--}}
{{--                                        <div class="form-group">--}}
{{--                                            <input type="text"--}}
{{--                                                   id="biometric"--}}
{{--                                                   name="biometric"--}}
{{--                                                   value="{{ $errors->any() ? old('biometric'):""}}"--}}
{{--                                                   placeholder="code"--}}
{{--                                                   class="form-control @if($errors->has("biometric")) border-danger @endif">--}}
{{--                                            <div class="col-md-12 invalid-feedback text-danger">--}}
{{--                                                {{ $errors->first("biometric") }}--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
                                    <div class="col-md-4"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12"><br></div>
                        </div>
                        <div class="form-row">


{{--    Refencias del empleado--}}

                            <div class="col-md-6">
                                <h4 class="form-section">
                                    <i class="icon-note"></i> Referencias
                                </h4>
                                <div class="row">
                                    <div class="col-md-5 offset-md-1 offset-sm-0">
                                        <label for="reference1">Nombre :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   name="reference1"
                                                   id="reference1"
                                                   value="{{ $errors->any() ? old('reference1'):""}}"
                                                   class="form-control @if($errors->has("reference1")) border-danger @endif">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("reference1") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="reference1c">Emergencia</label>
                                        <div class="form-group">
                                            <input type="checkbox"
                                                   name="reference1c"
                                                   id="reference1c"
                                                   class="form-control">
                                            <div class="invalid-feedback text-danger">
                                                {{ $errors->first("reference1c") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 offset-md-1 offset-sm-0">
                                        <label for="reference1t">Telefono :</label>
                                        <div class="form-group">
                                            <input type="text"
                                                   name="reference1t"
                                                   value="{{ $errors->any() ? old('reference1t'):""}}"
                                                   id="reference1t"
                                                   class="form-control @if($errors->has("reference1t")) border-danger @endif">
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("reference1t") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="reference1s">Parentesco :</label>
                                        <div class="form-group">
                                            <select name="reference1s"
                                                    id="reference1s"
                                                    class="form-control @if($errors->has("reference1s")) border-danger @endif" >
                                                <option value="">Seleccione parenteco</option>
                                                @foreach($RelationshipTypes as $pivot)
                                                    <option value="{{ $pivot->getId() }}">{{ $pivot->getName() }}</option>
                                                @endforeach
                                            </select>
                                            <div class="col-md-12 invalid-feedback text-danger">
                                                {{ $errors->first("reference1s") }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>



                            </div>
{{--    Telefonos de contacto                        --}}
                            <div class="col-md-6">
                                <h4 class="form-section">
                                    <i class="icon-phone"></i> Informacion de contacto
                                </h4>
                                <br>
                                <div class="form-group row">
                                    <label for="phone1" class="col-md-2 offset-md-1 offset-sm-0 label-control">Telefono 1</label>
                                    <div class="col-md-4 form-group">
                                        <input  type="text"
                                                class="form-control @if($errors->has("phone1")) border-danger @endif"
                                                name="phone1"
                                                id="phone1">
                                        <div class="col-md-12 invalid-feedback text-danger">
                                            {{ $errors->first("phone1") }}
                                        </div>

                                    </div>
                                    <div class="col-md-1 form-group">
                                        <input  type="checkbox"
                                                class="form-control"
                                                name="phone1c"
                                                id="phone1c">
                                        <div class="col-md-12 invalid-feedback text-danger">
                                            {{ $errors->first("phone1c") }}
                                        </div>
                                    </div>
                                    <label for="phone1c" class="col-md-2">Empersarial</label>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <label for="phone2" class="col-md-2 offset-md-1 offset-sm-0 label-control">Telefono 2 :</label>
                                    <div class="col-md-4">
                                        <input  type="text"
                                                class="form-control @if($errors->has("phone2")) border-danger @endif"
                                                name="phone2"
                                                id="phone2">
                                        <div class="col-md-12 invalid-feedback text-danger">
                                            {{ $errors->first("phone2") }}
                                        </div>
                                    </div>
                                    <div class="col-md-1 form-group">
                                        <input  type="checkbox"
                                                name="phone2c"
                                                class="form-control"
                                                id="phone2c"
                                        >
                                        <div class="col-md-12 invalid-feedback text-danger">
                                            {{ $errors->first("phone2c") }}
                                        </div>
                                    </div>
                                    <label for="phone2c" class="col-md-2">Empersarial :</label>
                                </div>
                                <hr>
                            </div>
                        </div>
                    </div>
                    <div class="form-actions right" style="padding-right: 25px;">
                        <button type="submit"  class="btn btn-success">
                            <i class="icon-save"> </i> Guardar registro
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <div class="modal animated text-left"
         id="modalCargos"
         tabindex="-1"
         role="dialog"
         aria-labelledby="edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        .::. Seleccione puesto
                    </h4>
                </div>
                <div class="modal-body"
                     id="postitionModalTarget"
                     style="max-height: 600px;overflow-y: auto;;margin-bottom: 30px">

                    <table class="table table-bordered dataTable sget"
                           aria-describedby="info"
                           role="grid"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre del cargo</th>
                            <th>Agregar</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($puestos as  $pvt)
                            <tr>
                                <td>{{ $pvt->getCode() }}</td>
                                <td>{{ $pvt->getName() }}</td>
                                <td>
                                    <center>
                                        <button type="button"
                                                onclick="$('#puestoCode').val('{{ $pvt->getCode() }}');$('#puestoName').val('{{ $pvt->getName() }}')"
                                                data-dismiss="modal"
                                                class="btn btn-success btn-sm">
                                            <i class="icon-plus"></i>
                                        </button>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

    <script src="{{ asset('plugins/datepiker/js/datepicker.js') }}"></script>
    <script src="{{ asset('plugins/datepiker/js/datepicker.es-ES.js') }}"></script>
    <script type="text/javascript">
        $('[data-toggle="datepicker"]').datepicker();
    </script>

@endsection
