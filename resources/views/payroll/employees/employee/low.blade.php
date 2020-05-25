<form method="post"
      class="form"
      name="formDropUser"
      id="formDropUser"
      onclick=""
      data-url="{{ route('employe.baja.store',$employee->getId()) }}"
      action="#">
    @csrf

    <div class="row">
        <div class="col-md-12">
            <label for="type">Razon de retiro :</label>
            <div class="input-group">
                <select name="type" class="form-control {{$errors->has('type')? 'border-danger':''}}" id="type">
                    <option value="" >Seleccione razon de baja</option>
                    @foreach($types as $pivot )
                        <option  {{ $pivot->getId()==$low->getType()->getId() ? 'selected':'' }}
                            value="{{$pivot->getId()}}">{{$pivot->getName()}}</option>
                    @endforeach
                </select>
                <div class="text-danger">
                    {{ $errors->first('type') }}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <label for="desc">Observacion :</label>
            <div class="input-group">
                <textarea name="obs"
                          id="obs"
                          class="form-control {{$errors->has('obs')? 'border-danger':''}}" rows="3">{{ $low->getObservacion()}}</textarea>
            </div>
            <div class="text-danger">
                {{ $errors->first('obs') }}
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class="input-group">
                <label for="recCXC">
                    <input name="rec"
                           {{ $low->isRehireable() ? 'checked':'--'}}
                           id="recCXC"
                           type="checkbox"> Irecontratable
                </label>
            </div>
        </div>
    </div>
    <br>
    <div class="modal-footer">
        <button type="button"
                class="btn btn-grey"
                data-dismiss="modal"><i class="icon-close"></i>  Cancelar</button>
        <button type="button"
                onclick="loadRequestPost($('#formDropUser'),$('#dropUserModal'),$('#dropUserTarget'))"
                class="btn btn-danger"> <i class="icon-trash2"> </i>  Dar de baja</button>
    </div>
</form>
