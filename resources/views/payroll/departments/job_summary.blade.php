<table class="table table-bordered">
    <thead>
    <tr>
        <th>Puestos de trabajo</th>
        <th width="30" align="middle">
            <i class="icon-plus i-btn">
            </i>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach($jobs->positions as $obj)
        <tr>
            <td>

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

