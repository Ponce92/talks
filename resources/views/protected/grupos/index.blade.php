@extends('layout.layout')

@section('title') Grupos @endsection

@section('hrow')
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
                        <li class="breadcrumb-item">User group
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('body')

    <link rel="stylesheet" href="{{asset('plugins/tree/file-explore.css')}}">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Grupos de usuarios</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        @if(Auth::user()->hasPermission('crear_grupos'))
                        <button class="btn btn-green" type="button"
                                onclick="loadCardAjax('{{ route('groups.create') }}',$('#card_group'));
                                    clearCard($('#card_permission'))">
                            <i class="icon-plus" style="color: white;"></i>    Agregar
                        </button>
                        @endif
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
                                <th width="25">Id</th>
                                <th>Nombre de grupo</th>
                                <th>Descripcion</th>
                                <th>Clase</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col col-md-4">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">:: Grupo </h4>
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
                            <div class="card-block" id="card_group">
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
    <script src="{{ asset('plugins/tree/file-explore.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#laravel_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('groups.index') }}",
                columns: [
                    { data: 'id'},
                    { data: 'cs_name'},
                    { data: 'cs_desc',orderable:false},
                    { data: 'cs_group',orderable:false},
                    { data: 'cb_state',
                        render: function (data,type,row){
                            if(data > 0){
                                return "<i class='icon-checkbox-checked success' ><i/>";
                                }
                            return "<i class='icon-checkbox-unchecked danger' ><i/>";
                        }
                    },
                    { data: 'acctions'},
                ]
            });
        });
    </script>

@endsection
