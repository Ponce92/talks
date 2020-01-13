<button class="btn btn-sm btn-info"  onclick="showObject('{{ route('roles.edit',$rol_id) }}')">
    <i class="icon-edit"></i>
</button>
<button class="btn btn-sm btn-danger" onclick="confirmTrash('{{route('roles.destroy',$rol_id)}}',{{$rol_id}})">
    <i class="icon-trash3"></i>
</button>
