@extends('layout.layout')

@section('title') Roles @endsection
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
                        <li class="breadcrumb-item">Protected
                        </li>
                        <li class="breadcrumb-item">Roles
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('body')
    <div class="row ">
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Roles</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        @if(Auth::user()->hasPermission('puede_crear_roles'))
                        <button class="btn btn-green" type="button"
                                onclick="loadCardAjax('{{route('roles.create')}}',$('#rol_card_trg'));">
                            <i class="icon-plus" style="color: white;"></i>    Agregar
                        </button>
                        @endif
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <table class="table table-bordered  sget"
                               id="laravel_datatable"
                               role="grid"
                               style="width: 100%">
                            <thead>
                                <tr>
                                    <th width="30">Id</th>
                                    <th>Nombre de Rol</th>
                                    <th>Descripcion</th>
                                    <th width="25">Estado</th>
                                    <th style="width: 150px;">Acciones</th>
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
                            <h4 class="card-title">:: Rol</h4>
                            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li>
                                        <a data-action="collapse" id="btn_card_rol" onclick="">
                                            <i class="icon-minus4"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body collapse in">
                            <div class="card-block" id="rol_card_trg">
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


    <input type="text" hidden name="token" id="token" value="{{csrf_token()}}">


@endsection

@section('scripts')

    <link  href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>


    <script src="{{ asset('js/protegido/roles/roles.js') }}"></script>
    <script src="{{ asset('js/util/functions.js') }}"></script>
    <script src="{{ asset('plugins/tree/file-explore.js') }}"></script>

    <script>
        $(document).ready( function () {
            $('#laravel_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.get.list') }}",
                columns: [
                    { data: 'id'},
                    { data: 'cs_name'},
                    { data: 'cs_desc',orderable:false},
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
