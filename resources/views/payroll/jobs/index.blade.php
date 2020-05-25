@extends('layout.layout')

@section('title') Plazas @endsection

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
                        <li class="breadcrumb-item">Plazas laborales
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Plazas laborales</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div class="row" style="padding-bottom: 15px;">
                            <div class="col-md-6 col-sm-0"></div>
                            <div class="col-md-6 col-sm-12">
                                <div class="row">
                                    <div class="col-md-5 offset-md-3">
                                        <select name="positionS"
                                                onchange="updateDtbl()"
                                                id="positionS"
                                                class="form-control input-sm">
                                            <option value="0" selected> Todos los puesto</option>
                                            @foreach($puestos as $pivot)
                                                <option value="{{$pivot->getId()}}">{{ $pivot->getName() }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="#">Solo vacantes: </label>
                                        <input type="checkbox" onchange="updateDtbl()" name="status" id="status"  class="js-switch" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col col-12">
                                <table class="table table-bordered dataTable sget"
                                       id="laravel_datatable"
                                       aria-describedby="info"
                                       role="grid"
                                       style="width: 100%">
                                    <thead>
                                    <tr>
                                        <th>Codigo</th>
                                        <th>Nombre del puesto</th>
                                        <th>Empleado asignado</th>
                                        <th>Estatus de plaza</th>
                                        <th style="width: 150px;">Acciones</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        @if(Auth::user()->hasPermission('crear_plazas'))
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">:: Plazas</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block" id="">
                        <div class="row">
                            <div class="col-md-12 mb-2">
                                <fieldset>
                                    <div class="input-group bootstrap-touchspin">
                                        <input type="text"
                                               name=""
                                               id="noneInput"
                                               style="background: white;"
                                               readonly
                                               class="touchspin form-control"
{{--                                               onclick="$('#btnAddPosition').click()"--}}
                                               placeholder="Seleccione cargo."
                                               min="1"
                                               max="10">
                                        <span class="input-group-btn input-group-append bootstrap-touchspin-injected">
                            <button class="btn btn-success bootstrap-touchspin-up"
                                    id="btnAddPosition"
                                    onclick=""
                                    data-toggle="modal"
                                    data-target="#modalCargos"
                                    type="button">
                                <i class="icon-list"></i>
                            </button>
                        </span>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12" id="mainCard" >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>


    {{--
           |Formulario de agregacion de
    --}}
    <div class="modal animated text-left"
         id="modalCargos"
         tabindex="-1"
         role="dialog"
         aria-labelledby="edit">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        .::. Seleccione puesto
                    </h4>
                </div>
                <div class="modal-body"
                     id="postitionModalTarget"
                     style="max-height: 600px;overflow-y: auto;;margin-bottom: 30px">

                    <table class="table table-bordered dataTable sget"
                           aria-describedby="info"
                           role="grid"
                           style="width: 100%">
                        <thead>
                        <tr>
                            <th>Codigo</th>
                            <th>Nombre del cargo</th>
                            <th>Agregar</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($puestos as  $pvt)
                                <tr>
                                    <td>{{ $pvt->getCode() }}</td>
                                    <td>{{ $pvt->getName() }}</td>
                                    <td>
                                        <center>
                                            <button type="button"
                                                    onclick="loadCardAjax('{{route('jobs.get.crear',['position'=>$pvt->getId()])}}',$('#mainCard'));$('#noneInput').val('{{ $pvt->getName() }}')"
                                                    data-dismiss="modal"
                                                    class="btn btn-success btn-sm">
                                                <i class="icon-plus"></i>
                                            </button>
                                        </center>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{--|
        |Modal de asingacion de personal a puestos de trabajo
   --}}
    <div class="modal animated text-left"
         id="asingacionModal"
         tabindex="-1"
         role="dialog"
         aria-labelledby="edit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        .::. Ajustes de puesto
                    </h4>
                </div>
                <div class="modal-body" id="asignacionTarget">
                </div>
            </div>
        </div>
    </div>
    <input type="text" hidden name="token" id="token" value="{{csrf_token()}}">
@endsection

@section('scripts')

    <link  href="{{ asset('plugins/switch/switchery.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/switch/switchery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/payroll/jobs.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/util/crud.js') }}" type="text/javascript"></script>

    <link  href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ asset('js/util/datatable.js') }}"></script>
    <script src="{{ asset('js/util/functions.js') }}"></script>
    <script>
        var elem = document.querySelector('.js-switch');
        var init =new Switchery(elem,{
            size:'small'
        });

        $(document).ready( function () {
            $('#laravel_datatable').DataTable({
                processing: true,
                responsive:true,
                serverSide: true,
                dom: 'rt<"bottom row"<"col col-md-6"l><"col col-md-6"p>><"clear">',
                ajax:{
                    url:"{{ route('jobs.index') }}",
                    type:'GET',
                    data:function (d)
                    {
                        d.position=$('#positionS').val();
                        d.status=$('#status').val();

                    }
                },
                columns: [
                    { data: 'jocode'},
                    { data: 'poname',orderable:false},
                    { data: 'emname',
                            render:function (data,type,row){
                                if(!data){
                                    return "-- -- --";
                                }else{
                                    return data;
                                }

                            }
                    },
                    { data:'emcode',
                        render: function (data,type,row){
                            if(data)
                            {
                                return "<center><i class='icon-checkbox-unchecked danger' ><i/></center>"
                            }
                            return "<center><i class='icon-checkbox-unchecked danger' ><i/></center>";
                        }
                    },
                    { data: 'acctions',class:'center',orderable:false},
                ]
            });
        });
        function updateDtbl() {
            $('#laravel_datatable').DataTable().draw(true);
        }
    </script>
{{--    <style type="text/css">--}}
{{--        td.center{--}}
{{--            text-align: center;--}}
{{--        }--}}
{{--    </style>--}}
@endsection
