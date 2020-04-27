@extends('layout.layout')

@section('title') Departamentos @endsection

@section('body')
     <div class="row match-height">
         <div class="col-md-6">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title" id="basic-layout-form">General</h4>
                     <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                 </div>
                 <div class="card-body collapse in">
                     <div class="card-block">
                         <div class="row">
                             @if($errors->any())
                                 <div class="col col-md-12">
                                     <div class="alert alert-danger alert-dismissible mb-2" role="alert">
                                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                             <span aria-hidden="true">×</span>
                                         </button>
                                         <strong>Error !</strong> Se encontraron errores al processar el formulario.
                                     </div>
                                 </div>

                             @endif
                         </div>

                         <form action="#" method="post" data-url="{{ route('departments.update',$department->getId()) }}" id="formCreate">
                             <div class="form-body">
                                 <div class="row">
                                     <div class="col col-sm-8 col-md-8">
                                         <label class="label" for="name">Nombre :</label>
                                         <fieldset class="form-group">
                                             <input type="text"
                                                    id="name"
                                                    name="name"
                                                    value="{{$department->getName()}}"
                                                    class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">
                                             <p class="text-right">
                                                 <small class="danger text-muted">
                                                     {{ $errors->first('name') }}
                                                 </small>

                                             </p>
                                         </fieldset>
                                     </div>
                                     <div class="col col-md-4">
                                         <label class="label" for="name">Codigo :</label>
                                         <fieldset class="form-group">
                                             <input type="text"
                                                    id="code"
                                                    name="code"
                                                    readonly
                                                    value="{{ $department->getCode()}}"
                                                    class="form-control {{ $errors->has('code') ? 'border-danger':'' }} ">
                                             <p class="text-right">
                                                 <small class="danger text-muted">
                                                     {{ $errors->first('code') }}
                                                 </small>

                                             </p>
                                         </fieldset>
                                     </div>
                                     <div class="col col-md-12">
                                         <div class="form-group">
                                             <label class="desc" for="desc">Descripcion :</label>
                                             <textarea name="desc"
                                                       style="resize: none;"
                                                       class="form-control mb-5 {{ $errors->has('desc') ? 'border-danger':'' }}"
                                                       id="desc"
                                                       cols="30"
                                                       rows="3">{{ $department->getDesc() }}</textarea>
                                             <p class="text-right">
                                                 <small class="danger text-muted">
                                                     {{ $errors->first('desc') }}
                                                 </small>
                                             </p>
                                         </div>
                                     </div>
                                 </div>

                             </div>
                             <div class="form-actions">
                                 <div class="text-right">
                                     <button type="reset"
                                             style="float:left !important;"
                                             class="btn btn-warning">Reset
                                         <i class="ft-refresh-cw position-right"></i>
                                     </button>
                                 </div>
                             </div>
                         </form>
                     </div>

                 </div>
             </div>
         </div>
         <div class="col-md-6">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title" id="basic-layout-form">Cargos</h4>
                     <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                     <div class="heading-elements">
                         <ul class="list-inline mb-0">
                             <li>
                                 <a data-action="reload" id="btn-pos" onclick="reloadPositions('{{route('getPositionsRelated',$department->getId())}}','#target-post');">
                                     <i class="icon-refresh2"></i></a>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="card-body collapse in">
                     <div class="card-block" id="target-post"style="height:400px;overflow-y: auto; ">

                     </div>

                 </div>
             </div>
         </div>
     </div>
     <div class="row match-height">
         <div class="col-md-6">
             <div class="card">
                 <div class="card-header">
                     <h4 class="card-title" id="basic-layout-form">Puestos de trabajo</h4>
                     <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                     <div class="heading-elements">
                         <ul class="list-inline mb-0">
                             <li>
                                 <a data-action="reload" id="btn-jobs" onclick="reloadDiv('{{route('jobsSummary',$department->getId())}}','#target-jobs');">
                                     <i class="icon-refresh2"></i></a>
                             </li>
                         </ul>
                     </div>
                 </div>
                 <div class="card-body collapse in">
                     <div class="card-block" id="target-jobs"style="height:400px;overflow-y: auto; ">

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
                 <div class="modal-footer"></div>
             </div>
         </div>
     </div>
{{--   ++++++++++++++++++++++++++  --}}

    <input type="text" hidden name="token" id="token" value="{{csrf_token()}}">
    <input type="number" hidden name="dep" id="dep" value="{{ $department->getId() }}">

@endsection

@section('scripts')
    <script src="{{ asset('js/payroll/department.js') }}"></script>
@endsection

<style>
    .i-btn{
        font-size: 25px;
    }
    .i-btn:hover.icon-trash2{
        cursor: pointer;
        color: #aa0000;
    }
    .i-btn:hover.icon-plus{
        cursor: pointer;
        color: #00aa00;
    }
</style>
