
@if(Auth::user()->hasPermission('puede_editar_grupos'))
<button class="btn btn-sm btn-info"  onclick="showObject('{{ route('groups.edit',$id) }}')">
    <i class="icon-edit"></i>
</button>
@endif

@if(Auth::user()->hasPermission('puede_eliminar_grupos'))
<button class="btn btn-sm btn-danger" onclick="confirmTrash('{{route('groups.destroy',$id)}}',{{$id}})">
    <i class="icon-trash3"></i>
</button>
@endif

@if(Auth::user()->hasPermission('puede_asignar_permisos_grupos'))
<a href="{{ route('dashboard') }}" class="btn btn-sm btn-info" title="Administrar grupo de usuarios" >
    <i class="icon-cog2"></i>
</a>
@endif
