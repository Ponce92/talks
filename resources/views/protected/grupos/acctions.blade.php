
<center>
    @if(Auth::user()->hasPermission('editar_grupos'))
        <button class="btn btn-sm btn-info"
                onclick="loadCardAjax('{{ route('groups.edit',$id) }}',$('#card_group'));">
            <i class="icon-edit"></i>
        </button>
    @endif
    @if(Auth::user()->hasPermission('asignar_permisos_grupos'))
        <button class="btn btn-sm btn-primary"
                onclick="loadCardAjax('{{ route('group.permisions',$id) }}',$('#card_group'))
                    ">
            <i class="icon-key"></i>
        </button>
    @endif
</center>
