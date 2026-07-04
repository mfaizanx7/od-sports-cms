@extends('layouts.landing')

@section('title', theme_option('printing_page_title', 'Custom Printing & Sports Merchandise - OD Sports'))

@section('content')

    <header class="em-hero" style="background-image: url('{!! theme_option('printing_hero_bg', 'https://images.unsplash.com/photo-1556906781-9a412961c28c?auto=format&fit=crop&w=2000&q=80') !!}');">
        <div class="em-container">
            <div class="em-hero-content">
                <span class="em-hero-subtitle">{!! theme_option('printing_hero_subtitle', 'SERVICE 05 — CUSTOM PRINTING & SPORTS MERCHANDISE') !!}</span>
                <h1 class="em-hero-title">{!! theme_option('printing_hero_title_1', 'Look the Part.') !!} <br>{!! theme_option('printing_hero_title_2', 'Play the Part.') !!}</h1>
            </div>
        </div>
        
    </header>

    <section class="em-statement">
        <div class="em-container">
            <p>{!! theme_option('printing_statement', 'OD Sports handles high-quality custom printing and merchandise for sports teams, events, and clubs across Pakistan. From jerseys and training kits to banners, flags, and fan gear — every item is designed and produced to look professional and represent your brand with pride.') !!}</p>
        </div>
    </section>

    <section class="em-capabilities-new">
        <div class="em-container">
            <div class="section-header-center">
                <h2><span class="em-text-blue">{!! theme_option('printing_cap_section_title_1', 'WHAT WE') !!}</span> <span class="em-text-neon">{!! theme_option('printing_cap_section_title_2', 'PRODUCE') !!}</span></h2>
            </div>
            <div class="capabilities-grid">
                @for($i = 1; $i <= 4; $i++)
                <div class="cap-card">
                    <h3>{!! theme_option('printing_cap_' . $i . '_title') !!}</h3>
                    <p>{!! theme_option('printing_cap_' . $i . '_desc') !!}</p>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <section class="em-lifecycle-new">
        <div class="em-container">
            <div class="section-header-center">
                <h2><span class="em-text-neon">{!! theme_option('printing_lc_section_title_1', 'WHO IS THIS') !!}</span> <span class="em-text-blue">{!! theme_option('printing_lc_section_title_2', 'FOR?') !!}</span></h2>
            </div>
            <div class="lifecycle-list">
                @for($i = 1; $i <= 5; $i++)
                <div class="lifecycle-item">
                    <i class="fas fa-check-circle"></i>
                    <span>{!! theme_option('printing_lifecycle_' . $i) !!}</span>
                </div>
                @endfor
            </div>
        </div>
    </section>

    <section class="em-command">
        <div class="em-container">
            <h2><span class="em-text-blue">{!! theme_option('printing_cta_title_1', 'READY TO') !!}</span> <br><span class="em-text-neon">{!! theme_option('printing_cta_title_2', 'GEAR UP?') !!}</span></h2>
            <a href="{{ route('public.index') }}#contact" class="em-command-btn">{!! theme_option('printing_cta_btn', 'Contact Us') !!}</a>
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
        .cap-card { background: #222; padding: 30px; border-radius: 12px; border-left: 4px solid var(--primary-color); transition: transform 0.3s; }
        .cap-card:hover { transform: translateY(-10px); }
        .cap-card h3 { color: var(--accent-color); margin-bottom: 15px; font-size: 1.2rem; }
        .cap-card p { color: #ccc; font-size: 0.95rem; line-height: 1.6; }
        
        .em-lifecycle-new { padding: 100px 0; background: #111; }
        .lifecycle-list { display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; max-width: 900px; margin: 0 auto; }
        .lifecycle-item { display: flex; align-items: center; gap: 15px; background: #1a1a1a; padding: 20px; border-radius: 8px; }
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
