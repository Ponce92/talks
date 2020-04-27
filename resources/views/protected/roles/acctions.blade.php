<button class="btn btn-sm btn-info"
        onclick="loadCardAjax('{{ route('roles.edit',$id) }}',$('#rol_card_trg'));
                loadCardAjax('{{ route('rolPermisions',$id) }}',$('#card_pemissions'));">
    <i class="icon-setting2"></i>
</button>
