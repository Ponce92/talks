
@if(Auth::user()->hasPermission('puede_editar_cargos'))
<button class="btn btn-sm btn-info"  onclick="showObject('{{ route('positions.edit',$id) }}')">
    <i class="icon-edit"></i>
</button>
@endif

@if(Auth::user()->hasPermission('puede_eliminar_cargos'))
<button class="btn btn-sm btn-danger" onclick="confirmTrash('{{route('positions.destroy',$id)}}',{{$id}})">
    <i class="icon-trash3"></i>
</button>
@endif

@if(Auth::user()->hasPermission('puede_asignar_cargos_cargos'))
<a href="{{ route('dashboard') }}" class="btn btn-sm btn-info" title="Administrar grupo de usuarios" >
    <i class="icon-cog2"></i>
</a>
@endif
