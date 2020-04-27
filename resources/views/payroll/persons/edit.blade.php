<form action="{{route('persons.update',$person->getId())}}"
      method="POST"
      class="form-horizontal"
      id="frmEditPerson">
    {{ csrf_field() }}

    <div class="form-body">
        {{--       Nombres de las personas   --}}
        <div class="row">
            <div class="col-md-6">
                <label for="nombres">Nombres <span class="red">*</span> </label>
                <div class="form-group">
                    <input type="text"
                           id="nombres"
                           class="form-control @if($errors->has("nombres")) border-danger @endif"
                           {{ $edit=="off" ?'readonly':'' }}
                           value="{{$employee->person->getName()}}"
                           name="nombres">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("nombres") }}
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <label for="lastName">Apellidos<span class="red">*</span> </label>
                <div class="form-group">
                    <input type="text"
                           id="lastName"
                           class="form-control @if($errors->has("lastName")) border-danger @endif"
                           {{ $edit=="off" ?'readonly':'' }}
                           value="{{$employee->person->getLastName()}}"
                           name="lastName">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("lastName") }}
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label for="birthDate">Fecha de nacimiento <span class="red">*</span>:</label>
                <div class="form-group">
                    <input type="date"
                           id="birthDate"
                           class="form-control @if($errors->has("birthDate")) border-danger @endif"
                           {{ $edit=="off" ?'readonly':'' }}
                           value="{{$person->getBirthDate()}}"
                            name="birthDate">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("birthDate") }}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <label for="birthDate">Estado civil :<span class="red">*</span> :</label>
                <div class="form-group">
                    <div class="col-md-12 invalid-feedback text-danger">
                        {{ $errors->first("birthDate") }}
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <label for="#">Sexo <span class="red">*</span> :</label>
                <div class="row">
                    <div class="col-md-5 offset-md-1 col-sm-12">
                        <div class="form-check">
                            <input  class="form-check-input"
                                    type="radio"
                                    name="sexo"
                                    id="optr1"
                                    @if(old('sexo')==1) checked @endif
                                    value="0">
                            <label  class="form-check-label" for="optr1">
                                M
                            </label>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="form-check">
                            <input class="form-check-input"
                                   type="radio"
                                   name="sexo"
                                   @if(old('sexo')==1) checked @endif
                                   id="opt2"
                                   value="1">
                            <label class="form-check-label" for="opt2">
                                F
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 invalid-feedback text-danger">
                    {{ $errors->first("sexo") }}
                </div>
            </div>
        </div>
        <div class="row">

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
                        <i class="icon-save"> </i> Guardar
                    </button>
                </div>
            </div>
        </div>
</form>

