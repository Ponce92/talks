<form action="#" method="post" data-url="{{ route('departments.store') }}" id="formCreate">
{{--    <input type="text" name="rol_id" value="" id="rol_id">--}}
    <div class="form-body">
        <div class="row">
            <div class="col col-sm-8 col-md-8">
                <label class="label" for="name">Nombre :</label>
                <div class="form-group">
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ $dep->getName() }}"
                           class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">
                    <div class="col-md-12 text-danger">
                        {{ $errors->first('name') }}
                    </div>
                </div>
            </div>
            <div class="col col-md-4">
                <label class="label" for="code">Codigo :</label>
                <div class="form-group">
                    <input type="text"
                           id="code"
                           name="code"
                           value="{{ $dep->getCode() }}"
                           class="form-control {{ $errors->has('code') ? 'border-danger':'' }} ">

                    <div class="col-md-12 text-danger">
                        {{ $errors->first('code') }}
                    </div>
                </div>
            </div>
            <div class="col col-md-12">
                <div class="form-group">
                    <label class="desc" for="desc">Descripcion :</label>
                    <textarea name="desc"
                              class="form-control mb-5 {{ $errors->has('desc') ? 'border-danger':'' }}"
                              id="desc"
                              cols="30"
                              rows="3">{{$dep->getDesc()}}</textarea>

                    <div class="col-md-12 text-dager">
                        {{ $errors->first('desc') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions right">
        <button type="button"
                onclick="loadCardAjax('{{route('departments.create')}}',$('#card_group'))"
                class="btn btn-danger btn-cancel"
                data-dismiss="modal">Cancelar</button>
        <button type="button"
                onclick="loadCardPostAjax($('#formCreate'),$('#card_department'))"
                class="btn btn-green">Agregar</button>
    </div>
</form>

