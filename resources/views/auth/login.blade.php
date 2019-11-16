<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name') }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <link rel="icon" type="image/png" href="{{ asset('img/taxi_logo.png') }}" />
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('adminlte/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('adminlte/css/AdminLTE.min.css') }}">
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page" style="background-image: url({{ asset('img/fondo3.jpeg') }});background-size: cover;">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="login-box-body" style="background: #ffffff99;">
    <div class="login-logo">
      <img src="{{ asset('img/taxi_logo.png') }}" style="width: 25vh;" alt="">
      <h1>{{ config('app.name') }}</h1>
    </div>
    <form action="{{ route('login') }}" method="POST">
        {{ csrf_field() }}
      <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error':'' }}">
        <input type="email" name="email" value="{{ old('email') }}" class="form-control input-login" placeholder="Correo">
        <span class="glyphicon glyphicon-envelope form-control-feedback icono-login"></span>
        {!! $errors->first('email','<p class="text-red">:message</p>') !!}
      </div>
      <div class="form-group has-feedback  {{ $errors->has('password') ? 'has-error':'' }}">
        <input type="password" name="password" class="form-control input-login" placeholder="Contraseña">
        <span class="glyphicon glyphicon-lock form-control-feedback icono-login"></span>
        {!! $errors->first('password','<p class="text-red">:message</p>') !!}
      </div>
      <div class="row" style="justify-content: center;display: flex;">
        <!-- /.col -->
        <div>
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('adminlte/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
