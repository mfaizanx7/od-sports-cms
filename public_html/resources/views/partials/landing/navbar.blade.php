<nav class="navbar">
    <div class="container">
            <div class="logo">
                <a href="{{ route('public.index') }}">
                    <img src="{{ asset(theme_option('global_site_logo', 'favicon.jpeg')) }}" alt="OD SPORTS">
                </a>
            </div>
        <ul class="nav-links">
            <li><a href="{{ route('public.about') }}">{!! theme_option('global_nav_about', 'ABOUT') !!}</a></li>
            <li class="dropdown">
                <a href="{{ route('public.services.index') }}">{!! theme_option('global_nav_services', 'SERVICES') !!} <i class="fas fa-chevron-down" style="font-size: 0.7rem; margin-left: 5px;"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ route('public.services.event-management') }}">Event Management</a></li>
                    <li><a href="{{ route('public.services.media-production') }}">Media Production</a></li>
                    <li><a href="{{ route('public.services.sports-marketing') }}">Sports Marketing</a></li>
                    <li><a href="{{ route('public.services.campaign-design') }}">Campaign Design</a></li>

                    <li><a href="{{ route('public.services.influencer-marketing') }}">Influencer Marketing</a></li>
                </ul>
            </li>
            <li><a href="{{ route('public.portfolio') }}">{!! theme_option('global_nav_portfolio', 'PORTFOLIO') !!}</a></li>
            <li><a href="{{ route('public.blog') }}">{!! theme_option('global_nav_blog', 'BLOGS') !!}</a></li>
        </ul>
        <div class="nav-actions flex items-center gap-4">
            @php
                $navCtaLink = theme_option('global_navbar_cta_link', '');
                if (empty($navCtaLink) || $navCtaLink === '#contact' || $navCtaLink === '#') {
                    $navCtaLink = route('public.index') . '#contact';
                }
            @endphp
            <a href="{{ $navCtaLink }}" class="primary-btn" style="padding: 10px 15px; font-size: 0.75rem; text-decoration: none; border-radius: 5px;">{!! theme_option('global_navbar_cta_text', 'BOOK A MEETING') !!}</a>
            
        </div>
        <button class="mobile-menu-toggle" aria-label="Toggle menu">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</nav>
