<center>
    @if(Auth::user()->hasPermission('editar_departamentos'))
    <button class="btn btn-sm btn-info"
            onclick="loadCardAjax('{{ route('departments.edit',$id) }}',$('#card_department'))">
        <i class="icon-edit"></i>
    </button>
    @endif

    @if(Auth::user()->hasPermission('gestionar_areas'))
    <a class="btn btn-sm btn-primary"  href="{{ route('departments.show',$id) }}">
        <i class="icon-wrench1"></i>
    </a>
    @endif
</center>
