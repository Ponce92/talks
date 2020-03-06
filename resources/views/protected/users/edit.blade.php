@extends('layout.layout')

@section('title') User Edit @endsection

@section('body')

    <div class="row match-height">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Credenciales de usuario</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">

                        <form action="#" method="post" data-url="{{ route('users.store') }}" autocomplete="nope" id="formCreate">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col col-sm-12 col-md-12">
                                        <label class="label" for="name">Nombre de usuario :</label>
                                        <fieldset class="form-group">
                                            <input type="text"
                                                   id="name"
                                                   name="name"
                                                   value="{{ $errors->any() ? $name:'' }}"
                                                   class="form-control {{ $errors->has('name') ? 'border-danger':'' }} ">
                                            <p class="text-right">
                                                <small class="danger text-muted">
                                                    {{ $errors->first('name') }}
                                                </small>

                                            </p>
                                        </fieldset>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password"
                                                   name="password"
                                                   class="form-control {{ $errors->has('password') ? 'border-danger':'' }}"
                                                   autocomplete="none">
                                            <p class="text-right">
                                                <small class="danger text-muted">
                                                    {{ $errors->first('password') }}
                                                </small>

                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Repita password</label>
                                            <input type="password"
                                                   name="password_confirmation"
                                                   class="form-control {{ $errors->has('password') ? 'border-danger':'' }} "
                                                   autocomplete="off" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="Rol">Seleccione</label>
                                            <select name="rol" id="rol"  class="form-control {{ $errors->has('rol') ? 'border-danger':'' }}">
                                                <option value="">Selecione rol</option>

                                                @if($errors->any())
                                                    @foreach($roles as $obj)
                                                        <option value="{{ $obj->getId() }}" {{ $obj->getId() == $rol ? 'selected':'' }}  >
                                                            {{ $obj->getName() }}
                                                        </option>
                                                    @endforeach
                                                @else
                                                    @foreach($roles as $obj)
                                                        <option value="{{ $obj->getId() }}">{{ $obj->getName() }}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                            <p class="text-right">
                                                <small class="danger text-muted">
                                                    {{ $errors->first('rol') }}
                                                </small>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input"
                                                           type="checkbox"
                                                           id="estado"
                                                           name="estado"
                                                           @if($errors->any())
                                                           {{ $estado ? 'checked': '' }}
                                                           @else
                                                           checked
                                                           @endif
                                                           value="true"
                                                    >
                                                    <label class="form-check-label" for="estado">Activo</label>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        {{--   +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++     --}}
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title" id="basic-layout-form">Permisos asignados</h4>
                    <a class="heading-elements-toggle"><i class="icon-ellipsis font-medium-3"></i></a>
                </div>
                <div class="card-body collapse in">
                    <div class="card-block">
                        <div class="row">
                            <div class="col col-md-5">
                                <p> Permisos disponibles</p>
                                <select name="select_option" id="search" style="font-size: 1.1rem;" class="form-control" size="12" multiple="multiple">
                                    @foreach($permisions  as $pivot)
                                        <option value="{{ $pivot->getId() }}">{{ $pivot->getName() }}</option>
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
                                        onclick="saveChangeDual('#search_to','','')" >Guardar
                                </button>
                            </div>
                            <div class="col-xs-5 col-md-5">
                                <p>permisos del rol</p>
                                <select name="selected_options" id="search_to" class="form-control" style="font-size: 1.1rem;" size="12" multiple="multiple"></select>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
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
