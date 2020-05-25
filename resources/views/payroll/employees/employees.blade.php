@extends('layout.layout')

@section('title') Empleados @endsection

@section('hrow')
    <div class="col-sm-12 mb-1">
        <div class="content-header-left breadcrumb-new">
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item">Payroll
                        </li>
                        <li class="breadcrumb-item">Empleados
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

@endsection


@section('body')
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Empleados</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        @if(Auth::user()->hasPermission('crear_empleados'))
                            <a href="{{ route('employees.create') }}">
                                <button class="btn btn-green"
                                        type="button">
                                    <i class="icon-plus" style="color: white;"></i>    Agregar
                                </button>
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <table class="table table-bordered sget dataTable"
                               id="laravel_datatable"
                               aria-describedby=""
                               role="grid"
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th style="width: 100px;">Codigo</th>
                                <th>Nombre planilla</th>
                                <th>Cargo</th>
                                <th>Status</th>
                                <th>Fecha de ingreso</th>
                                <th style="width: 100px;">Acciones</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

{{--|============================================================================
    |   Funcionamiento del modal de bajas de empleado
    |============================================================================
 --}}

    <div class="modal animated fadeIn text-left"
         id="dropUserModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="edit"
         style="display: none; padding-right: 15px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="icon-cog2"></i>
                        Baja de empleado
                    </h4>
                </div>
                <div class="modal-body" id="dropUserTarget">

                </div>
            </div>
        </div>
    </div>

    {{--
    Edicion del objeto, modal
    --}}

    <input type="text" hidden name="_token" id="_token" value="{{csrf_token()}}">


@endsection

@section('scripts')

    <link  href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>


    <script src="{{ asset('js/util/datatable.js') }}"></script>
    <script src="{{ asset('js/util/functions.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#laravel_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employees.index') }}",
                columns: [
                    { data: 'code'},
                    { data: 'full_name'},
                    { data: 'cargo'},
                    { data: 'estado'},
                    { data: 'ingreso'},
                    { data: 'acctions'},
                ]
            });
        });
    </script>

@endsection
