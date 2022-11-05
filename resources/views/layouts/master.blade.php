<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('material') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('material') }}/img/favicon.png">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="{{asset('Admin\css\material-dashboard-rtl.css')}}">
    <link rel="stylesheet" href="{{asset('Admin\css\material-dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('Admin\css\material-dashboard.css.map')}}">
    <link rel="stylesheet" href="{{asset('Admin\css\material-dashboard.min.css')}}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />



    {{-- <!-- CSS Files -->
    <link href="{{ asset('Admin/css/material-dashboard.css?v=2.1.1')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->--}}
    <link href="{{ asset('Admin') }}/demo/demo.css" rel="stylesheet" />
    </head>
    <body class="{{ $class ?? '' }}">
        @auth()
        <li>
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();" style="color:white;">
              <i class="fa fa-sign-out"></i>&nbsp;{{ __('Logout') }}
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              @csrf
            </form>
          </li>
            @include('layouts.page_templates.auth')
        @endauth
        @guest()
            @include('layouts.page_templates.guest')
        @endguest
        @if (auth()->check())
{{--        <div class="fixed-plugin">--}}
{{--          <div class="dropdown show-dropdown">--}}
{{--            <a href="#" data-toggle="dropdown">--}}
{{--                <i class="fas fa-cog"></i>--}}
{{--            </a>--}}
{{--            <ul class="dropdown-menu">--}}
{{--              <li class="header-title"> Sidebar Filters</li>--}}
{{--              <li class="adjustments-line">--}}
{{--                <a href="javascript:void(0)" class="switch-trigger active-color">--}}
{{--                  <div class="badge-colors ml-auto mr-auto">--}}
{{--                    <span class="badge filter badge-purple " data-color="purple"></span>--}}
{{--                    <span class="badge filter badge-azure" data-color="azure"></span>--}}
{{--                    <span class="badge filter badge-green" data-color="green"></span>--}}
{{--                    <span class="badge filter badge-warning active" data-color="orange"></span>--}}
{{--                    <span class="badge filter badge-danger" data-color="danger"></span>--}}
{{--                    <span class="badge filter badge-rose" data-color="rose"></span>--}}
{{--                  </div>--}}
{{--                  <div class="clearfix"></div>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li class="header-title">Images</li>--}}
{{--              <li class="active">--}}
{{--                <a class="img-holder switch-trigger" href="javascript:void(0)">--}}
{{--                  <img src="{{ asset('Admin') }}/img/sidebar-1.jpg" alt="">--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li>--}}
{{--                <a class="img-holder switch-trigger" href="javascript:void(0)">--}}
{{--                  <img src="{{asset('Admin')}}/img/sidebar-2.jpg" alt="">--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li>--}}
{{--                <a class="img-holder switch-trigger" href="javascript:void(0)">--}}
{{--                  <img src="{{ asset('Admin') }}/img/sidebar-3.jpg" alt="">--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li>--}}
{{--                <a class="img-holder switch-trigger" href="javascript:void(0)">--}}
{{--                  <img src="{{ asset('Admin') }}/img/sidebar-4.jpg" alt="">--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              --}}{{-- <li class="button-container">--}}
{{--                <a href="https://www.creative-tim.com/product/material-dashboard-laravel" target="_blank" class="btn btn-primary btn-block">Free Download</a>--}}
{{--              </li> --}}
{{--              <!-- <li class="header-title">Want more components?</li>--}}
{{--                  <li class="button-container">--}}
{{--                      <a href="https://www.creative-tim.com/product/material-dashboard-pro" target="_blank" class="btn btn-warning btn-block">--}}
{{--                        Get the pro version--}}
{{--                      </a>--}}
{{--                  </li> -->--}}
{{--              --}}{{-- <li class="button-container">--}}
{{--                <a href="https://material-dashboard-laravel.creative-tim.com/docs/getting-started/laravel-setup.html" target="_blank" class="btn btn-default btn-block">--}}
{{--                  View Documentation--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li class="button-container">--}}
{{--                <a href="https://www.creative-tim.com/product/material-dashboard-pro-laravel" target="_blank" class="btn btn-danger btn-block btn-round">--}}
{{--                  Upgrade to PRO--}}
{{--                </a>--}}
{{--              </li>--}}
{{--              <li class="button-container github-star">--}}
{{--                <a class="github-button" href="https://github.com/creativetimofficial/material-dashboard-laravel" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star ntkme/github-buttons on GitHub">Star</a>--}}
{{--              </li>--}}
{{--              <li class="header-title">Thank you for 95 shares!</li>--}}
{{--              <li class="button-container text-center">--}}
{{--                <button id="twitter" class="btn btn-round btn-twitter"><i class="fa fa-twitter"></i> &middot; 45</button>--}}
{{--                <button id="facebook" class="btn btn-round btn-facebook"><i class="fa fa-facebook-f"></i> &middot; 50</button>--}}
{{--                <br>--}}
{{--                <br>--}}
{{--              </li> --}}
{{--            </ul>--}}
{{--          </div>--}}
{{--        </div>--}}
        @endif
        <!--   Core JS Files   -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/core/jquery.min.js"></script>
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/core/popper.min.js"></script>
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/core/bootstrap-material-design.min.js"></script>
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/perfect-scrollbar.jquery.min.js"></script>
        <!-- Plugin for the momentJs  -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/moment.min.js"></script>
        <!--  Plugin for Sweet Alert -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/sweetalert2.js"></script>
        <!-- Forms Validations Plugin -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/jquery.validate.min.js"></script>
        <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/jquery.bootstrap-wizard.js"></script>
        <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/bootstrap-selectpicker.js"></script>
        <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/bootstrap-datetimepicker.min.js"></script>
        <!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/jquery.dataTables.min.js"></script>
        <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/bootstrap-tagsinput.js"></script>
        <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/jasny-bootstrap.min.js"></script>
        <!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/fullcalendar.min.js"></script>
        <!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/jquery-jvectormap.js"></script>
        <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/nouislider.min.js"></script>
        <!-- Include a polyfill for ES6 Promises (optional) for IE11, UC Browser and Android browser support SweetAlert -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
        <!-- Library for adding dinamically elements -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/arrive.min.js"></script>
        <!--  Google Maps Plugin    -->
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbVUXb1ZCXDbVu5V-0AjxpikPl6jmgpbQ"></script>
        <!-- Chartist JS -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/chartist.min.js"></script>
        <!--  Notifications Plugin    -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/plugins/bootstrap-notify.js"></script>
        <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/material-dashboard.js?v=2.1.1" type="text/javascript"></script>
        <!-- Material Dashboard DEMO methods, don't include it in your project! -->
        <script src="https://material-dashboard-laravel.creative-tim.com/material/demo/demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="https://material-dashboard-laravel.creative-tim.com/material/js/settings.js"></script>

        @stack('js')
    </body>
</html>
