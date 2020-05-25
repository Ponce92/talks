
<center>
    @if(Auth::user()->hasPermission('editar_puestos'))
    <button class="btn btn-sm btn-info"
            onclick="loadCardAjax('{{ route('positions.edit',$id) }}',$('#card_position'))">
        <i class="icon-edit"></i>
    </button>
    @endif
</center>


