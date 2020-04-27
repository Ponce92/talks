<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nombre del cargo</th>
            <th width="30" align="middle">
                <i class="icon-plus i-btn"
                   onclick="showGetModal('{{ route('getPositions',$department->getId()) }}','#trgp','#modalAddPosition')">
                </i>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach($department->positions as $obj)
            <tr>
                <td>
                    {{$obj->getName()}}
                </td>
                <td  width="30">
                    <button class="btn btn-sm btn-red"
                            onclick=""
                            data-dismiss="modal"
                            title="Agregar el cargo al departamento">
                        <i class="icon-trash2"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

