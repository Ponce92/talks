@if(Auth::user()->hasPermission('puede_editar_cargos'))
    <button class="btn btn-sm btn-info"
            title="Ver puesto de trabajo"
            onclick="showObject('{{ route('jobs.edit',$id) }}')">
        <i class="icon-eye"></i>
    </button>
@endif

