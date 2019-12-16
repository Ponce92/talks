<div data-scroll-to-active="true" class="main-menu menu-fixed menu-dark menu-accordion menu-shadow">

    <div class="main-menu-header">
        <input type="text" placeholder="Search" class="menu-search form-control round"/>
    </div>
    <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
            <li class=" nav-item">
                <a href="index.html">
                    <i class="icon-settings2"></i>
                    <span data-i18n="nav.dash.main" class="menu-title">Administracion</span>
                </a>
                <ul class="menu-content">
                    <li class="active"><a href="{{route('roles.index')}}" data-i18n="nav.dash.main" class="menu-item">Roles</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</div>
