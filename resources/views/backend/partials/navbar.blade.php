<header class="main-header">
    <!-- Logo -->
    <a class="logo" href="#">
        <span class="logo-mini"><b>C</b></span>
        <span class="logo-lg"><b>{{ settings('app_name') }}</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">@lang('app.toggle_navigation')</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                @if (session()->exists('beforeUser'))
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-repeat text-aqua"></i></a>
                    <ul class="dropdown-menu">
                        <li class="header"><b>{{ auth()->user()->username }}</b></li>
                        <li>
                            <ul class="menu">
                                <li><a href="{{ route('backend.user.back_login') }}"> Back Login</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endif
                @php
                    $open_shift = \VanguardLTE\OpenShift::where(['shop_id' => auth()->user()->shop_id, 'end_date' => NULL])->first();
                @endphp
                <li class="dropdown tasks-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-off text-aqua"></i></a>
                    <ul class="dropdown-menu">
                        <li class="header"><b>{{ auth()->user()->username }}</b></li>
                        <li>
                            <ul class="menu">
                                <li><a href="{{ route('backend.auth.logout') }}"> @lang('app.logout')</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
<!-- Left side column. contains the logo and sidebar -->
