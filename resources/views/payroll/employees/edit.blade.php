@extends('layout.layout')
@section('title') Edit @endsection

@section('body')
    <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
                <div class="row breadcrumbs-top d-inline-block">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('employees.index')}}">Empleados</a>
                            </li>
                            <li class="breadcrumb-item">Edit
                            </li>
                        </ol>
                    </div>
                </div>
            </div>

{{--
    Formulario de empleados y personas .................
--}}
    <div class="row match-height" >
        <div class="col-md-6" >
            <div class="card"  >
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form"> Empleado</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <label for="sw1" class="swl">Editar :</label>
                            <input type="checkbox"
                                   id="sw1"
                                   data-target="#employeeTrg"
                                   name="sw1"
                                   on-url="{{route('employees.edit',$employee->getId())}}"
                                   off-url="{{route('employees.show',$employee->getId())}}"
                                   class="js-switch" />
                        </ul>
                    </div>
                </div>
{{--                collapse in--}}
                <div class="card-body" >
                    <div class="card-block" id="employeeTrg">
                            @include('payroll.employees.employeeedit')
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form"> Datos personales</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                    <div class="heading-elements">
                        <ul class="list-inline mb-0">
                            <label for="w1" class="swl">Editar :</label>
                            <input type="checkbox" id="sw2" class="js-switch" />
                        </ul>
                    </div>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block" id="personTrg"style="height:400px;overflow-y: auto; ">
                        @include('payroll.persons.edit')
                    </div>

                </div>
            </div>
        </div>
    </div>


    <style>
        html body a {
            font-size: 16px;
            color: #3BAFDA;
        }
        html body a:hover {
            color: #3BAFDA;
        }
        label.swl{
            font-size: 16px;
            font-weight: bold;
            color: rgb(125,125,125);
            font-family: 'Nunito', sans-serif;
        }
        input:read-only,select:read-only{
            background: white !important;
        }


    </style>
@endsection
@section('scripts')
    <link  href="{{ asset('plugins/switch/switchery.min.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('plugins/switch/switchery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/payroll/employee.js') }}"></script>
    <script src="{{ asset('js/util/functions.js') }}"></script>
@endsection
