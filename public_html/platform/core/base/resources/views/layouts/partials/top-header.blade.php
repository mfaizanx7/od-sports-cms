<div class="page-header navbar navbar-static-top">
    <div class="page-header-inner">

            <div class="page-logo" style="display: flex; align-items: center; justify-content: space-between; padding: 0 20px;">
                <a href="{{ route('dashboard.index') }}" style="text-decoration: none; display: flex; align-items: center;">
                    <img src="{{ url('od-sports-admin-logo.png') }}" alt="OD Sports" style="height: 35px;" />
                </a>

                @auth
                    <div class="menu-toggler sidebar-toggler" style="margin: 0; position: relative;">
                        <span></span>
                    </div>
                @endauth
            </div>

            @auth
                <a href="javascript:" class="menu-toggler responsive-toggler" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                    <span></span>
                </a>
            @endauth

            @include('core/base::layouts.partials.top-menu')
        </div>
</div>
