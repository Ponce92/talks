@if(Auth::user()->hasPermission('puede_editar_permisos'))
<button class="btn btn-sm btn-info"  onclick="showObject('{{ route('permissions.edit',$id) }}')">
    <i class="icon-edit"></i>
</button>
@endif
@if(Auth::user()->hasPermission('puede_eliminar_permisos'))
<button class="btn btn-sm btn-danger" onclick="confirmTrash('{{route('permissions.destroy',$id)}}',{{ $id }})">
    <i class="icon-trash3"></i>
</button>
@endif
