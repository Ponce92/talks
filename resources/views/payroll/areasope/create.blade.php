

<form action="#" method="post" data-url="{{ route('areaope.store',$department->getId()) }}" id="formCreate">
    <div class="form-body">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <label class="label" for="name">Nombre <span class="red">*</span>:</label>
                <div class="form-group mb-1">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $areaope->getName() }}"
                           class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">

                    <div class="text-danger">
                        {{ $errors->first('name') }}
                    </div>

                </div>
            </div>
            <div class="col col-sm-4 col-md-4">
                <label class="label" for="name">Codigo :<span class="red">*</span>:</label>
                <div class="form-group mb-1">
                    <input type="text"
                           id="code"
                           name="code"
                           value="{{ $areaope->getCode() }}"
                           class="form-control {{ $errors->has('code') ? 'border-danger':'' }} ">

                    <div class="text-danger">
                        {{ $errors->first('code') }}
                    </div>

                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label class="desc" for="desc">Descripcion <span class="red">*</span>:</label>
                    <textarea name="desc"
                              class="form-control {{ $errors->has('desc') ? 'border-danger':'' }}"
                              id="desc"
                              cols="30"
                              rows="3">{{ $areaope->getDesc()}}</textarea>
                    <div class="text-danger">
                        {{ $errors->first('desc') }}
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group mb-0">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input"
                               type="checkbox"
                               id="estado"
                               name="estado"
                               @if($areaope->isActivo())
                               checked
                               @endif
                               value="true">
                        <label class="form-check-label" for="estado">Activo</label>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="form-actions center" style="padding: 10px;">
        <button type="button"
                onclick="loadCardAjax('{{route('areaope.create',$department)}}',$('#card_trg'))"
                class="btn btn-outline-danger btn-cancel"
                data-dismiss="modal">Cancelar</button>
        <button type="button"
                form="formCreate"
                onclick="loadCardPostAjax($('#formCreate'),$('#card_trg'))"
                class="btn btn-outline-green">Agregar</button>
    </div>


</form>

