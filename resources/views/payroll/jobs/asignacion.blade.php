<form action="#"
      data-url="{{route('job.assignment.store')}}"
      method="POST"
      id="frmAssignment"
      name="frmAssignment">
    @csrf

    <input type="text" value="{{$job->getId()}}" name="jobId" id="jobId" hidden>
    {{--|================================================================
        | Seccion de asignacion del superior del puesto
        |================================================================
    --}}
{{--    @if($job->position->reqChief())--}}
{{--        <div class="row">--}}
{{--            <div class="col-md-3">--}}
{{--                <label for="chiefCode">Codigo puesto :</label>--}}
{{--                <div class="form-group">--}}
{{--                    <input class="form-control"--}}
{{--                           value=""--}}
{{--                           readonly--}}
{{--                           name="chiefCode" type="text">--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            <div class="col-md-9">--}}
{{--                <div class="col-md-12">--}}
{{--                    <input name="chiefCode" id="chiefCode" type="text" hidden>--}}
{{--                    <label for="chiefName">Seleccione jefe:</label>--}}
{{--                </div>--}}
{{--                <div class="col-xs-10">--}}
{{--                    <div class="form-group">--}}
{{--                        <input id="chiefName"--}}
{{--                               class="form-control"--}}
{{--                               type="text">--}}
{{--                    </div>--}}
{{--                    <div class="text-danger">--}}
{{--                        {{$errors->first('chiefCode')}}--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-xs-2">--}}
{{--                    <button type="button"--}}
{{--                            data-toggle="collapse"--}}
{{--                            data-parent="#accordionWrapa1"--}}
{{--                            href="#chiefEmployees"--}}
{{--                            aria-expanded="true"--}}
{{--                            aria-controls="accordion1"--}}
{{--                            class="btn btn-success">--}}
{{--                        <i class="icon-list"></i>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--        <div class="row">--}}
{{--            <div id="chiefEmployees"--}}
{{--                 role="tabpanel"--}}
{{--                 aria-labelledby="heading1"--}}
{{--                 class="collapse show"--}}
{{--                 style="">--}}
{{--                <div class="col-md-12"><hr></div>--}}
{{--                <div class="col-md-12">--}}
{{--                    <table class="table table-bordered sget"--}}
{{--                           id="chiefEmployeeModal"--}}
{{--                           style="width: 100%;"--}}
{{--                           role="table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>Codgio</th>--}}
{{--                            <th>Nombre planilla</th>--}}
{{--                            <th>Cargo</th>--}}
{{--                            <th>Accion</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--                <div class="col-md-12"><hr></div>--}}
{{--            </div>--}}
{{--        </div>--}}

{{--    @endif--}}


    {{--|================================================================
        | Seccion de empleado asignado al puesto de trabajo
        |================================================================
    --}}

    <div class="row">
        <div class="col-md-3">
            <label for="">Codigo de puesto:</label>
            <div class="form-group">
                <input name="jobCode" value="{{$job->getCode()}}" readonly class="form-control" type="text">
            </div>
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-md-12">
                    <input name="employeeCode" id="employeeCode" type="text" hidden>
                    <label for="EmployeeName">Empleado asignado:</label>
                </div>
                <div class="col-xs-10">
                    <div class="form-group">
                        <input id="employeeName"
                               readonly
                               class="form-control"
                               type="text">
                        <div class="text-danger">
                            {{ $errors->has('employeeCode') ? 'Seleccione empleoado':'' }}
                        </div>
                    </div>
                </div>

                <div class="col-xs-2">
                    <button type="button"
                            data-toggle="collapse"
                            data-parent="#accordionWrapa1"
                            href="#acc-employees"
                            aria-expanded="true"
                            aria-controls="accordion1"
                            class="btn btn-success">
                        <i class="icon-list"></i>
                    </button>
            </div>
        </div>

            </div>
    </div>
    <div class="row">
        <div id="acc-employees"
             role="tabpanel"
             aria-labelledby="heading1"
             class="collapse show"
             style="">
            <div class="col-md-12"><hr></div>
            <div class="col-md-12">
                    <table class="table table-bordered sget"
                           id="employeeDtModal"
                           style="width: 100%;"
                           role="table">
                        <thead>
                        <tr>
                            <th>Codgio</th>
                            <th>Nombre planilla</th>
                            <th>Cargo</th>
                            <th>Accion</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
            </div>
        </div>


    </div>

    {{--|================================================================
        | botones del formulario
        |================================================================
    --}}
    <div class="form-actions right">
        <button type="button"
                class="btn btn-grey"
                data-dismiss="modal">
            <i class="icon-close"></i> Cancelar
        </button>
        <button type="button"
                onclick="loadRequestPost($('#frmAssignment'),$('#asingacionModal'),$('#asignacionTarget'))"
                form="formCreate"
                class="btn btn-success">
            <i class="icon-save"> </i>   Guardar
        </button>
    </div>
</form>



<script type="text/javascript">
            //================================
            $(document).ready( function () {
                $('#employeeDtModal').DataTable({
                    processing: true,
                    lengthChange: false,
                    pageLength: 5,
                    serverSide: true,
                        ajax:{
                            url:"{{ route('jobs.employees.list',$job->getId()) }}",
                            type:'GET',
                        },
                    columns: [
                        { data: 'code'},
                        { data: 'full_name'},
                        { data: 'cargo'},
                        {
                            data: null,orderable:false,
                            render: function ( data, type,row )
                            {
                                var f1="$('#employeeName').val('"+row.full_name+"')";
                                var f2=";$('#employeeCode').val('"+row.code+"')";

                                var btn='<button type="button" data-toggle="collapse"\n' +
                                    '                            data-parent="#accordionWrapa1"\n' +
                                    '                            href="#acc-employees"\n' +
                                    '                            aria-expanded="true"\n' +
                                    '                            aria-controls="acc-employees" class="btn btn-sm btn-success" onclick=" '+f1+f2+'"><i class="icon-plus"></i></button>'

                                return '<center>'+btn+'</center>'
                            }
                        }
                    ]
                });

                {{--$('#chiefEmployeeModal').DataTable({--}}
                {{--    processing: true,--}}
                {{--    lengthChange: false,--}}
                {{--    pageLength: 3,--}}
                {{--    serverSide: true,--}}
                {{--    ajax:{--}}
                {{--        url:"{{ route('jobs.chief.list',$job->getId()) }}",--}}
                {{--        type:'GET',--}}
                {{--    },--}}
                {{--    columns: [--}}
                {{--        { data: 'jocode'},--}}
                {{--        { data: 'poname'},--}}
                {{--        { data: 'emcode'},--}}
                {{--        {--}}
                {{--            data: null,orderable:false,--}}
                {{--            render: function ( data, type,row )--}}
                {{--            {--}}
                {{--                var f1="$('#chiefName').val('"+row.full_name+"')";--}}
                {{--                var f2=";$('#chiefCode').val('"+row.code+"')";--}}

                {{--                var btn='<button type="button" data-toggle="collapse"\n' +--}}
                {{--                    '                            data-parent="#accordionWrapa1"\n' +--}}
                {{--                    '                            href="#chiefEmployees"\n' +--}}
                {{--                    '                            aria-expanded="true"\n' +--}}
                {{--                    '                            aria-controls="chiefEmployees" class="btn btn-sm btn-success" onclick=" '+f1+f2+'"><i class="icon-plus"></i></button>'--}}

                {{--                return '<center>'+btn+'</center>'--}}
                {{--            }--}}
                {{--        }--}}
                {{--    ]--}}
                {{--});--}}
            });
</script>
