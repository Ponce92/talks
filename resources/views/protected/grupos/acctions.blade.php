<button class="btn btn-sm btn-info"
        onclick="loadCardAjax('{{ route('groups.edit',$id) }}',$('#card_group'));">
    <i class="icon-edit"></i>
</button>
<button class="btn btn-sm btn-primary"
        onclick="loadCardAjax('{{ route('group.permisions',$id) }}',$('#card_group'))
            ">
    <i class="icon-key"></i>
</button>
