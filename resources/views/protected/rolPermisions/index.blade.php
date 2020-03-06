@extends('layout.layout')

@section('title') Roles y permisos @endsection

@section('body')
<div class="content-body">
    <section class="card">
        <div class="card-header">
            <h4 class="card-title" id="basic-layout-form">Permisos de {{$rol->getName()}}</h4>
            <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
            <div class="heading-elements"></div>
        </div>
        <br>
        <div class="card-body">
            <div class="row">
                <div class="col col-md-8 offset-md-2 offset-xs-0">
                    <div class="row">
                        <div class="col-xs-5 col-md-5">
                            <p> Permisos disponibles</p>
                            <select name="select_option" id="search" style="font-size: 1.1rem;" class="form-control" size="12" multiple="multiple">
                                @foreach($permisions  as $pe)
                                    <option value="{{ $pe->getId() }}">{{ $pe->getName() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xs-1 col-md-2">
                            <br><br><br><br>
                            <button type="button" id="search_rightSelected" class="btn btn-block btn-info"><i class="icon-arrow-right2"></i></button>
                            <button type="button" id="search_leftSelected" class="btn btn-block btn-info"><i class="icon-arrow-left2"></i></button>
                            <br><br><br><br>
                            <button type="button"
                                    class="btn btn-block btn-info"
                                    onclick="saveChangeDual('#search_to','{{ $rol->getId() }}','{{ route('update.rol.permisions') }}')" >
                                Guardar
                            </button>
                        </div>
                        <div class="col-xs-5 col-md-5">
                            <p>permisos del rol</p>
                            <select name="selected_options" id="search_to" class="form-control" style="font-size: 1.1rem;" size="12" multiple="multiple">
                                @foreach($rol->permissions  as $pivot)
                                    <option value="{{ $pivot->getId() }}">{{ $pivot->getName() }}</option>
                                @endforeach

                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </section>


    <input type="text" hidden name="token" id="token" value="{{csrf_token()}}">
</div>
@endsection

@section('scripts')
    <script src="{{ asset('js/util/duallist.js') }}" ></script>
    <link rel="stylesheet" href="{{ asset('duallist/style.css') }}">
    <script src="{{ asset('duallist/multiselect.min.js') }}"></script>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#search').multiselect({
                search: {
                    left: '<input type="text" name="bsq1" class="form-control" placeholder="Search..." />',
                    right: '<input type="text" name="bsq2" class="form-control" placeholder="Search..." />',
                },
                fireSearch: function(value) {
                    return value.length > 2;
                }
            });
        });
    </script>
@endsection
