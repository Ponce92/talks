<div class="col-md-12">
    <p><strong> <span class="primary">Areaname</span> :: Puestos asignados</strong> </p>
    <ul class="list-group">
        <li class="list-group-item ">
            <span class="tag tag-pill tag-success float-xs-right btn"
                  data-toggle="modal"
                  data-target="#modalAddPosition"
                  onclick="loadCardAjax('{{route('areaope.alter',$area)}}',$('#trgp'));">
                <i class="icon-plus"></i>
            </span>
            <strong>Agregar puesto</strong>
        </li>
        @foreach($list as $pvt)

            <li class="list-group-item ">
            <span class="tag tag-pill tag-danger float-xs-right btn"
                  onclick="loadCardAjax('{{route('areaope.trash',[$area,$pvt->getId()])}}',$('#card_trg'));"
                  data-target="">
                <i class="icon-trash2"></i>
            </span>
                <strong>{{$pvt->getName()}}</strong>
            </li>
        @endforeach
    </ul>
</div>

