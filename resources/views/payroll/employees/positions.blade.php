@if(count($list))
    <ul class="list-group">
        @foreach($list as $pvt)
            <li class="list-group-item">
                <span class="tag tag-pill tag-success float-xs-right btn"positionId
                      data-dismiss="modal"
                      onclick="$('#noneInput').val('{{ $pvt->getName() }}'),$('#positionId').val('{{ $pvt->getId() }}')">
                    <i class="icon-plus"></i>
                </span>
                    <strong>{{$pvt->getName()}}</strong>
            </li>
        @endforeach
    </ul>

@else
    <center><strong>No se an encontrado puestos...</strong></center>
@endif
