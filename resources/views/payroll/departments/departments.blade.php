@extends('layout.layout')

@section('title') Departamentos @endsection

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
                        <li class="breadcrumb-item">Department
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('body')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Departamentos</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        @if(Auth::user()->hasPermission('crear_departamentos'))
                            <button class="btn btn-green"
                                    type="button"
                                    onclick="loadCardAjax('{{route('departments.create')}}',$('#card_department'))">
                                <i class="icon-plus" style="color: white;"></i>    Agregar
                            </button>
                        @endif
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <table class="table table-bordered sget dataTable"
                               id="laravel_datatable"
                               aria-describedby="DataTables_Table_0_info"
                               role="grid"
                               style="width: 100%">
                            <thead>
                            <tr class="odd">
                                <th>Codigo</th>
                                <th>Nombre</th>
                                <th>Comentario</th>
                                <th style="width: 150px;">Acciones</th>
                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">:: Departamento</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block" id="card_department">
                        <div class="row">
                            <div class="col-md12">
                                <div class="row right"><br>

                                    <center>
                                        <i class="icon-folder-open2" style="color: #23395B ;font-size: 5rem;"></i>
                                    </center>

                                </div>
                            </div>
                            <div class="col-md12">
                                <div class="row">
                                    <center>
                                        <strong style="font-size: 1.3rem;color: #22333B">Seleccione una opcion</strong>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>


    <div class="modal animated fadeIn text-left"
         id="modalCreate"
         tabindex="-1"
         role="dialog"
         aria-labelledby="create"
         style="display: none; padding-right: 15px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="icon-cog2"></i>
                        Crear departamento
                    </h4>
                </div>
                <div class="modal-body" id="targetCreate">
                    {{--   ++++++++++++++++++++++    --}}
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-secondary btn-cancel"
                            data-dismiss="modal">Cancelar</button>
                    <button type="button"
                            onclick="store('#modalCreate','#formCreate')"
                            class="btn btn-outline-info">Agregar</button>
                </div>
            </div>
        </div>
    </div>
{{--
    Edicion del objeto, modal . . .
    --}}
    <div class="modal animated fadeIn text-left"
         id="modalEdit"
         tabindex="-1"
         role="dialog"
         aria-labelledby="edit"
         style="display: none; padding-right: 15px;">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="icon-cog2"></i>
                        Edicion de departamento
                    </h4>
                </div>
                <div class="modal-body" id="targetEdit">

                </div>

            </div>
        </div>
    </div>


    <input type="text" hidden name="token" id="token" value="{{csrf_token()}}">


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
                ajax: "{{ route('departments.index') }}",
                columns: [
                    { data: 'cs_code',orderable:false},
                    { data: 'cs_name'},
                    { data: 'cs_desc'},
                    { data: 'acctions'},
                ]
            });
        });
    </script>

@endsection
