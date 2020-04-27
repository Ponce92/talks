@extends('layout.layout')

@section('title') Usuarios @endsection

@section('hrow')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{asset('plugins/tree/file-explore.css')}}">
    <div class="col-sm-12 mb-1">
        <div class="content-header-left breadcrumb-new">
            <div class="row breadcrumbs-top d-inline-block">
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/">Home</a>
                        </li>
                        <li class="breadcrumb-item">Protegido</li>
                        <li class="breadcrumb-item">Usuarios
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
                    <h4 class="card-title" id="basic-layout-form">:: Usuarios</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">

                        <button class="btn btn-green"
                                type="button"
                                onclick="loadCardAjax('{{ route('users.create') }}',$('#card_usuario'))">
                            <i class="icon-plus" style="color: white;"></i>    Agregar
                        </button>

                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <table class="table table-bordered sget"
                               id="laravel_datatable"
                               role="grid"
                               style="width: 100%">
                            <thead>
                            <tr>
                                <th>Usuario</th>
                                <th>Creado</th>
                                <th>Creado</th>
                                <th>Rol</th>
                                <th>Estado</th>
                                <th>Acciones</th>

                            </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-ms-12 col-md-4">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">:: Usuarios </h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a data-action="collapse" id="">
                                            <i class="icon-minus4"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block" id="card_usuario">
                                <strong>
                                    <h4>" Seleccione elemento a editar "</h4>
                                </strong>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">:: Permisos</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block" id="card_pemissions">

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
                        Crear Usuario
                    </h4>
                </div>
                <div class="modal-body" id="targetCreate">

                </div>
                <div class="modal-footer">
                    <button type="button"
                            onclick=""
                            class="btn grey btn-outline-secondary btn-cancel"
                            data-dismiss="modal">Cancelar</button>
                    <button type="button"
                            onclick="store('#modalCreate','#formCreate')"
                            class="btn btn-outline-primary">Agregar</button>
                </div>
            </div>
        </div>
    </div>
{{--
    Edicion del objeto, modal
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
                        Edicion de rol
                    </h4>
                </div>
                <div class="modal-body" id="targetEdit">

                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-dismiss="modal"><i class="icon-close"></i>  Cancelar</button>
                    <button type="button"
                            onclick="editObject('#modalCreate','#formCreate')"
                            class="btn btn-outline-info"> <i class="icon-save"> </i>  Actualizar</button>
                </div>
            </div>
        </div>
    </div>

    {{--
    Edicion del objeto, modal
    --}}
    <div class="modal animated text-left"
         id="modalTrash"
         tabindex="-1"
         role="dialog"
         aria-labelledby="edit">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="icon icon-trash3" style="color: #aa0000;"></i>
                        Eliminar rol
                    </h4>
                </div>
                <div class="modal-body" id="targetDelete">
                    <div class="col col-8">
                        <p> Se eliminara el recurso del sistema, una vez eliminado no prodra recuperarse</p>
                    </div>
                    <input hidden type="text" disabled name="delete_input" id="delete_input" data-id="" value="" >
                    <div class="col col-12">
                        <strong>¿ Esta seguro de la accionz ?</strong>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button"
                            class="btn btn-outline-secondary"
                            data-dismiss="modal"><i class="icon-times"></i> Cancelar </button>
                    <button type="button"
                            onclick="deleteObject()"
                            class="btn btn-outline-danger"> <i class="icon-trash3"></i>  Eliminar</button>
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
                ajax: "{{ route('users.index') }}",

                columns: [
                    { data: 'cs_name'},
                    { data: 'created_at'},
                    { data: 'updated_at'},
                    {data:'rolname'},
                    { data:'cb_state',
                        render: function (data,type,row){
                                if(data){
                                    return "<i class='icon-checkbox-checked success' ><i/>"
                                }
                                return "<i class='icon-checkbox-unchecked danger' ><i/>";
                        }},
                    { data: 'acctions'},
                ]
            });
        });
    </script>

@endsection
