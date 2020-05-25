<center>
    @if(Auth::user()->hasPermission('gestionar_empleados'))
        <a href="{{ route('employees.edit',$id) }}" title="Editar datos del empleado">
            <button type="button" class="btn btn-info btn-sm">
                <i class="icon-cogs"></i>
            </button>
        </a>
        <button class="btn btn-sm btn-danger"
                {{ $estado =="Baja" ? 'disabled':''}}
                title="Dar de baja a este empleado"
                onclick="showLoadedModal('{{ route('employe.baja.show',$id) }}',$('#dropUserModal'),$('#dropUserTarget'))">
            <i class="icon-user-minus"></i>
        </button>
    @endif
</center>
