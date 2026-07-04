<div class="top-menu">
    <ul class="nav navbar-nav float-end">
        @auth
            @if (BaseHelper::getAdminPrefix() != '')
                <li class="dropdown">
                    <a class="dropdown-toggle dropdown-header-name pe-2" href="{{ route('public.index') }}" target="_blank">
                        <i class="fa fa-globe"></i>
                        <span class="d-none d-sm-inline">
                            {{ trans('core/base::layouts.view_website') }}
                        </span>
                    </a>
                </li>
            @endif
            {{-- Notification and message icons removed --}}

            @if (isset($themes) && is_array($themes) && count($themes) > 1 && setting('enable_change_admin_theme'))
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle dropdown-header-name" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="d-inline d-sm-none"><i class="fas fa-palette"></i></span>
                        <span class="d-none d-sm-inline">{{ trans('core/base::layouts.theme') }}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right icons-right">

                        @foreach ($themes as $name => $file)
                            @if ($activeTheme === $name)
                                <li class="active"><a href="{{ route('admin.theme', [$name]) }}">{{ Str::studly($name) }}</a></li>
                            @else
                                <li><a href="{{ route('admin.theme', [$name]) }}">{{ Str::studly($name) }}</a></li>
                            @endif
                        @endforeach

                    </ul>
                </li>
            @endif

            <li class="dropdown dropdown-user">
                <a href="javascript:void(0)" class="dropdown-toggle dropdown-header-name" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img alt="{{ Auth::user()->name }}" class="rounded-circle" src="{{ url('od-sports-admin-logo.png') }}" style="height: 32px; width: 32px; object-fit: cover; border: 1px solid #e2e8f0;" />
                    <span class="username d-none d-sm-inline"> {{ Auth::user()->name }} </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('admin.do.logout') }}" class="btn-logout"><i class="icon-key"></i> {{ trans('core/base::layouts.logout') }}</a></li>
                </ul>
            </li>
        @endauth
    </ul>
</div>
<div id="sidebar-notification-backdrop"></div>
