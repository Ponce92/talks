
@if(Auth::user()->hasPermission('puede_editar_departamentos'))
<a class="btn btn-sm btn-info"  href="{{ route('departments.edit',$id) }}">
    <i class="icon-cog2"></i>
</a>
@endif

{{--@if(Auth::user()->hasPermission('puede_eliminar_departamentos'))--}}
{{--<button class="btn btn-sm btn-danger" onclick="confirmTrash('{{route('departments.destroy',$id)}}',{{$id}})">--}}
{{--    <i class="icon-trash3"></i>--}}
{{--</button>--}}
{{--@endif--}}

