<center>
@if(Auth::user()->hasPermission('editar_roles'))

<button class="btn btn-sm btn-info"
        onclick="loadCardAjax('{{ route('roles.edit',$id) }}',$('#rol_card_trg'));">
    <i class="icon-setting2"></i>
</button>
@endif
@if(Auth::user()->hasPermission('asignar_permisos_roles'))
<button class="btn btn-sm btn-primary"
        onclick="loadCardAjax('{{ route('rolPermisions',$id) }}',$('#rol_card_trg'));">
    <i class="icon-key2"></i>
</button>
@endif
</center>
