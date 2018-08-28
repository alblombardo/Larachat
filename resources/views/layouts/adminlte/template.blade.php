<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $page_title or env('APP_NAME', 'Laravel App') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ @asset('/css/app.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ @asset('/vendor/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ @asset('/vendor/Ionicons/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ @asset('/vendor/adminlte/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{ @asset('/vendor/adminlte/css/skins/skin-blue.min.css') }}">

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!-- Toastr -->
    <link rel="stylesheet" href="{{ @asset('/vendor/toastr/css/toastr.min.css') }}">

    <!-- Bootstrap Toggle -->
    <link rel="stylesheet" href="{{ @asset('/vendor/bootstrap-toggle/css/bootstrap-toggle.min.css') }}">

    @stack('styles')
    <link rel="stylesheet" href="{{ @asset('/css/custom.css') }}">
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini @if(session('collapseSidebar')) sidebar-collapse @endif">
<div class="wrapper">
    @include('components.toastr')
    <!-- Main Header -->
@include('layouts.adminlte.header')

<!-- Left side column. contains the logo and sidebar -->
@include('layouts.adminlte.main-sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $page_title or 'Page title'}}
                <small>{{ $page_description or '' }}</small>
            </h1>
            <ol class="breadcrumb hide">
                <li><a href="#"><i class="fa fa-dashboard"></i> Level</a></li>
                <li class="active">Here</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content container-fluid">

        @yield('content')
        <!-- Modal -->
            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content"></div>
                </div>
            </div>

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
@include('layouts.adminlte.footer')

<!-- Control Sidebar -->
@include('layouts.adminlte.control-sidebar')
<!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<!-- Bootstrap 3.3.7 -->
<script src="{{ @asset('/js/app.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ @asset('/vendor/adminlte/js/adminlte.min.js') }}"></script>
<!-- Toastr -->
<script src="{{ @asset('/vendor/toastr/js/toastr.min.js') }}"></script>
<!-- Bootstrap Toggle -->
<script src="{{ @asset('/vendor/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
<!-- Custom
<script src="{{ @asset('/js/custom.js') }}"></script>
-->
<script>
    toastr.options.progressBar = true;
    toastr.options.closeButton = true;
</script>
<script>
    $('#sidebarToggle').on('click', function (e) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: '{{ route('toggleSidebar') }}',
            success: function( data ) {
                //console.log(data)
            }
        });
    });
</script>

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->
@stack('scripts')
</body>
</html>