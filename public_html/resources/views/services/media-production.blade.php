@extends('layouts.landing')

@section('title', theme_option('media_page_title', 'Sports Media Production - OD Sports'))

@section('content')

    @php
        $heroBg = theme_option('media_hero_bg', 'https://images.unsplash.com/photo-1471341971476-ae15ff5dd4ea?auto=format&fit=crop&w=2000&q=80');
        if (str_starts_with($heroBg, 'http://') || str_starts_with($heroBg, 'https://')) { $heroBgUrl = $heroBg; }
        elseif (file_exists(public_path($heroBg))) { $heroBgUrl = asset($heroBg); }
        else { $heroBgUrl = RvMedia::getImageUrl($heroBg); }
        $impactBg = theme_option('media_impact_bg', 'https://images.unsplash.com/photo-1533560904424-a0c61dc306fc?auto=format&fit=crop&w=2000&q=80');
        if (str_starts_with($impactBg, 'http://') || str_starts_with($impactBg, 'https://')) { $impactBgUrl = $impactBg; }
        elseif (file_exists(public_path($impactBg))) { $impactBgUrl = asset($impactBg); }
        else { $impactBgUrl = RvMedia::getImageUrl($impactBg); }
    @endphp
    <header class="em-hero" style="background-image: url('{{ $heroBgUrl }}'); background-size: cover; background-position: center;">
        <div class="em-container">
            <div class="em-hero-content">
                <span class="em-hero-subtitle">{!! theme_option('media_hero_subtitle', 'SPORTS MEDIA PRODUCTION') !!}</span>
                <h1 class="em-hero-title">{!! theme_option('media_hero_title_1', 'Sports Media Production') !!} <br>{!! theme_option('media_hero_title_2', 'That Drives Real Reach') !!}</h1>
            </div>
        </div>
    </header>

    <section class="em-statement">
        <div class="em-container">
            <p>{!! theme_option('media_statement', 'At OD Sports, every moment is turned into content that performs. From large-scale race-day coverage to brand-led activations, we deliver professional sports media production — photography, video, live streaming, and short-form content — that brings your event to life and keeps audiences coming back.') !!}</p>
        </div>
    </section>

    <section class="em-capabilities-new">
        <div class="em-container">
            <div class="section-header-center">
                <h2><span class="em-text-blue">{!! theme_option('media_cap_section_title_1', 'WHAT WE') !!}</span> <span class="em-text-neon">{!! theme_option('media_cap_section_title_2', 'PRODUCE') !!}</span></h2>
            </div>
            <div class="capabilities-grid">
                @for($i = 1; $i <= 7; $i++)
                <div class="cap-card">
                    <h3>{!! theme_option('media_cap_' . $i . '_title') !!}</h3>
                    <p>{!! theme_option('media_cap_' . $i . '_desc') !!}</p>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <section class="em-impact" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('{{ $impactBgUrl }}'); background-size: cover; background-position: center;">
        <div class="em-container">
            <div class="impact-content">
                <h2><span class="em-text-blue">{!! theme_option('media_impact_title_1', 'PROVEN') !!}</span> <span class="em-text-neon">{!! theme_option('media_impact_title_2', 'RESULTS') !!}</span></h2>
                <p>{!! theme_option('media_impact_desc', 'Our live coverage of the Islamabad Marathon generated 381,000+ live stream views and 18.6 million total video views. We produced the full documentary for the YourPace by inDrive initiative. For the Twin City Run, we delivered 700K+ video views through a coordinated content campaign.') !!}</p>
            </div>
        </div>
    </section>

    <section class="em-lifecycle-new">
        <div class="em-container">
            <div class="section-header-center">
                <h2><span class="em-text-neon">{!! theme_option('media_lc_section_title_1', 'WHO IS THIS') !!}</span> <span class="em-text-blue">{!! theme_option('media_lc_section_title_2', 'FOR?') !!}</span></h2>
            </div>
            <div class="lifecycle-list">
                @for($i = 1; $i <= 5; $i++)
                <div class="lifecycle-item">
                    <i class="fas fa-video"></i>
                    <span>{!! theme_option('media_lifecycle_' . $i) !!}</span>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <section class="em-command">
        <div class="em-container">
            <h2><span class="em-text-blue">{!! theme_option('media_cta_title_1', 'READY FOR') !!}</span> <br><span class="em-text-neon">{!! theme_option('media_cta_title_2', 'YOUR CLOSE-UP?') !!}</span></h2>
            <a href="{{ route('public.index') }}#contact" class="em-command-btn">{!! theme_option('media_cta_btn', 'Book a Meeting') !!}</a>
        </div>
    </section>

    <style>
        .em-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .em-hero { height: 60vh; background-size: cover; background-position: center; display: flex; align-items: center; position: relative; padding-top: 100px; }
        .em-hero::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); }
        .em-hero-content { position: relative; z-index: 1; }
        .em-hero-subtitle { color: var(--accent-color); font-weight: 800; letter-spacing: 2px; text-transform: uppercase; }
        .em-hero-title { font-size: 2.8rem; color: #fff; line-height: 1.2; margin-top: 10px; text-transform: uppercase; }
        .em-text-blue { color: var(--primary-color); }
        .em-text-neon { color: var(--accent-color); }
        
        .em-statement { padding: 80px 0; background: #111; text-align: center; }
        .em-statement p { font-size: 1.5rem; color: #eee; line-height: 1.6; max-width: 900px; margin: 0 auto; }
        
        .section-header-center { text-align: center; margin-bottom: 50px; }
        .section-header-center h2 { font-size: 2.5rem; text-transform: uppercase; }
        
        .em-capabilities-new { padding: 100px 0; background: #181818; }
        .capabilities-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; }
        .cap-card { background: #222; padding: 30px; border-radius: 12px; border-left: 4px solid var(--accent-color); transition: transform 0.3s; }
        .cap-card:hover { transform: translateY(-10px); }
        .cap-card h3 { color: var(--accent-color); margin-bottom: 15px; font-size: 1.2rem; }
        .cap-card p { color: #ccc; font-size: 0.95rem; line-height: 1.6; }
        
        .em-impact { padding: 100px 0; background-size: cover; background-position: center; text-align: center; }
        .impact-content { max-width: 800px; margin: 0 auto; }
        .impact-content h2 { font-size: 3rem; margin-bottom: 30px; }
        .impact-content p { font-size: 1.3rem; color: #fff; line-height: 1.7; }
        
        .em-lifecycle-new { padding: 100px 0; background: #111; }
        .lifecycle-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; max-width: 900px; margin: 0 auto; }
        .lifecycle-item { display: flex; align-items: center; gap: 15px; background: #1a1a1a; padding: 20px; border-radius: 8px; border-left: 3px solid var(--accent-color); }
        .lifecycle-item i { color: var(--accent-color); font-size: 1.2rem; }
        .lifecycle-item span { color: #fff; font-weight: 600; }
        
        .em-command { padding: 100px 0; background: #000; text-align: center; }
        .em-command h2 { font-size: 3rem; margin-bottom: 40px; }
        .em-command-btn { display: inline-block; background: var(--primary-color); color: #fff; padding: 15px 40px; border-radius: 50px; text-decoration: none; font-weight: 800; text-transform: uppercase; transition: 0.3s; }
        .em-command-btn:hover { background: var(--accent-color); color: #000; }
        
        @media (max-width: 768px) {
            .lifecycle-list { grid-template-columns: 1fr; }
            .em-hero-title { font-size: 2rem; }
            .em-statement p { font-size: 1.2rem; }
        }
    </style>

@endsection
