
@if(Auth::user()->hasPermission('puede_editar_roles'))
<button class="btn btn-sm btn-info"  onclick="showObject('{{ route('roles.edit',$rol_id) }}')">
    <i class="icon-edit"></i>
</button>
@endif
@if(Auth::user()->hasPermission('puede_eliminar_roles'))
<button class="btn btn-sm btn-danger" onclick="confirmTrash('{{route('roles.destroy',$rol_id)}}',{{$rol_id}})">
    <i class="icon-trash3"></i>
</button>
@endif

@if(Auth::user()->hasPermission('puede_asignar_permisos'))
<a href="{{ route('rolPermisions',$rol_id) }}" class="btn btn-sm btn-info" title="{{  Auth::user()->getName()}}" >
    <i class="icon-cog2"></i>
</a>
@endif
