<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Medialogic Apps - {{ env('APP_NAME')}} | Log in</title>
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
        <h2>LaraChat</h2>
        <p class="login-box-msg" style="margin-top:50px">Accedi per avviare la sessione.</p>
        <form action="{{ route('login') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
                <input name="email" type="text" class="form-control" placeholder="mario.rossi@email.com">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input type="password" name="password" class="form-control" placeholder="password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                    <div class="checkbox icheck">
                        <label>
                            <input type="checkbox"> @lang('auth.remember_me')
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Accedi</button>
                </div>
                <!-- /.col -->
                <div class="col-xs-12">
                    <p><small><a href="{{ route('password.request') }}">Recupera la password</a></small></p>
                </div>
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
