@extends('layout.layout')

@section('title') Roles @endsection

@section('body')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Roles</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    <button class="btn btn-success">Agregar</button>
{{--                    <ul class="list-inline mb-0">--}}
{{--                        <li><a data-action="collapse"><i class="icon-minus4"></i></a></li>--}}
{{--                        <li><a data-action="reload"><i class="icon-reload"></i></a></li>--}}
{{--                        <li><a data-action="expand"><i class="icon-expand2"></i></a></li>--}}
{{--                        <li><a data-action="close"><i class="icon-cross2"></i></a></li>--}}
{{--                    </ul>--}}
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block">
                    <table class="table table-striped table-bordered compact dataTable"
                           id="laravel_datatable"
                           role="grid"
                           style="width: 100%">
                        <thead>
                            <tr>
                                <th width="30">Id</th>
                                <th>Nombre de Rol</th>
                                <th>Descripcion</th>
                                <th>Estado</th>
                                <th style="width: 150px;">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>

            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <link  href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready( function () {
            $('#laravel_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.get.list') }}",
                columns: [
                    { data: 'rol_id'},
                    { data: 'tt_name'},
                    { data: 'tb_state',orderable:false},
                    { data: 'tt_desc',orderable:false},
                    {render:function (data,type,row) {
                            return '<a href="#" onclick="alert('+Object.values(row.rol_id)+')" class="btn btn-float btn-square btn-float-lg btn-primary" style="margin-right:10px;"> <i class="icon-edit"></i></a>'+
                                '<a href="#" class="btn btn-float btn-square btn-float-lg btn-danger"><i class="icon-trash2"></i></a>'
                                ;
                        }}
                ]
            });
        });
    </script>
@endsection
