<button class="btn btn-sm btn-info"
        title="Editar usuario"
        onclick="loadCardAjax('{{ route('users.edit',$id) }}',$('#card_user'));
            ">
    <i class="icon-edit"></i>
</button>
<button class="btn btn-sm btn-primary"
        title="Editar permisos"
        onclick="loadCardAjax('{{ route('user.permisions',$id) }}',$('#card_user'));">
    <i class="icon-key"></i>
</button>

<button class="btn btn-sm btn-green"
        onclick="loadCardAjax('{{ route('user.groups',$id) }}',$('#card_user'))">
    <i class="icon-group"></i>
</button>
