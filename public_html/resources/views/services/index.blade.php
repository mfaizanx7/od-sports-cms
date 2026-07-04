@extends('layouts.landing')

@section('title', theme_option('services_index_page_title', 'Our Services - OD Sports'))

@section('content')

    @php
        $svcHero = theme_option('services_index_hero_img', 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=2000&q=80');
        if (str_starts_with($svcHero, 'http://') || str_starts_with($svcHero, 'https://')) { $svcHeroUrl = $svcHero; }
        elseif (file_exists(public_path($svcHero))) { $svcHeroUrl = asset($svcHero); }
        else { $svcHeroUrl = RvMedia::getImageUrl($svcHero); }
    @endphp
    <header class="em-hero" style="background-image: url('{{ $svcHeroUrl }}'); background-size: cover; background-position: center;">
        <div class="em-container">
            <div class="em-hero-content">
                <h1 class="em-hero-title" style="font-size: 38px; line-height: 1.3; font-weight: 800;">{!! theme_option('services_index_hero_title', 'Full-Service Sports Solutions <br>From Ideation to Execution') !!}</h1>
                <p style="color: rgba(255,255,255,0.75); font-size: 15px; max-width: 600px; line-height: 1.7; margin-top: 14px;">{!! theme_option('services_index_hero_subtitle', 'Every service we offer is built for the sports world. We understand the game, the culture, and what it takes to deliver results on the ground and online.') !!}</p>
            </div>
        </div>
    </header>

    <section style="padding: 80px 20px; background: #0a0a0a;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <div style="text-align: center; margin-bottom: 60px;">
                <h2 class="services-section-title" style="font-size: 36px; font-weight: 800; color: #8ddf0d;">{!! theme_option('services_index_section_title', 'END-TO-END SOLUTIONS') !!}</h2>
                <p style="color: #94a3b8; font-size: 16px; max-width: 600px; margin: 15px auto 0;">{!! theme_option('services_index_section_subtitle', 'From event management to influencer marketing — we deliver complete sports solutions across Pakistan.') !!}</p>
            </div>

            <div class="services-cards-grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(340px, 1fr)); gap: 24px;">

                <a href="{{ route('public.services.event-management') }}" style="text-decoration: none; background: linear-gradient(135deg, rgba(16,185,129,0.1), rgba(5,150,105,0.05)); border: 1px solid rgba(16,185,129,0.2); border-radius: 16px; padding: 32px; transition: all 0.3s ease; display: block;">
                    <div style="font-size: 32px; margin-bottom: 16px;">{!! theme_option('services_index_service1_icon', '🏃') !!}</div>
                    <h3 style="color: #8ddf0d; font-size: 20px; font-weight: 700; margin-bottom: 8px;">{!! theme_option('services_index_service1_title', 'Event Management') !!}</h3>
                    <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('services_index_service1_desc', 'End-to-end sports event management — from strategy and logistics to on-ground execution and post-event analysis.') !!}</p>
                </a>

                <a href="{{ route('public.services.media-production') }}" style="text-decoration: none; background: linear-gradient(135deg, rgba(139,92,246,0.1), rgba(109,40,217,0.05)); border: 1px solid rgba(139,92,246,0.2); border-radius: 16px; padding: 32px; transition: all 0.3s ease; display: block;">
                    <div style="font-size: 32px; margin-bottom: 16px;">{!! theme_option('services_index_service2_icon', '🎬') !!}</div>
                    <h3 style="color: #8ddf0d; font-size: 20px; font-weight: 700; margin-bottom: 8px;">{!! theme_option('services_index_service2_title', 'Media Production') !!}</h3>
                    <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('services_index_service2_desc', 'Professional photography, videography, and content production for sports events, brands, and athletes.') !!}</p>
                </a>

                <a href="{{ route('public.services.sports-marketing') }}" style="text-decoration: none; background: linear-gradient(135deg, rgba(245,158,11,0.1), rgba(217,119,6,0.05)); border: 1px solid rgba(245,158,11,0.2); border-radius: 16px; padding: 32px; transition: all 0.3s ease; display: block;">
                    <div style="font-size: 32px; margin-bottom: 16px;">{!! theme_option('services_index_service3_icon', '📢') !!}</div>
                    <h3 style="color: #8ddf0d; font-size: 20px; font-weight: 700; margin-bottom: 8px;">{!! theme_option('services_index_service3_title', 'Sports Marketing') !!}</h3>
                    <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('services_index_service3_desc', 'Strategic sports marketing campaigns that drive engagement, build brands, and deliver measurable results.') !!}</p>
                </a>

                <a href="{{ route('public.services.campaign-design') }}" style="text-decoration: none; background: linear-gradient(135deg, rgba(14,165,233,0.1), rgba(3,105,161,0.05)); border: 1px solid rgba(14,165,233,0.2); border-radius: 16px; padding: 32px; transition: all 0.3s ease; display: block;">
                    <div style="font-size: 32px; margin-bottom: 16px;">{!! theme_option('services_index_service4_icon', '🎨') !!}</div>
                    <h3 style="color: #8ddf0d; font-size: 20px; font-weight: 700; margin-bottom: 8px;">{!! theme_option('services_index_service4_title', 'Campaign Design') !!}</h3>
                    <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('services_index_service4_desc', 'Creative campaign design and visual identity for sports brands, events, and digital platforms.') !!}</p>
                </a>

                <a href="{{ route('public.services.influencer-marketing') }}" style="text-decoration: none; background: linear-gradient(135deg, rgba(249,115,22,0.1), rgba(194,65,12,0.05)); border: 1px solid rgba(249,115,22,0.2); border-radius: 16px; padding: 32px; transition: all 0.3s ease; display: block;">
                    <div style="font-size: 32px; margin-bottom: 16px;">{!! theme_option('services_index_service6_icon', '⭐') !!}</div>
                    <h3 style="color: #8ddf0d; font-size: 20px; font-weight: 700; margin-bottom: 8px;">{!! theme_option('services_index_service6_title', 'Influencer Marketing') !!}</h3>
                    <p style="color: #94a3b8; font-size: 14px; line-height: 1.6;">{!! theme_option('services_index_service6_desc', 'Athlete partnerships and influencer marketing strategies that connect brands with sports audiences.') !!}</p>
                </a>

            </div>
        </div>
    </section>

@endsection
