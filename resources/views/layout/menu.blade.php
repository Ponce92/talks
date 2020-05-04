<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">

    <div class="main-menu-header">
        <br>
        <input type="text" placeholder="Search" class="menu-search form-control round"/>
    </div>
    <br>
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class=" nav-item">
                <a href="index.html">
                    <i class="icon-settings2"></i>
                    <span data-i18n="nav.dash.main" class="menu-title">Administracion</span>
                </a>
                <ul class="menu-content">

                    <li><a href="{{route('roles.index')}}" data-i18n="nav.dash.main" class="menu-item">Roles</a>
                    </li>

{{--                    <li>--}}
{{--                        <a href="{{route('permissions.index')}}" data-i18n="nav.dash.main" class="menu-item">Permisos</a>--}}
{{--                    </li>--}}


                    <li>
                        <a href="{{route('users.index')}}" data-i18n="nav.dash.main" class="menu-item">Usuarios</a>
                    </li>
                    <li><a href="{{route('groups.index')}}" data-i18n="nav.dash.main" class="menu-item">Grpos de usuarios</a>
                    </li>

                </ul>
            </li>

{{--       ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++     --}}
            <li class=" nav-item">
                <a href="#">
                    <i class="icon-calculator2"></i>
                    <span data-i18n="nav.dash.main" class="menu-title">Planilla</span>
                </a>
                <ul class="menu-content">
                    @if(Auth::user()->hasPermission('puede_ver_departamentos'))
                        <li><a href="{{route('departments.index')}}" data-i18n="nav.dash.main" class="menu-item">Departamentos</a>
                        </li>
                    @endif
                    @if(Auth::user()->hasPermission('puede_ver_cargos'))
                        <li>
                            <a href="{{route('positions.index')}}" data-i18n="nav.dash.main" class="menu-item">Puestos de trabajo</a>
                        </li>
                    @endif

                    @if(Auth::user()->hasPermission('puede_ver_plazas'))
                        <li>
                            <a href="{{route('jobs.index')}}" data-i18n="nav.dash.main" class="menu-item">Plazas de trabajo</a>
                        </li>
                    @endif
                    @if(Auth::user()->hasPermission('puede_ver_plazas'))
                        <li>
                            <a href="{{route('employees.index')}}" data-i18n="nav.dash.main" class="menu-item">Planilla</a>
                        </li>
                    @endif


                </ul>
            </li>
        </ul>
    </div>
</div>
