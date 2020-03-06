<a class="btn btn-sm btn-info"  href="{{ route('users.edit',$tt_name) }}">
    <i class="icon-edit"></i>
</a>
<button class="btn btn-sm btn-danger" onclick="confirmTrash('{{route('users.destroy',$tt_name)}}',{{$tt_name}})">
    <i class="icon-trash3"></i>
</button>
