@extends('layout.layout')
@section('title') Home @endsection

@section('hrow') @endsection

@section('body')
    <div class="col-md-12">
        <div class="row">
            <section id="cards">
                <div class="row">
                    @if(Auth::user()->hasPermission('puede_ver_roles'))
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-block">

                                        <center>
                                            <p><i class="icon-cog2 dash-icon"></i></p>
                                            <h4 class="card-title" >Gestion de roles.</h4>
                                        </center>
                                        <p class="card-text">
                                            Administracion de los roles de usuarios dentro del sistema.
                                        </p>
                                        <a href="{{route('roles.index')}}" class="btn-link">Ir a gestion de roles</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->hasPermission('puede_ver_permisos'))
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-block">

                                        <center>
                                            <p><i class="icon-key2 dash-icon"></i></p>
                                            <h4 class="card-title" >Gestion de permisos.</h4>
                                        </center>
                                        <p class="card-text">
                                            Administracion de los roles de usuarios dentro del sistema.
                                        </p>
                                        <a href="{{route('permissions.index')}}" class="btn-link">Ir a gestion de permisos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->hasPermission('puede_ver_cargos'))
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-block">

                                        <center>
                                            <p><i class="icon-list3 dash-icon"></i></p>
                                            <h4 class="card-title" >Gestion de cargos.</h4>
                                        </center>
                                        <p class="card-text">
                                            Administracion de cargos laborales de talkamericas
                                        </p>
                                        <a href="{{route('positions.index')}}" class="btn-link">Ir a gestion de cargos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->hasPermission('puede_ver_departamentos'))
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-block">

                                        <center>
                                            <p><i class="icon-sitemap dash-icon"></i></p>
                                            <h4 class="card-title" >Gestion de departamentos.</h4>
                                        </center>
                                        <p class="card-text">
                                            Administracion de los diferentes secciones de la empresa
                                        </p>
                                        <a href="{{route('departments.index')}}" class="btn-link">Ir a gestion de departamentos</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(Auth::user()->hasPermission('puede_ver_plazas'))
                            <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="card-block">

                                            <center>
                                                <p><i class="icon-cog2 dash-icon"></i></p>
                                                <h4 class="card-title" >Asignacion de plazas.</h4>
                                            </center>
                                            <p class="card-text">
                                                Administracion y gestion de plazas laborales.
                                            </p>
                                            <a href="{{route('jobs.index')}}" class="btn-link">Ir a gestion de plazas</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                </div>
            </section>
        </div>
    </div>


<style>
    i.dash-icon{
        font-size: 6rem;
    }
    .card:hover{

        -webkit-box-shadow: 10px 10px 5px -9px rgba(0,0,0,0.75);
        -moz-box-shadow: 10px 10px 5px -9px rgba(0,0,0,0.75);
        box-shadow: 10px 10px 5px -9px rgba(0,0,0,0.75);
        transition: .2s;
    }

    .card:hover i.dash-icon{
        color: #2F3061;
        /*color: #22333B;*/
        transition: .2s;
    }
</style>
@endsection


