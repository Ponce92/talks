<!DOCTYPE html>
<html lang="en" data-textdirection="ltr" class="loading">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <title>Talk :: @yield('title')</title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-touch-fullscreen" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/bootstrap-extended.css') }}">
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/fonts/icomoon.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/fonts/feather/style.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/fonts/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/vendors/css/extensions/pace.css') }}">
    <!-- END VENDOR CSS-->

    <!-- BEGIN ROBUST CSS-->

    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/app.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/colors.css') }}">
    <!-- END ROBUST CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/core/menu/menu-types/vertical-overlay-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('template/app-assets/css/core/colors/palette-gradient.css') }}">
    <!-- END Page Level CSS-->
    <!-- BEGIN Custom CSS-->

    <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('pfNotify/PNotify.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main/sget.css') }}">
    @yield('css')

</head>
<body data-open="click" data-menu="vertical-menu" data-col="2-columns" class="vertical-layout vertical-menu 2-columns  fixed-navbar">

<!-- navbar-fixed-top-->

@include('layout.navbar')

<!-- ////////////////////////////////////////////////////////////////////////////-->


<!-- main menu-->
@include('layout.menu')
<!-- / main menu-->

<div class="app-content content container-fluid">
    <div class="content-wrapper">
        <div class="content-header">
            @yield('hrow')
        </div>
        <div class="content-body">
            @yield('body')

        </div>
    </div>
</div>


{{--<footer class="footer footer-static footer-light navbar-border">--}}
{{--    <p class="clearfix text-muted text-sm-center mb-0 px-2"><span class="float-md-left d-xs-block d-md-inline-block">Copyright  &copy; 2017 <a href="https://themeforest.net/user/pixinvent/portfolio?ref=pixinvent" target="_blank" class="text-bold-800 grey darken-2">PIXINVENT </a>, All rights reserved. </span><span class="float-md-right d-xs-block d-md-inline-block">Hand-crafted & Made with <i class="icon-heart5 pink"></i></span></p>--}}
{{--</footer>--}}


<script src="{{ asset('template/app-assets/js/core/libraries/jquery.min.js') }} " type="text/javascript"></script>
<script src="{{ asset('template/app-assets/vendors/js/ui/tether.min.js') }} " type="text/javascript"></script>
<script src="{{ asset('template/app-assets/js/core/libraries/bootstrap.min.js') }} " type="text/javascript"></script>

<script src="{{ asset('template/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js') }} " type="text/javascript"></script>
<script src="{{ asset('template/app-assets/vendors/js/ui/unison.min.js') }} " type="text/javascript"></script>
<script src="{{ asset('template/app-assets/vendors/js/ui/blockUI.min.js') }} " type="text/javascript"></script>
<script src="{{ asset('template/app-assets/vendors/js/ui/jquery.matchHeight-min.js') }} " type="text/javascript"></script>
<script src="{{ asset('template/app-assets/vendors/js/ui/screenfull.min.js') }} " type="text/javascript"></script>
<script src="{{ asset('template/app-assets/vendors/js/extensions/pace.min.js') }} " type="text/javascript"></script>


<script src="{{ asset('template/app-assets/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/app-assets/js/core/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('template/app-assets/js/scripts/pages/dashboard-lite.js') }}" type="text/javascript"></script>
<script src="{{ asset('pfNotify/pnotify.js') }}"></script>
<script src="{{ asset('pfNotify/PNotifyDesktop.js') }}"></script>
<script src="{{ asset('js/public/app.js') }}"></script>
@yield('scripts')

</body>
</html>

