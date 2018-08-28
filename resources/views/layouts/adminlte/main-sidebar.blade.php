<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ @asset('/images/logo_160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::User()->fullname }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form hide">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header hide">HEADER</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="@if(Request::is('admin')) active @endif"><a href="#"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
            @can('list',App\User::class)<li class="@if(Request::is('users')) active @endif"><a href="{{ route('users::index') }}"><i class="fa fa-users"></i> <span>Account</span></a></li>@endcan
            <li class="treeview hide">
                <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span>
                    <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>