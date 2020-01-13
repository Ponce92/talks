<button class="btn btn-sm btn-info"  onclick="showObject('{{ route('permissions.edit',$pk_id) }}')">
    <i class="icon-edit"></i>
</button>
<button class="btn btn-sm btn-danger" onclick="confirmTrash('{{route('permissions.destroy',$pk_id)}}',{{$pk_id}})">
    <i class="icon-trash3"></i>
</button>
