<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Medialogic Apps - {{ env('APP_NAME')}} | Reimposta la password</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ @asset('/css/app.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ @asset('/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ @asset('/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ @asset('/vendor/adminlte/css/AdminLTE.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ @asset('/vendor/adminlte/plugins/iCheck/square/blue.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ @asset('/css/custom.css') }}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo pull-left">
    </div>
    <span class="pull-right login-text">{{ env('APP_NAME') }} </span>
    <div class="clearfix"></div>
    <!-- /.login-logo -->
    <div class="login-box-body" style="position:relative">
        <a href="{{ route('admin::dashboard') }}"><img src="{{ asset('/images/logo.jpg') }}" style="height: 50px;position:absolute;top:0;left:0"></a>
        <p class="login-box-msg" style="margin-top:50px">Fornisci l'indirizzo email associato al tuo account e scegli una nuova password.</p>
        <form action="{{ route('password.request') }}" method="post">
            {{ csrf_field() }}
            <input type="hidden" name="token" value="{{ $token or old('token') }}">
            <div class="form-group has-feedback">
                <input name="email" type="text" class="form-control" value="{{ $email or old('email') }}" placeholder="mario.rossi@email.com">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password_confirmation" class="form-control" placeholder="conferma la password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <!-- /.col -->
                <div class="col-xs-4 form-group col-xs-offset-8">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Invia</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        @include('components.s-message')
    </div>
    <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="{{ @asset('/js/app.js') }}"></script>

<!-- iCheck -->
<script src="{{ @asset('/vendor/adminlte/plugins/iCheck/icheck.min.js') }}"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>
