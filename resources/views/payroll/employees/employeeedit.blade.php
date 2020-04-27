<form action="{{ route('employees.update',$employee->getId()) }}"
      method="#"
      class="form-horizontal"
      id="frmEditEmployee">
    {{ csrf_field() }}
    <input type="text" hidden value="{{ $employee->getId() }}">
    <div class="form-body">
        {{--        Codigo de l trabajador y fecha ingreso, fecha fin                   --}}
        <div class="row">
            <div class="col-md-4">
                <label for="employeeCode">Codigo trabajador <span class="red">*</span> </label>
                <div class="form-group">
                    <input type="text"
                           id="employeeCode"
                           class="form-control @if($errors->has("employeeCode")) border-danger @endif"
                           readonly
                           value="{{$employee->getCode() }}"
                           name="employeeCode">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("employeeCode") }}
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <label for="employeeStatus">Estado <span class="red">*</span>:</label>
                <div class="form-group">
                    <select name="employeeStatus"
                            id="employeeStatus"
                            {{ $edit=='off' ? 'disabled':''}}
                            class="form-control  @if($errors->has("employeeStatus")) border-danger @endif">
                        <option value="" disabled>Seleccione estado</option>
                        @foreach($employeeStatus as $pivot)
                            <option value="{{$pivot->getId()}}"
                                @if($errors->any())
                                    {{ old('employeeStatus')== $pivot->getId() ? 'selected':'' }}
                                @else
                                    {{ $employee->employeeStatus->getId()== $pivot->getId() ? 'selected':'' }}
                                @endif>
                                {{ $pivot->getName() }}
                            </option>
                        @endforeach
                    </select>
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("employeeStatus") }}
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="employeeDepartment">Departamento</label>
                    <select name="employeeDepartment"
                            class="form-control"
                            {{$edit=="off" ? 'disabled':''}}
                            id="employeeDepartment">
                        <option value="" disabled>Seleccione departamento</option>
                        @foreach($departments as $pivot)
                            <option value="{{$pivot->getId()}}"
                            @if($errors->any())
                                {{ old('employeeDepartment')== $pivot->getId() ? 'selected':'' }}
                            @else
                                {{ $employee->department->getId()== $pivot->getId() ? 'selected':'' }}
                            @endif>

                                {{$pivot->getName()}}</option>
                        @endforeach
                    </select>
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("employeeStatus") }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="employeePosition">Cargo</label>
                    <select name="employeePosition"
                            class="form-control"
                            {{$edit=="off" ? 'disabled':''}}
                            id="employeePosition">
                        <option value="" disabled>Seleccione cargo</option>
                        @foreach($positions as $pivot)
                            <option value="{{$pivot->getId()}}"
                                @if($errors->any())
                                {{ old('employeePosition')== $pivot->getId() ? 'selected':'' }}
                                @else
                                {{ $employee->position->getId()== $pivot->getId() ? 'selected':'' }}
                                @endif
                                >
                                {{$pivot->getName()}}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="col-md-4">
                <label for="contractsTypes">Tipo contrato <span class="red">*</span> :</label>
                <div class="form-group">
                    <select name="contractsTypes"
                            id="contractsTypes"
                            {{ $edit=='off' ? 'disabled':''}}
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
            <div class="col-md-12">
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
        </div>

        <div class="row">
            <div class="col-md-4">
                <label for="entryDate">Fecha ingreso <span class="red">*</span> :</label>
                <div class="form-group">
                    <input type="date"
                           class="form-control @if($errors->has("entryDate")) border-danger @endif"
                           id="entryDate"
                           {{ $edit=='off' ? 'readonly':''}}
                           value="{{$employee->getEntryDate() }}"
                           placeholder=""
                           name="entryDate">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("entryDate") }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <label for="endDate">Fecha baja :</label>
                <div class="form-group">
                    <input type="date"
                           {{ $edit=='off' ? 'readonly':''}}
                           id="endDate"
                           value="{{ $employee->getEndDate()}}"
                           class="form-control @if($errors->has("endDate")) border-danger @endif"
                           placeholder=""
                           name="endDate">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("endDate") }}
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <label for="employee_park">Parqueo :</label>
                <div class="form-group">
                    <select name="parkingTypes"
                            id="parkingTypes"
                            {{ $edit=='off' ? 'disabled':''}}
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
            <div class="col-md-8">
                <label for="mail">Correo intitucional :</label>
                <div class="form-group">
                    <input type="text"
                           id="mail"
                           {{ $edit=='off' ? 'readonly':''}}
                           value="{{ $employee->getEmail() }}"
                           class="form-control @if($errors->has("mail")) border-danger @endif"
                           placeholder="usuario@talkamericas.com"
                           name="mail">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("mail") }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="userVicidial">Usuario vicidial :</label>
                    <input type="text"
                           {{ $edit=='off' ? 'readonly':''}}
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
                           {{ $edit=='off' ? 'readonly':''}}
                           value="{{$employee->getHeadsetCode()}}"
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
                           {{ $edit=='off' ? 'readonly':''}}
                           value="{{ $employee->getLoker()}}"
                           placeholder="AB34"
                           class="form-control @if($errors->has("loker")) border-danger @endif">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("loker") }}
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <label for="biometric">Accesso biometrico :</label>
                <div class="form-group">
                    <input type="text"
                           id="biometric"
                           {{ $edit=='off' ? 'readonly':''}}
                           name="biometric"
                           value="{{$employee->getBiometric()}}"
                           placeholder="code"
                           class="form-control @if($errors->has("biometric")) border-danger @endif">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("biometric") }}
                    </div>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
    <div class="form-actions">
        <div class="row">
            <div class="col col-md-3 col-sm-4 offset-md-9">
                <button class="btn btn-info"
                        type="button"
                        form="frmEditEmployee"
                        onclick="updateFromCard(this.form,'#employeeTrg','#sw1')"
                        {{ $edit=='on' ? '':'disabled' }}
                        style="margin-right: 10px !important;">
                    <i class="icon-plus"></i> Guardar
                </button>
            </div>
        </div>
    </div>
</form>

