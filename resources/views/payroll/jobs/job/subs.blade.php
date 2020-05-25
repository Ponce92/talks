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

                        <li class="breadcrumb-item">
                            <a href="{{ route('jobs.index') }}">Plazas laborales</a>
                        </li>
                        <li class="breadcrumb-item">
                            {{ $job->getCode() }}
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
                    <h4 class="card-title" id="basic-layout-form"><strong>::</strong> Plaza </h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <input type="number" id="jobId" value="{{$job->getId()}}" hidden >
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label for="codigo">Codigo plaza</label>
                                <div class="form-group">
                                    <input name="none"
                                           readonly
                                           class="form-control"
                                           value="{{ $job->getCode() }}"
                                           type="text">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="Cargo">Cargo de la plaza:</label>
                                <div class="form-group">
                                    <input name="none"
                                           readonly
                                           class="form-control"
                                           value="{{ $job->position->getName() }}"
                                           type="text">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="codigo">Empleado asignado :</label>
                                <div class="form-group">
                                    <input name="none"
                                           readonly
                                           class="form-control"
                                           value="{{ $job->getEmployee()->getName() }}"
                                           type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <strong class="mb-3"> Plazas sin asignar:</strong>
                                    </div>
                                </div>
                                <br>
                                <table role="table"
                                       id="tbl_opts"
                                       width="100%"
                                       class="table table-bordered sget">
                                    <thead>
                                        <tr>
                                            <th width="100" >Codigo plaza</th>
                                            <th>Puesto</th>
                                            <th>Empleado asignado</th>
                                            <th width="50">Accion</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <strong class="mb-3">Plazas supervisadas: </strong>
                                        <br>
                                    </div>
                                </div>
                                <br>
                                <table role="table"
                                       id="tbl_subs"
                                       width="100%"
                                       class="table table-bordered sget" >
                                    <thead>
                                        <tr>
                                            <th width="100" >Codigo plaza</th>
                                            <th>Puesto</th>
                                            <th>Empleado asignado</th>
                                            <th width="50">Accion</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    {{--|
        |Modal de asingacion de personal a puestos de trabajo
   --}}
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


            $('#tbl_opts').DataTable({
                processing: true,
                responsive:true,
                serverSide: true,
                dom: 'rt<"bottom row"<"col col-md-6"l><"col col-md-6"p>><"clear">',
                ajax:{
                    url:"{{ route('jobs.subsOut',$job->getId()) }}",
                    type:'GET',
                },
                columns: [
                    { data: 'jocode'},
                    { data: 'poname',orderable:false},
                    { data: 'emname'},
                    { data: 'acctions',orderable:false},
                ]
            });

            $('#tbl_subs').DataTable({
                processing: true,
                responsive:true,
                serverSide: true,
                dom: 'rt<"bottom row"<"col col-md-6"l><"col col-md-6"p>><"clear">',
                ajax:{
                    url:"{{ route('jobs.subsIn',$job->getId()) }}",
                    type:'GET',
                },
                columns: [
                    { data: 'jocode'},
                    { data: 'poname',orderable:false},
                    { data: 'emname'},
                    { data: 'acctions',orderable:false},
                ]
            });
        });

        //========================================================
        //========================================================
        //========================================================
        function sendIdPost(url,input)
        {
            token=$('#token').val();
            $.ajax({
                url:url,
                data:{id:input.val()},
                headers:{'X-CSRF-TOKEN':token},
                method:'POST',
                dataType:'json',
                success: function (data)
                {
                    switch (data.status) {
                        case 'success':
                            $('#tbl_subs').DataTable().ajax.reload();
                            $('#tbl_opts').DataTable().ajax.reload();
                            showMesssage('success',"Trasaccion realizada correctamente");
                            break;
                    }
                },
                statusCode: {
                    404: function()
                    {
                        showMesssage('danger','El servidor no ha sido encontrado, recargue la pagina y vuelva a intentarlo');
                    },
                    500:function ()
                    {
                        showMesssage('danger','El servidor a fallado al completar la transaccion');
                    },
                    405:function ()
                    {
                        showMesssage('danger',"El servidor desconoce la peticion realizada");
                    }
                },
            });
        }

    </script>

@endsection
