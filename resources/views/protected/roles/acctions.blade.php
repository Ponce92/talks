<button class="btn btn-sm btn-info"
        onclick="loadCardAjax('{{ route('roles.edit',$id) }}',$('#rol_card_trg'));">
    <i class="icon-setting2"></i>
</button>
<button class="btn btn-sm btn-primary"
        onclick="loadCardAjax('{{ route('rolPermisions',$id) }}',$('#rol_card_trg'));">
    <i class="icon-key2"></i>
</button>
