@extends('layout.layout')

@section('title') Plazas @endsection

@section('body')
    <div class="col-md-9">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">Plazas laborales</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                    @if(Auth::user()->hasPermission('puede_crear_plazas'))
                        <button class="btn btn-green"
                                type="button"
                                id="createBtn"
                                onclick="loadCardAjax('{{ route('jobs.create') }}',$('#card_job'))">
                            <i class="icon-plus" style="color: white;"></i>    Nuevas plazas
                        </button>
                    @endif
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
                                        <th>Id</th>
                                        <th>Codigo</th>
                                        <th>Departamento</th>
                                        <th>Cargo</th>
                                        <th>Vacante</th>
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
    <div class="col-md-3">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title" id="basic-layout-form">:: Plazas</h4>
                <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                <div class="heading-elements">
                </div>
            </div>
            <div class="card-body collapse in">
                <div class="card-block" id="card_job">
                </div>
            </div>
        </div>
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
                        <i class="icon icon-list" > </i>
                        Seleccione cargo
                    </h4>
                </div>
                <div class="modal-body" id="addCargoModal">

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
                    { data: 'id'},
                    { data: 'cs_code'},
                    { data: 'dep',orderable:false},
                    { data: 'pos',orderable:false},
                    { data:'vacant',
                        render: function (data,type,row){
                            if(data){
                                return "<i class='icon-checkbox-checked success' ><i/>"
                            }
                            return "<i class='icon-checkbox-unchecked danger' ><i/>";
                        },orderable:false,class:'center'},
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
