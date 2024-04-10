<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            @permission('dashboard')
            <li class="{{ Request::is('backend') ? 'active' : ''  }}">
                <a href="{{ route('backend.dashboard') }}">
                    <i class="fa fa-home"></i>
                    <span>@lang('app.dashboard')</span>
                </a>
            </li>
            @endpermission

            @permission('users.manage')
            <li class="{{ Request::is('backend/user*') ? 'active' : ''  }}">
                <a href="{{ route('backend.user.list') }}">	
                    <i class="fa fa-user"></i>
                    <span>@lang('app.users')</span>
                </a>
            </li>
            @endpermission

            <li class="{{ Request::is('backend/money_stat*') ? 'active' : ''  }}">
                <a href="{{ route('backend.money_stat') }}">
                    <i class="fa fa-money"></i>
                    <span>Финансовая статистика</span>
                </a>
            </li>

            @permission('shops.manage')
            <li class="{{ Request::is('backend/shops*') ? 'active' : ''  }}">
                <a href="{{ route('backend.shop.list') }}">
                    <i class="fa fa-bank"></i>
                    <span>@lang('app.shops')</span>
                </a>
            </li>
            @endpermission

            <li class="{{ (Request::is('backend/game') || Request::is('backend/game/*')) ? 'active' : ''  }}">
                <a href="{{ route('backend.game.list') }}">
                    <i class="fa fa-gamepad"></i>
                    <span>@lang('app.games')</span>
                </a>
            </li>

            @if (
                auth()->user()->hasPermission('stats.pay') ||
                auth()->user()->hasPermission('stats.game') ||
                auth()->user()->hasPermission('stats.shift')
            )
            <li class="treeview {{ Request::is('backend/transactions*') || Request::is('backend/game_stat*') || Request::is('backend/shift_stat') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-area-chart"></i>
                    <span>Статистика</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class=" treeview-menu" id="stats-dropdown">
                    @permission('stats.game')
                    <li class="{{ Request::is('backend/game_stat') ? 'active' : ''  }}">
                        <a  href="{{ route('backend.game_stat') }}">
                            <i class="fa fa-circle-o"></i>
                            @lang('app.game_stats')
                        </a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endif

            @if (
                auth()->user()->hasPermission('activity.system') ||
                auth()->user()->hasPermission('activity.user')
            )
            <li class="treeview {{ Request::is('backend/activity*') ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-bar-chart"></i>
                    <span>@lang('app.activity_log')</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class=" treeview-menu" id="stats-dropdown">
                    <li class="{{ Request::is('backend/activity') ? 'active' : ''  }}">
                        <a href="{{ route('backend.activity.index') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>@lang('app.all')</span>
                        </a>
                    </li>
                    @permission('activity.system')
                    <li class="{{ Request::is('backend/activity/system') ? 'active' : ''  }}">
                        <a href="{{ route('backend.activity.system', 'system') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>@lang('app.system_data')</span>
                        </a>
                    </li>
                    @endpermission
                    @permission('activity.user')
                    <li class="{{ Request::is('backend/activity/user') ? 'active' : ''  }}">
                        <a href="{{ route('backend.activity.user', 'user') }}">
                            <i class="fa fa-circle-o"></i>
                            <span>@lang('app.user_data')</span>
                        </a>
                    </li>
                    @endpermission
                </ul>
            </li>
            @endif
            
        </ul>
    </section>
</aside>
