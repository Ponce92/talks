@if(count($list)>0)

<table class="table table-bordered  sget">
    <thead>
        <tr>
            <th>Puesto</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($list as $pvt)
            <tr>
                <td>{{$pvt->getName()}}</td>
                <td style="width: 30px;" align="middle">
                    <button class="btn btn-success btn-sm"
                            data-dismiss="modal"
                            onclick="loadCardAjax('{{ route('areaope.addposition',['area'=>$area->getId(),'position'=>$pvt->getId(),])}}',$('#card_trg'))">
                        <i class="icon-plus"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@else
    <center>
        <strong>No hay cargos que puedan ser agregados</strong>
    </center>
@endif
