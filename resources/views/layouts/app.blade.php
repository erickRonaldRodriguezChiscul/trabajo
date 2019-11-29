<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" type="image/png" href="{{ asset('img/taxi_logo.png') }}" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/select2/dist/css/select2.min.css') }}">  
  <link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/skins/_all-skins.min.css') }}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @yield('styleAgregado')
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('inicio') }}" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">{{ config('app.siglas','TAX') }}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{{ config('app.name') }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
            <li class="dropdown notifications-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <i class="fa fa-bell-o"></i>
                  <span class="label label-warning">10</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="header">You have 10 notifications</li>
                  <li>
                      <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                          <a href="#">
                          <i class="fa fa-users text-aqua"></i> 5 new members joined today
                          </a>
                      </li>
                      <li>
                          <a href="#">
                          <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                          page and may cause design problems
                          </a>
                      </li>
                      <li>
                          <a href="#">
                          <i class="fa fa-users text-red"></i> 5 new members joined
                          </a>
                      </li>
                      <li>
                          <a href="#">
                          <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                          </a>
                      </li>
                      <li>
                          <a href="#">
                          <i class="fa fa-user text-red"></i> You changed your username
                          </a>
                      </li>
                    </ul>
                  </li>
                  <li class="footer"><a href="#">View all</a></li>
                </ul>
            </li>
          <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <i class="fa fa-user"></i>
                  <span class="hidden-xs">{{ auth()->user()->name }}</span>
                </a>
                <ul class="dropdown-menu" style="width: 160px;">
                <!-- Cerrar Sesion-->
                <li class="user-footer" >
                    <div style="width: 95px;margin: auto;">
                        <form action="{{ route('logout')}}" method="POST">
                            {{ csrf_field() }}
                            <button class="btn btn-default btn-flat" type="submit">Cerrar Sesion</button>
                        </form>
                    </div>
                </li>
                </ul>
            </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">
          <center>
            <b>
              MENU
            </b>
          </center>
        </li>
        <li class="@if ( $name == 'inicio')
        active
        @endif">
          <a href="{{ route('inicio') }}">
            <i class="fa fa-th"></i> <span>Inicio</span>
          </a>
        </li>
        @if ( auth()->user()->tipo == 1)
          <li class="@if ( $name == 'taxista')
          active
          @endif">
            <a href="{{ route('taxista') }}">
              <i class="fa fa-male"></i> <span>Emprendedoras</span>
            </a>
          </li>
        @endif
        @if (auth()->user()->tipo == 1 || auth()->user()->tipo == 2)
          <li class="treeview @if ( $name == 'vehiculo')
          active menu-open 
          @endif">
            <a href="#">
              <i class="fa fa-laptop"></i>
              <span>Vehiculos</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="@if ( $subName == 'vehiculo')
              active
              @endif">
                <a href="{{ route('vehiculo') }}">
                  <i class="fa fa-circle-o"></i>Vehiculo
                </a>
              </li>
              <li class="@if ( $subName == 'revision')
              active
              @endif">
                <a href="{{ route('vehiculo') }}">
                  <i class="fa fa-circle-o"></i>Revisión Tecnica
                </a>
              </li>
              <li class="@if ( $subName == 'soat')
              active
              @endif">
                <a href="{{ route('vehiculo') }}">
                  <i class="fa fa-circle-o"></i>SOAT
                </a>
              </li>
              <li class="@if ( $subName == 'seguro')
              active
              @endif">
                <a href="{{ route('vehiculo') }}">
                  <i class="fa fa-circle-o"></i>Seguro contra Riesgo
                </a>
              </li>
            </ul>
            
          </li>  
        @endif
        @if (auth()->user()->tipo == 1 || auth()->user()->tipo == 2)
          <li class="@if ( $name == 'cliente')
          active
          @endif">
            <a href="{{ route('cliente') }}">
              <i class="fa fa-street-view"></i> <span>Cliente</span>
            </a>
          </li>
        @endif
        @if (auth()->user()->tipo == 1 || auth()->user()->tipo == 2)
          <li class="@if ( $name == 'dato')
          active
          @endif">
            <a href="{{ route('dato') }}">
              <i class="fa fa-folder-open"></i><span>Datos Extras</span>
            </a>
          </li>
        @endif
        @if (auth()->user()->tipo == 1 || auth()->user()->tipo == 2)
          <li class="@if ( $name == 'contacto')
          active
          @endif">
            <a href="{{ route('contacto') }}">
              <i class="fa fa-users"></i><span>Contactos</span>
            </a>
          </li>
        @endif
        @if (auth()->user()->tipo == 1)
          <li class="@if ( $name == 'servicio')
          active
          @endif">
            <a href="{{ route('servicio') }}">
              <i class="fa fa-calendar-check-o"></i><span>Servicios</span>
            </a>
          </li>
        @endif
        @if (auth()->user()->tipo == 1)
          <li class="@if ( $name == 'programacion')
          active
          @endif">
            <a href="{{ route('programacion') }}">
              <i class="fa fa-keyboard-o"></i><span>Programación</span>
            </a>
          </li>
        @endif
        <li class="@if ( $name == 'configuracion')
        active
        @endif">
          <a href="{{ route('configuracion') }}">
            <i class="fa fa fa-gears"></i> <span>Configuracion</span>
          </a>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        @yield('nombre-pagina-actual')
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ route('inicio')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        @yield('recorrido')
      </ol>
    </section>

    <section class="content">
      @yield('content')
    </section>
  </div>
</div>
<!-- ./wrapper -->
<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminlte/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
<script src="{{ asset('adminlte/bower_components/raphael/raphael.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/morris.js/morris.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
<!-- jvectormap -->
<script src="{{ asset('adminlte/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminlte/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminlte/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('adminlte/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
<!-- datepicker -->
<script src="{{ asset('adminlte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('adminlte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ asset('adminlte/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminlte/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminlte/js/pages/dashboard.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('adminlte/js/demo.js') }}"></script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
</script>
@yield('scriptAgregado')
</body>
</html>