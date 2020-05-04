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
                    <li class="breadcrumb-item">
                        <a href="{{route('departments.index')}}">Departments</a>
                    </li>
                    <li class="breadcrumb-item">
                        {{$department->getCode()}}
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
                     <h4 class="card-title" id="basic-layout-form">Departamento :: {{$department->getName()}} </h4>
                         <div class="heading-elements">
                             @if(Auth::user()->hasPermission('puede_crear_departamentos'))
                                 <button class="btn btn-green"
                                         type="button"
                                         onclick="loadCardAjax('{{route('areaope.create',$department->getId())}}',$('#card_trg'))">
                                     <i class="icon-plus" style="color: white;"></i>    Agregar
                                 </button>
                             @endif
                         </div>
                 </div>
                 <div class="card-body collapse in">
                     <div class="card-block">
                         <div class="row">
                             <div class="col-md-12">
                                 <form class="form mb-1">
                                     <div class="form-body">
                                         <h4 class="form-section">
                                             <i class="icon-android-apps">
                                             </i> Areas operativas del departamento
                                         </h4>
                                     </div>
                                 </form>
                             </div>
                         </div>
                         <div class="row">
                             <div class="col-md-12">
                                 <table class="table table-bordered sget dataTable"
                                        id="laravel_datatable"
                                        aria-describedby="DataTables_Table_0_info"
                                        role="grid"
                                        style="width: 100%">
                                     <thead>
                                     <tr class="odd">
                                         <th>Codigo</th>
                                         <th>Nombre</th>
                                         <th>Descipcion</th>
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
         <div class="col-md-4">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title" id="basic-layout-form">Edicion :: {{$department->getCode()}} </h4>
                     <div class="heading-elements">
                     </div>
                 </div>
                 <div class="card-body collapse in">
                     <div class="card-block" id="card_trg">
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


                         <br>
                     </div>

                 </div>
             </div>
         </div>
     </div>


{{--   ++++++++++++++++++++++++++  --}}
<div class="modal animated fadeIn text-left"
      id="modalAddPosition"
      tabindex="-1"
      role="dialog"
      aria-labelledby="add"
      style="display: none; padding-right: 15px;">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
                 <h4 class="modal-title">
                     <i class="icon-cog2"></i>
                     Seleccione cargo a agregar
                 </h4>
             </div>
             <div class="modal-body" id="trgp">
                 {{--   ++++++++++++++++++++++    --}}
             </div>
         </div>
     </div>
 </div>
{{--   ++++++++++++++++++++++++++  --}}

    <input type="text" hidden name="token" id="token" value="{{csrf_token()}}">
    <input type="number" hidden name="dep" id="dep" value="{{ $department->getId() }}">

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
                ajax: "{{ route('areaope.list',$department->getId()) }}",
                columns: [
                    { data: 'cs_code'},
                    { data: 'cs_name',orderable:false},
                    { data: 'cs_desc'},
                    { data: 'acctions'},
                ]
            });
        });
    </script>
@endsection
