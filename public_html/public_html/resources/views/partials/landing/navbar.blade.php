<nav class="navbar">
    <div class="container">
        <div class="logo">
            <a href="{{ route('public.index') }}">
                <img src="{{ asset('favicon.jpeg') }}" alt="OD SPORTS" style="max-height: 40px; filter: invert(1) hue-rotate(180deg); mix-blend-mode: screen;">
            </a>
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('public.index') }}#home">HOME</a></li>
            <li class="dropdown">
                <a href="javascript:void(0)">SERVICES <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('public.services.event-management') }}">Event Management</a></li>
                    <li><a href="{{ route('public.services.media-production') }}">Media Production</a></li>
                    <li><a href="{{ route('public.services.sports-marketing') }}">Sports Marketing</a></li>
                    <li><a href="{{ route('public.services.custom-printing') }}">Custom Printing</a></li>
                </ul>
            </li>
            <li><a href="/products">SHOP</a></li>
            <li><a href="{{ route('public.index') }}#portfolio">PORTFOLIO</a></li>
            <li><a href="{{ route('public.index') }}#about">ABOUT</a></li>
        </ul>
        <div class="nav-actions flex items-center gap-4">
            <form action="{{ route('public.products') }}" method="GET" class="relative flex items-center">
                <input name="q" type="search" class="bg-transparent border-b border-gray-600 focus:border-white outline-none text-sm px-1 py-1" placeholder="Search...">
                <button type="submit" class="ml-2 bg-transparent border-none p-0" style="background: none; border: none; box-shadow: none;"><i class="fas fa-search cursor-pointer text-white"></i></button>
            </form>
            
            <a href="{{ route('public.cart') }}" class="cart-icon relative">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count absolute -top-2 -right-2 bg-[#8ddf0d] text-black text-[10px] font-bold px-1 rounded-full min-w-[15px] h-[15px] flex items-center justify-center">{{ Cart::instance('cart')->count() }}</span>
            </a>

            <a href="{{ auth('customer')->check() ? route('customer.overview') : route('customer.login') }}" class="login-btn">
                <i class="fas fa-user"></i> {{ auth('customer')->check() ? __('Account') : __('Log In') }}
            </a>

            <div class="theme-toggle cursor-pointer" id="theme-toggle">
                <i class="fas fa-sun"></i>
            </div>
        </div>
    </div>
</nav>
