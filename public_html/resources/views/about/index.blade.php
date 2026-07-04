@extends('layouts.landing')

@section('title', theme_option('about_page_title', 'About Us - OD Sports'))

@section('content')
@php
    $resolve = function($val, $default = '') {
        $v = ($val ?: $default);
        if (!$v) return '';
        if (str_starts_with($v, 'http://') || str_starts_with($v, 'https://')) return $v;
        if (file_exists(public_path($v))) return asset($v);
        return RvMedia::getImageUrl($v);
    };
    $aboutHeroBgUrl  = $resolve(theme_option('about_hero_bg'),  'https://images.unsplash.com/photo-1526676037777-05a232554f77?auto=format&fit=crop&w=2000&q=80');
    $aboutStoryImgUrl = $resolve(theme_option('about_story_img'), 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=1200');
    $aboutCtaBgUrl   = $resolve(theme_option('about_cta_bg'),   'https://images.unsplash.com/photo-1549421263-5ec9631fcce8?auto=format&fit=crop&q=80&w=2000');
    $aboutTeamImgUrls = [];
    for ($ti = 1; $ti <= 15; $ti++) {
        $aboutTeamImgUrls[$ti] = $resolve(theme_option('about_team_'.$ti.'_img'), 'https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?auto=format&fit=crop&q=80&w=300');
    }
@endphp

    <header class="em-hero" style="background-image: url('{{ $aboutHeroBgUrl }}');">
        <div class="em-container">
            <div class="em-hero-content">
                <h1 class="em-hero-title"><span class="em-text-neon">{!! theme_option('about_hero_title_1', 'PAKISTAN\'S LEADING') !!}</span> <br><span class="em-text-neon">{!! theme_option('about_hero_title_2', 'SPORTS AGENCY') !!}</span></h1>
                <p class="mt-4 text-xl opacity-90 max-w-2xl">{!! theme_option('about_hero_desc', 'OD Sports was built with one purpose: to be the sports agency that Pakistan\'s events, clubs, brands, and athletes can truly rely on.') !!}</p>
            </div>
        </div>
    </header>

    <section class="em-statement" style="padding: 120px 0;">
        <div class="em-container">
            <div class="about-story-grid" style="display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: start;">
                <div>
                    <h2 style="font-size: 3rem; margin-bottom: 30px; color: var(--accent-color) !important;">{!! theme_option('about_story_title', 'From Marathons to Movements') !!}</h2>
                    <p style="font-size: 1.15rem; line-height: 1.8; color: rgba(255,255,255,0.8); margin-bottom: 25px;">
                        {!! theme_option('about_story_p1', 'OD Sports started as a response to a clear gap in Pakistan\'s sports ecosystem. Events were happening, communities were growing, athletes were achieving — but the storytelling, the strategy, and the execution weren\'t keeping up.') !!}
                    </p>
                    <p style="font-size: 1.15rem; line-height: 1.8; color: rgba(255,255,255,0.8); margin-bottom: 25px;">
                        {!! theme_option('about_story_p2', 'We set out to change that.') !!}
                    </p>
                    <p style="font-size: 1.15rem; line-height: 1.8; color: rgba(255,255,255,0.8); margin-bottom: 25px;">
                        {!! theme_option('about_story_p3', 'As part of Optimize Digital, we launched OD Sports to bring full agency expertise — digital strategy, creative production, media, and on-ground execution — to Pakistan\'s growing sports world. We started with running events in Islamabad and quickly became the trusted partner behind some of Pakistan\'s biggest sporting moments.') !!}
                    </p>
                    <p style="font-size: 1.15rem; line-height: 1.8; color: rgba(255,255,255,0.8); margin-bottom: 25px;">
                        {!! theme_option('about_story_p4', 'From the Islamabad Marathon and Margalla Trail Runners to YourPace by inDrive, the Lahore Marathon, the Twin City Run, and Shehroze Kashif\'s historic 14×8000er project — we have delivered for every type of sports initiative, at every scale.') !!}
                    </p>
                    <p style="font-size: 1.15rem; line-height: 1.8; color: rgba(255,255,255,0.8);">
                        {!! theme_option('about_story_p5', 'Today, OD Sports is Pakistan\'s leading sports agency — and we\'re just getting started.') !!}
                    </p>
                </div>
                <div style="position: relative;">
                    <img src="{{ $aboutStoryImgUrl }}" alt="{!! theme_option('about_story_img_alt', 'Marathon Growth') !!}" style="width: 100%; border-radius: 20px; box-shadow: 0 30px 60px rgba(0,0,0,0.5);">
                    <div class="about-stat-badge" style="position: absolute; bottom: -30px; right: -30px; background: var(--accent-color); padding: 30px; border-radius: 15px; color: #0056ff; font-weight: 800; max-width: 250px;">
                        <span style="font-size: 3rem; display: block; line-height: 1;">{!! theme_option('about_growth_stat', '1,100%') !!}</span>
                        <span style="text-transform: uppercase; font-size: 0.9rem; letter-spacing: 1px;">{!! theme_option('about_growth_label', 'Growth in Participation') !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .em-container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
        .em-lifecycle { padding: 100px 0; }
        .em-lifecycle-header { text-align: center; margin-bottom: 50px; }
        .em-lifecycle-header h2 { font-size: 2.5rem; text-transform: uppercase; color: #fff; }
        .em-lifecycle-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 30px; }
        .em-phase-card { background: #1a1a1a; padding: 30px; border-radius: 12px; border-left: 4px solid var(--accent-color); }
        .em-phase-card p { color: rgba(255,255,255,0.85); line-height: 1.7; font-size: 1rem; }
        .em-text-blue { color: var(--primary-color); }
        .em-text-neon { color: var(--accent-color); }
        .em-hero { min-height: 60vh; background-size: cover; background-position: center; display: flex; align-items: center; position: relative; padding-top: 120px; padding-bottom: 80px; }
        .em-hero::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); }
        .em-hero-content { position: relative; z-index: 1; }
        .em-hero-subtitle { color: var(--accent-color); font-weight: 800; letter-spacing: 2px; text-transform: uppercase; }
        .em-hero-title { font-size: 3.5rem; color: #fff; line-height: 1.2; margin-top: 10px; text-transform: uppercase; }
        .em-statement { background: #0d0d0d; }
        .em-command { padding: 100px 0; text-align: center; }
        .em-command h2 { font-size: 3rem; margin-bottom: 40px; }
        .em-command-btn { display: inline-block; background: var(--accent-color); color: #000; padding: 15px 40px; border-radius: 50px; text-decoration: none; font-weight: 800; text-transform: uppercase; transition: 0.3s; }
        .em-command-btn:hover { opacity: 0.85; transform: translateY(-3px); }
        @media (max-width: 768px) {
            .em-hero-title { font-size: 2.2rem; }
            .about-story-grid { grid-template-columns: 1fr !important; }
            .about-offices-grid { grid-template-columns: 1fr !important; }
        }
    </style>

    <section class="em-lifecycle" style="background: rgba(255,255,255,0.03);">
        <div class="em-container">
            <div class="em-lifecycle-header">
                <h2 style="color: var(--accent-color) !important;">{!! theme_option('about_different_title', 'Built for Sports. Not Just Available for It.') !!}</h2>
            </div>
            
            <div class="em-lifecycle-grid">
                <div class="em-phase-card">
                    <p>{!! theme_option('about_different_p1', 'We have real experience managing Pakistan\'s largest annual running events') !!}</p>
                </div>
                <div class="em-phase-card">
                    <p>{!! theme_option('about_different_p2', 'We understand sports audiences they are communities, not just consumers') !!}</p>
                </div>
                <div class="em-phase-card">
                    <p>{!! theme_option('about_different_p3', 'We handle both the digital side and the on-ground execution, so nothing falls through the cracks') !!}</p>
                </div>
                <div class="em-phase-card">
                    <p>{!! theme_option('about_different_p4', 'We operate nationwide Islamabad, Rawalpindi, Karachi, Lahore, and beyond') !!}</p>
                </div>
                <div class="em-phase-card">
                    <p>{!! theme_option('about_different_p5', 'We are part of Optimize Digital, giving us full agency resources for every sports project') !!}</p>
                </div>
            </div>
        </div>
    </section>

    <section id="team" class="expertise" style="padding: 120px 0; scroll-margin-top: 100px;">
        <div class="em-container">
            <div class="section-header">
                <h2>{!! theme_option('about_team_title', 'Meet the People Behind OD Sports') !!}</h2>
                <p>{!! theme_option('about_team_subtitle', 'A diverse team of creatives, strategists, and sports enthusiasts united by a love of sport and a commitment to making every project exceptional.') !!}</p>
            </div>
            
            <div style="margin-top: 60px; display: grid; grid-template-columns: repeat(auto-fill, minmax(240px, 1fr)); gap: 30px;">
                @for($i = 1; $i <= 15; $i++)
                    @if(theme_option('about_team_'.$i.'_name'))
                    <div class="expertise-card" style="text-align: center; background: var(--nav-bg); padding: 40px 20px;">
                        <div style="width: 140px; height: 140px; margin: 0 auto 25px; border-radius: 50%; overflow: hidden; background: #333; border: none;">
                            <img src="{{ $aboutTeamImgUrls[$i] }}" alt="{!! theme_option('about_team_'.$i.'_name') !!}" style="width:100%; height:100%; object-fit: cover; object-position: top center;">
                        </div>
                        <h4 style="font-size: 1.25rem; margin-bottom: 5px;">{!! theme_option('about_team_'.$i.'_name') !!}</h4>
                        <p style="color: var(--accent-color); font-size: 0.9rem; font-weight: 700; text-transform: uppercase; letter-spacing: 1px;">{!! theme_option('about_team_'.$i.'_role') !!}</p>
                    </div>
                    @endif
                @endfor
            </div>

        </div>
    </section>

    <section class="em-command" style="background: linear-gradient(rgba(0,0,0,0.8), rgba(0,0,0,0.8)), url('{{ $aboutCtaBgUrl }}'); background-size: cover;">
        <div class="em-container">
            <h2 style="margin-bottom: 40px;"><span class="em-text-neon">{!! theme_option('about_cta_title_1', 'BASED IN ISLAMABAD') !!}</span> <br><span class="em-text-neon">{!! theme_option('about_cta_title_2', 'WORKING NATIONWIDE') !!}</span></h2>
            
            <div class="about-offices-grid" style="display: flex; justify-content: center; text-align: left; max-width: 900px; margin: 0 auto 50px;">
                <div style="background: rgba(0,0,0,0.4); padding: 30px; border-radius: 15px; border-left: 4px solid var(--accent-color); max-width: 450px; width: 100%;">
                    <h4 style="color: var(--accent-color); margin-bottom: 15px;">{!! theme_option('about_office1_title', 'HEAD OFFICE') !!}</h4>
                    <p style="color: #fff; font-size: 1rem; line-height: 1.6;">{!! theme_option('about_office1_address', '3rd Floor, Manzoor Plaza, G-6/2 Blue Area, Islamabad') !!}</p>
                </div>
            </div>
            
            <a href="{!! theme_option('about_cta_btn_link', 'tel:+923201223359') !!}" class="em-command-btn">{!! theme_option('about_cta_btn', 'Call Us: +92 320 1223359') !!}</a>
        </div>
    </section>

@endsection
