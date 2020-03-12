@if(Auth::user()->hasPermission('puede_editar_usuarios'))
<a class="btn btn-sm btn-info"  href="{{ route('users.edit',$id) }}">
    <i class="icon-edit"></i>
</a>
@endif
@if(Auth::user()->hasPermission('puede_eliminar_usuarios'))
<button class="btn btn-sm btn-danger" onclick="confirmTrash('{{route('users.destroy',$id)}}',{{$id}})">
    <i class="icon-trash3"></i>
</button>
@endif
