<button class="btn btn-sm btn-info"
        title="Editar area operativa"
        onclick="loadCardAjax('{{route('areaope.edit',$id) }}',$('#card_trg'))">
    <i class="icon-edit"></i>
</button>

<button class="btn btn-sm btn-primary"
        title="Plazas asignadas"
        onclick="loadCardAjax('{{route('areaope.position',$id) }}',$('#card_trg'))">
    <i class="icon-list "></i>
</button>
