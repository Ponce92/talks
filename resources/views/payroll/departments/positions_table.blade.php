@if(count($positions) > 0)
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre del cargo</th>
            <th width="30" align="middle">Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($positions as $obj)
            <tr>
                <td>
                    {{$obj->getName()}}
                </td>
                <td>
                    <button class="btn btn-sm btn-green"
                            onclick="addPositionDep({{ $obj->getId() }},'#btn-pos','{{ route('addPositions') }}');"
                            data-dismiss="modal"
                            title="Agregar el cargo al departamento">
                        <i class="icon-plus"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <div class="row align-middle">
        <strong style="margin-left: 25px;">
            No se ha encontrado cargos que puedan ser agregados
        </strong>
    </div>
@endif
