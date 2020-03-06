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
                    @if(Auth::user()->hasPermission('puede_ver_roles'))
                    <li class="active"><a href="{{route('roles.index')}}" data-i18n="nav.dash.main" class="menu-item">Roles</a>
                    </li>
                    @endif
                    <li class="active">
                        <a href="{{route('permissions.index')}}" data-i18n="nav.dash.main" class="menu-item">Permisos</a>
                    </li>
                    <li class="active">
                        <a href="{{route('users.index')}}" data-i18n="nav.dash.main" class="menu-item">Usuarios</a>
                    </li>
                        @if(Auth::user()->hasPermission('puede_ver_grupos'))
                            <li class="active"><a href="{{route('groups.index')}}" data-i18n="nav.dash.main" class="menu-item">Grpos de usuarios</a>
                            </li>
                        @endif

                </ul>
            </li>
        </ul>
    </div>
</div>
