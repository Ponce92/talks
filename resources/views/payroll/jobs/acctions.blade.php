<center>
    @if(Auth::user()->hasPermission('gestionar_plazas'))
    <button class="btn btn-sm btn-info"
            {{ $emname ? 'disabled':'' }}
            title="Asignar plaza"
            onclick="showLoadedModal('{{ route('jobs.candidatos',$id) }}',$('#asingacionModal'),$('#asignacionTarget'))">
        <i class="icon-user-check"></i>
    </button>


    @if($subs)
        <a href=" {{ route('jobs.subs',$id) }} ">
            <button class="btn btn-sm btn-primary"
                    title="Gestionar subalternos">
                <i class="icon-share-alt"></i>
            </button>
        </a>
    @endif
{{--    <button class="btn btn-sm btn-danger"--}}
{{--            {{ $emname ? 'disabled':'' }}--}}
{{--            title="Eliminar plaza"--}}
{{--            onclick="showLoadedModal('{{ route('jobs.candidatos',$id) }}',$('#asingacionModal'),$('#asignacionTarget'))">--}}
{{--        <i class="icon-minus"></i>--}}
{{--    </button>--}}
    @endif

</center>

