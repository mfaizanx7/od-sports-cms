@extends('layouts.landing')

@section('content')

    @php
        $heroBg = theme_option('homepage_hero_bg', 'landing-assets/images/hero-bg2.jpg');
        if (str_starts_with($heroBg, 'http://') || str_starts_with($heroBg, 'https://')) { $heroBgUrl = $heroBg; }
        elseif (file_exists(public_path($heroBg))) { $heroBgUrl = asset($heroBg); }
        else { $heroBgUrl = RvMedia::getImageUrl($heroBg); }
    @endphp
    <div class="hero-full-bg" id="home" style="background-image: linear-gradient(rgba(0,0,0,0.45), rgba(0,0,0,0.45)), url('{{ $heroBgUrl }}') !important; background-size: cover; background-position: center;">
        <section class="hero">
            <div class="container">
                <div class="hero-content">
                    <span class="badge">{!! theme_option('homepage_badge', 'ESTABLISHED 2022') !!}</span>
                    <h1>{!! theme_option('homepage_heading', 'We Plan, Promote & Produce Sports Events Across Pakistan') !!}</h1>
                    <p>{!! theme_option('homepage_description', 'From grassroots tournaments to national championships, OD Sports is Pakistan’s most trusted sports agency delivering end-to-end planning, production, and promotion for every sport, every scale and every stage.') !!}</p>
                    <div class="hero-btns" style="display: flex; flex-wrap: nowrap; align-items: center; gap: 16px;">
                        <a href="#contact" class="primary-btn" style="text-decoration: none; flex-shrink: 0;">{!! theme_option('homepage_btn_primary', 'Book your meeting') !!} <i class="fas fa-calendar-alt"></i></a>
                        <a href="{{ route('public.portfolio') }}" class="secondary-btn" style="text-decoration: none; flex-shrink: 0;">{!! theme_option('homepage_btn_secondary', 'See Our Work') !!} <i class="fas fa-eye"></i></a>
                        <span style="width: 1px; height: 36px; background: rgba(255,255,255,0.3); display: inline-block; flex-shrink: 0;"></span>
                        <div style="display: flex; align-items: center; gap: 14px; flex-shrink: 0;">
                            <a href="{!! theme_option('global_social_facebook', '#') !!}" target="_blank" rel="noopener" style="color: #0056ff; font-size: 1.2rem; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'"><i class="fab fa-facebook-f"></i></a>
                            <a href="{!! theme_option('global_social_instagram', '#') !!}" target="_blank" rel="noopener" style="color: #0056ff; font-size: 1.2rem; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'"><i class="fab fa-instagram"></i></a>
                            <a href="{!! theme_option('global_social_youtube', '#') !!}" target="_blank" rel="noopener" style="color: #0056ff; font-size: 1.2rem; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'"><i class="fab fa-youtube"></i></a>
                            <a href="{!! theme_option('global_social_tiktok', '#') !!}" target="_blank" rel="noopener" style="color: #0056ff; font-size: 1.2rem; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'"><i class="fab fa-tiktok"></i></a>
                            <a href="{!! theme_option('global_social_linkedin', '#') !!}" target="_blank" rel="noopener" style="color: #0056ff; font-size: 1.2rem; transition: opacity 0.2s;" onmouseover="this.style.opacity='0.7'" onmouseout="this.style.opacity='1'"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @php
            $tf = function($text) {
                $text = str_replace('●', '', $text);
                $text = preg_replace('/([\d,]+\.?\d*[A-Za-z]*\+)/', '<strong style="font-weight:900;font-size:1.15em;letter-spacing:0.5px;">$1</strong>', $text);
                return $text;
            };
        @endphp
        <div class="ticker-wrapper">
            <div class="ticker">
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_1', '18.6M+ Video Views')) !!}</div>
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_2', '| 8.66M+ People Reached')) !!}</div>
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_3', '| 6,000+ Athletes Participated')) !!}</div>
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_4', '| 25+ Events Delivered')) !!}</div>
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_5', '| 3+ Years as Pakistan\'s Most Trusted Sports Agency')) !!}</div>
                <!-- Duplicate for seamless loop -->
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_1', '18.6M+ Video Views')) !!}</div>
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_2', '| 8.66M+ People Reached')) !!}</div>
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_3', '| 6,000+ Athletes Participated')) !!}</div>
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_4', '| 25+ Events Delivered')) !!}</div>
                <div class="ticker-item">{!! $tf(theme_option('homepage_ticker_5', '| 3+ Years as Pakistan\'s Most Trusted Sports Agency')) !!}</div>
            </div>
        </div>
    </div>

    <section id="expertise" class="expertise">
        <div class="container">
            <div class="section-header">
                <h2>{!! theme_option('homepage_expertise_title', 'Where Sport Meets Strategy') !!}</h2>
                <p>{!! theme_option('homepage_expertise_subtitle', 'OD Sports isn’t just a production house. We are a sports-first strategy agency. We help brands, federations, and event organisers build community-driven campaigns that turn casual followers into lifelong participants.') !!}</p>
            </div>

            <!-- Interactive Coverage Map Section -->
            <div class="map-poster" style="margin-top: 40px; text-align: center; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.4); position: relative; background: #111; height: 500px;">
                
                <div id="od-coverage-map" style="width: 100%; height: 100%; z-index: 1;"></div>

                <div style="position: absolute; bottom: 30px; left: 30px; text-align: left; background: rgba(0,0,0,0.85); padding: 20px 30px; border-radius: 12px; border-left: 4px solid var(--accent-color); z-index: 10; backdrop-filter: blur(5px); pointer-events: none;">
                    <h3 style="color: #fff; margin-bottom: 5px; font-size: 1.5rem; text-transform: uppercase;">{!! theme_option('homepage_map_poster_title', 'Our Coverage') !!}</h3>
                    <p style="color: rgba(255,255,255,0.9); margin: 0; font-size: 1rem;">{!! theme_option('homepage_map_poster_subtitle', 'Operating Nationwide Across Pakistan') !!}</p>
                </div>
            </div>

            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
            <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
            <style>
                .map-poster {
                    border: 1px solid rgba(141, 223, 13, 0.2);
                }
                .pulsing-marker {
                    width: 16px; height: 16px;
                    background-color: var(--accent-color, #8ddf0d);
                    border-radius: 50%;
                    box-shadow: 0 0 15px var(--accent-color, #8ddf0d), 0 0 30px var(--accent-color, #8ddf0d);
                    animation: pulse 2s infinite;
                }
                .hub-marker {
                    width: 24px; height: 24px;
                    background-color: #fff;
                    border: 4px solid var(--accent-color, #8ddf0d);
                    border-radius: 50%;
                    box-shadow: 0 0 20px #fff, 0 0 40px var(--accent-color, #8ddf0d);
                    animation: pulseHub 2s infinite;
                }
                .city-label {
                    font-weight: 800; font-size: 15px; color: #fff;
                    text-shadow: 0px 2px 10px rgba(0,0,0,1), 0px -2px 10px rgba(0,0,0,1), 2px 0px 10px rgba(0,0,0,1), -2px 0px 10px rgba(0,0,0,1);
                    background: transparent; border: none; box-shadow: none;
                    text-align: center; letter-spacing: 1px; text-transform: uppercase;
                }
                .hub-label {
                    color: var(--accent-color, #8ddf0d);
                    font-size: 18px;
                }
                @keyframes pulse {
                    0% { transform: scale(0.9); box-shadow: 0 0 0 0 rgba(141, 223, 13, 0.8); }
                    70% { transform: scale(1.2); box-shadow: 0 0 0 20px rgba(141, 223, 13, 0); }
                    100% { transform: scale(0.9); box-shadow: 0 0 0 0 rgba(141, 223, 13, 0); }
                }
                @keyframes pulseHub {
                    0% { transform: scale(0.9); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.8); }
                    70% { transform: scale(1.3); box-shadow: 0 0 0 25px rgba(255, 255, 255, 0); }
                    100% { transform: scale(0.9); box-shadow: 0 0 0 0 rgba(255, 255, 255, 0); }
                }
            </style>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    var map = L.map('od-coverage-map', {
                        center: [30.3753, 69.3451], // Center of Pakistan
                        zoom: 5.5,
                        zoomControl: false,
                        scrollWheelZoom: false,
                        dragging: !L.Browser.mobile // disable dragging on mobile to avoid scrolling issues
                    });

                    // Dark Matter Tile Layer (Free, no API key)
                    L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                        attribution: '&copy; OpenStreetMap contributors',
                        subdomains: 'abcd',
                        maxZoom: 20
                    }).addTo(map);

                    var pulseIcon = L.divIcon({ className: 'pulsing-marker', iconSize: [16, 16] });
                    var hubIcon = L.divIcon({ className: 'hub-marker', iconSize: [24, 24] });

                    var hubCoords = [33.6844, 73.0479]; // Islamabad

                    var cities = [
                        { name: "ISLAMABAD", coords: hubCoords, isHub: true },
                        { name: "LAHORE", coords: [31.5204, 74.3587] },
                        { name: "KARACHI", coords: [24.8607, 67.0011] },
                        { name: "PESHAWAR", coords: [34.0151, 71.5249] },
                        { name: "GILGIT", coords: [35.9208, 74.3083] },
                        { name: "MULTAN", coords: [30.1968, 71.4697] }
                    ];

                    cities.forEach(function(city) {
                        // Draw connecting lines from Hub to other cities
                        if (!city.isHub) {
                            L.polyline([hubCoords, city.coords], {
                                color: '#8ddf0d',
                                weight: 2,
                                opacity: 0.5,
                                dashArray: '5, 10',
                                lineCap: 'round'
                            }).addTo(map);
                        }

                        L.marker(city.coords, {icon: city.isHub ? hubIcon : pulseIcon}).addTo(map);
                        
                        var labelClass = city.isHub ? 'city-label hub-label' : 'city-label';
                        var labelIcon = L.divIcon({
                            className: labelClass,
                            html: city.name,
                            iconSize: [120, 20],
                            iconAnchor: [60, city.isHub ? -15 : -10]
                        });
                        L.marker(city.coords, {icon: labelIcon, interactive: false}).addTo(map);
                    });
                });
            </script>
            <!-- End Interactive Coverage Map Section -->

            @php
                $expertiseImg1 = theme_option('homepage_expertise_img_1', '');
                $expertiseImg1Url = '';
                if ($expertiseImg1) {
                    if (str_starts_with($expertiseImg1, 'http://') || str_starts_with($expertiseImg1, 'https://')) { $expertiseImg1Url = $expertiseImg1; }
                    elseif (file_exists(public_path($expertiseImg1))) { $expertiseImg1Url = asset($expertiseImg1); }
                    else { $expertiseImg1Url = RvMedia::getImageUrl($expertiseImg1); }
                }
            @endphp
            @if($expertiseImg1Url)
            <div style="margin-top: 40px; border-radius: 20px; overflow: hidden; box-shadow: 0 20px 40px rgba(0,0,0,0.4);">
                <img src="{{ $expertiseImg1Url }}" alt="Behind the scenes" style="width: 100%; display: block;">
            </div>
            @endif

            <div class="expertise-about-grid" style="margin-top: 100px; display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
                <div>
                    <h2 style="font-size: 2.5rem; margin-bottom: 25px;">{!! theme_option('homepage_expertise_main_title', 'Pakistan’s Most Trusted Sports Agency') !!}</h2>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: rgba(255,255,255,0.8); margin-bottom: 30px;">
                        {!! theme_option('homepage_expertise_main_desc_1', 'OD Sports is a full-service sports agency operating at the intersection of sport, media, and experience design. We work with running communities, sports federations, event organisers, fitness brands, and corporate partners to deliver world-class sports experiences from planning to execution to amplification.') !!}
                    </p>
                    <p style="font-size: 1.1rem; line-height: 1.8; color: rgba(255,255,255,0.8); margin-bottom: 35px;">
                        {!! theme_option('homepage_expertise_main_desc_2', 'From marathons and trail races to cycling, triathlons, and multi-sport events, we don’t just organise events we build sporting culture across Pakistan. Every detail is designed to elevate performance, participation and visibility.') !!}
                    </p>
                    <a href="{{ route('public.about') }}" class="learn-more" style="font-size: 1.2rem; font-weight: 700;">{!! theme_option('homepage_expertise_btn', 'Learn Our Story →') !!}</a>
                </div>
                <div style="border-radius: 20px; overflow: hidden; height: 400px; background: #333;">
                    <img src="{!! RvMedia::getImageUrl(theme_option('homepage_expertise_img_2', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=1200')) !!}" alt="Team at event" style="width: 100%; height: 100%; object-fit: cover; display: block;">
                </div>
            </div>

            <div class="section-header" style="margin-top: 100px;">
                <h2>{!! theme_option('homepage_services_title', 'Full-Service Sports Solutions for Every Game') !!}</h2>
                <p>{!! theme_option('homepage_services_subtitle', 'OD Sports is Pakistan’s Most Trusted Sports Agency — delivering complete solutions for sports events, teams, and brands across the country.') !!}</p>
            </div>

            <div class="expertise-grid" style="margin-top: 60px;">
                <div class="expertise-card">
                    <div class="icon-box"><i class="fas fa-running"></i></div>
                    <h3>{!! theme_option('homepage_service_1_title', 'Sports Event Management') !!}</h3>
                    <p>{!! theme_option('homepage_service_1_desc', 'Planning & execution for road marathons and indoor tournaments.') !!}</p>
                    <a href="{{ route('public.services.event-management') }}" class="learn-more">{!! theme_option('homepage_service_1_btn', 'LEARN MORE') !!} <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="expertise-card">
                    <div class="icon-box"><i class="fas fa-video"></i></div>
                    <h3>{!! theme_option('homepage_service_2_title', 'Sports Media Production') !!}</h3>
                    <p>{!! theme_option('homepage_service_2_desc', 'High-performing photo, video, and live stream content.') !!}</p>
                    <a href="{{ route('public.services.media-production') }}" class="learn-more">{!! theme_option('homepage_service_2_btn', 'LEARN MORE') !!} <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="expertise-card">
                    <div class="icon-box"><i class="fas fa-bullhorn"></i></div>
                    <h3>{!! theme_option('homepage_service_3_title', 'Sports Marketing & Strategy') !!}</h3>
                    <p>{!! theme_option('homepage_service_3_desc', 'Community-first strategies that turn followers into fans.') !!}</p>
                    <a href="{{ route('public.services.sports-marketing') }}" class="learn-more">{!! theme_option('homepage_service_3_btn', 'LEARN MORE') !!} <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="expertise-card">
                    <div class="icon-box"><i class="fas fa-palette"></i></div>
                    <h3>{!! theme_option('homepage_service_4_title', 'Digital Campaign Design') !!}</h3>
                    <p>{!! theme_option('homepage_service_4_desc', 'High-energy visual identities and social media kits.') !!}</p>
                    <a href="{{ route('public.services.campaign-design') }}" class="learn-more">{!! theme_option('homepage_service_4_btn', 'LEARN MORE') !!} <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="expertise-card">
                    <div class="icon-box"><i class="fas fa-users"></i></div>
                    <h3>{!! theme_option('homepage_service_6_title', 'Influencer & Athlete Marketing') !!}</h3>
                    <p>{!! theme_option('homepage_service_6_desc', 'Authentic reach through Pakistan’s top fitness leaders.') !!}</p>
                    <a href="{{ route('public.services.influencer-marketing') }}" class="learn-more">{!! theme_option('homepage_service_6_btn', 'LEARN MORE') !!} <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <section class="stats" style="background: #111; padding: 100px 0;">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-item">
                    <div class="number">{!! theme_option('homepage_stat_1_number', '18.6M+') !!}</div>
                    <div class="label">{!! theme_option('homepage_stat_1_label', 'VIDEO VIEWS') !!}</div>
                </div>
                <div class="stat-item">
                    <div class="number">{!! theme_option('homepage_stat_2_number', '8.66M+') !!}</div>
                    <div class="label">{!! theme_option('homepage_stat_2_label', 'PEOPLE REACHED') !!}</div>
                </div>
                <div class="stat-item">
                    <div class="number">{!! theme_option('homepage_stat_3_number', '6,000+') !!}</div>
                    <div class="label">{!! theme_option('homepage_stat_3_label', 'MARATHON PARTICIPANTS') !!}</div>
                </div>
                <div class="stat-item">
                    <div class="number">{!! theme_option('homepage_stat_4_number', '25+') !!}</div>
                    <div class="label">{!! theme_option('homepage_stat_4_label', 'EVENTS DELIVERED') !!}</div>
                </div>
            </div>
        </div>
    </section>

    <section id="portfolio" class="highlights">
        <div class="container">
            <div class="section-header left-align">
                <h2 style="color: var(--accent-color) !important;">{!! theme_option('homepage_portfolio_badge', 'FEATURED <span class="highlight">PROJECTS</span>') !!}</h2>
                <h3 style="margin-top: 15px; font-size: 2rem; font-weight: 800; color: #fff;">{!! theme_option('homepage_portfolio_title', 'From the Field to the Feed') !!}</h3>
                <p style="margin-top: 15px; color: rgba(255,255,255,0.7);">{!! theme_option('homepage_portfolio_subtitle', 'We\'ve been behind some of Pakistan\'s biggest sports moments. Here\'s a taste of what we\'ve built.') !!}</p>
            </div>
            <div class="highlights-grid">
                <div class="highlight-main">
                    <img src="{!! RvMedia::getImageUrl(theme_option('homepage_portfolio_1_img', 'landing-assets/images/marathon_race_day.png')) !!}" alt="Islamabad Marathon">
                    <div class="highlight-content">
                        <span class="event-tag marathon">{!! theme_option('homepage_portfolio_1_tag', 'MARATHON 2022-2025') !!}</span>
                        <h3>{!! theme_option('homepage_portfolio_1_title', 'Islamabad Marathon 2022–2025') !!}</h3>
                        <p style="color: #fff; margin: 15px 0; font-size: 0.9rem; line-height: 1.6;">{!! theme_option('homepage_portfolio_1_desc', '3-year ongoing digital and event partner. Grew the event from 500 to 6,000+ participants. Delivered 18.6M video views and reached 8.66M people.') !!}</p>
                        <a href="{{ route('public.portfolio') }}" class="view-gallery">{!! theme_option('homepage_portfolio_1_btn', 'VIEW CASE STUDY') !!} <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="highlight-side">
                    <div class="side-item">
                        <img src="{!! RvMedia::getImageUrl(theme_option('homepage_portfolio_2_img', 'landing-assets/images/kids_running.png')) !!}" alt="YourPace by inDrive">
                        <div class="highlight-content">
                            <span class="event-tag football">{!! theme_option('homepage_portfolio_2_tag', 'KIDS RUNNING') !!}</span>
                            <h3>{!! theme_option('homepage_portfolio_2_title', 'YourPace by inDrive') !!}</h3>
                            <p style="color: #fff; margin: 5px 0; font-size: 0.8rem; line-height: 1.4;">{!! theme_option('homepage_portfolio_2_desc', 'Pakistan launch of a global kids running movement. Multi-city execution across Islamabad and Karachi — branding, event management, and full documentary production.') !!}</p>
                        </div>
                    </div>
                    <div class="side-item">
                        <img src="{!! RvMedia::getImageUrl(theme_option('homepage_portfolio_3_img', 'landing-assets/images/trail_runner.png')) !!}" alt="Galyat Mountain Trail">
                        <div class="highlight-content">
                            <span class="event-tag crossfit">{!! theme_option('homepage_portfolio_3_tag', 'TRAIL RUNNING') !!}</span>
                            <h3>{!! theme_option('homepage_portfolio_3_title', 'Galyat Mountain Trail & Margalla Trail Runners') !!}</h3>
                            <p style="color: #fff; margin: 5px 0; font-size: 0.8rem; line-height: 1.4;">{!! theme_option('homepage_portfolio_3_desc', 'Official media partner for MTR since 2024. Covered the Backyard Ultra, Hill Half Marathon, and Trail Running Festival with cinematic productions that reached 476K+ people.') !!}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div style="text-align: center; margin-top: 50px;">
                <a href="{{ route('public.portfolio') }}" class="primary-btn" style="text-decoration: none;">{!! theme_option('homepage_portfolio_btn', 'View Full Portfolio →') !!} <i class="fas fa-th"></i></a>
            </div>
        </div>
    </section>

    {{-- ── YouTube Videos Section ───────────────────────────────── --}}
    <section id="videos" style="padding: 100px 0; background: #0a0a0a;">
        <div class="container">
            <div class="section-header left-align">
                <span style="color: #8ddf0d; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; display: block; margin-bottom: 8px;">{!! theme_option('homepage_videos_label', 'OD SPORTS') !!}</span>
                <h2 style="color: #8ddf0d !important; font-size: 2.5rem; font-weight: 800; margin: 0;">{!! theme_option('homepage_videos_title', 'WATCH OUR WORK') !!}</h2>
                <p style="color: rgba(255,255,255,0.6); margin-top: 15px;">{!! theme_option('homepage_videos_subtitle', 'Behind-the-lens footage from Pakistan\'s biggest sports events.') !!}</p>
            </div>

            @php
            $_yt_defs = [
                1  => ['id' => 'z3OUvM8NgNU', 'title' => 'YourPace by inDrive',           'tag' => 'KIDS RUNNING'],
                2  => ['id' => 'Xp7ZnFyOseg', 'title' => 'Galyat Mountain Trail',         'tag' => 'TRAIL RUNNING'],
                3  => ['id' => '15CinzcMKgA', 'title' => 'Night Run 2024',                'tag' => 'NIGHT RUN'],
                4  => ['id' => 'p-RvgDnhvQc', 'title' => 'Twin City Half Marathon',       'tag' => 'HALF MARATHON'],
                5  => ['id' => 'meOZ57_pNYU', 'title' => 'Backyard Ultra 2024',           'tag' => 'ULTRA RUNNING'],
                6  => ['id' => '5AN4tLsq30o', 'title' => 'Islamabad Marathon 2024',       'tag' => 'MARATHON'],
                7  => ['id' => 'N4Jo-hZBa-I', 'title' => 'Islamabad Half Marathon 2024', 'tag' => 'HALF MARATHON'],
                8  => ['id' => 'Cc58yMaX9ZM', 'title' => 'Margalla Half Marathon 2024',  'tag' => 'TRAIL RUNNING'],
                9  => ['id' => '-B1M7-wZS-w', 'title' => 'IRU Half Marathon 2025',        'tag' => 'MARATHON'],
                10 => ['id' => 'Ad3owg95AUE', 'title' => 'IRC Race Series 2025 – 10KM',   'tag' => 'RACE SERIES'],
            ];
            $yt_videos = [];
            for ($_i = 1; $_i <= 10; $_i++) {
                $_def = $_yt_defs[$_i];
                $_vid_raw = theme_option('homepage_video_'.$_i.'_id', $_def['id']);
                if ($_vid_raw) {
                    preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $_vid_raw, $match);
                    $_vid_id = $match[1] ?? $_vid_raw;
                    $yt_videos[] = [
                        'id'    => $_vid_id,
                        'title' => theme_option('homepage_video_'.$_i.'_title', $_def['title']),
                        'tag'   => theme_option('homepage_video_'.$_i.'_tag',   $_def['tag']),
                    ];
                }
            }
            @endphp

            <div class="yt-grid">
                @foreach($yt_videos as $v)
                <div class="yt-card" onclick="openYtModal('{{ $v['id'] }}')" style="cursor: pointer; display: block; border-radius: 12px; overflow: hidden; background: #111; border: 1px solid #1e1e1e; transition: transform 0.3s ease;">
                    <div class="yt-thumb" style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                        <img src="https://img.youtube.com/vi/{{ $v['id'] }}/hqdefault.jpg"
                             alt="{{ $v['title'] }}"
                             style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover; display: block;">
                        <div class="yt-play-overlay" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.4); display: flex; align-items: center; justify-content: center; transition: background 0.3s ease;">
                            <div class="yt-play-btn" style="width: 45px; height: 45px; background: #8ddf0d; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(0,0,0,0.5); transition: transform 0.2s ease;">
                                <i class="fas fa-play" style="color: #000; font-size: 14px; margin-left: 3px;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="yt-info" style="padding: 15px;">
                        <span class="yt-tag">{{ $v['tag'] }}</span>
                        <p class="yt-title">{{ $v['title'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <div style="text-align: center; margin-top: 40px;">
                <a href="{!! theme_option('homepage_videos_channel_url', 'https://www.youtube.com/@ODSportspk') !!}" target="_blank" rel="noopener" class="primary-btn" style="text-decoration: none;">
                    <i class="fab fa-youtube" style="margin-right: 8px;"></i> {!! theme_option('homepage_videos_channel_btn', 'View Full YouTube Channel') !!}
                </a>
            </div>
        </div>

        {{-- YouTube Video Modal --}}
        <div id="ytModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: 9999; align-items: center; justify-content: center;">
            <div style="position: absolute; top: 20px; right: 30px; color: #fff; font-size: 40px; font-weight: 300; cursor: pointer; z-index: 10000;" onclick="closeYtModal()">&times;</div>
            <div style="position: relative; width: 90%; max-width: 960px; aspect-ratio: 16/9; max-height: 80vh; box-shadow: 0 0 50px rgba(0,0,0,0.8);">
                <iframe id="ytModalIframe" src="" 
                        style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none; border-radius: 12px;" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                </iframe>
            </div>
        </div>

        <script>
            function openYtModal(videoId) {
                document.getElementById('ytModal').style.display = 'flex';
                document.getElementById('ytModalIframe').src = 'https://www.youtube.com/embed/' + videoId + '?autoplay=1';
                document.body.style.overflow = 'hidden';
            }
            function closeYtModal() {
                document.getElementById('ytModal').style.display = 'none';
                document.getElementById('ytModalIframe').src = '';
                document.body.style.overflow = 'auto';
            }
            
            // Close modal on outside click
            document.getElementById('ytModal').addEventListener('click', function(e) {
                if (e.target === this) {
                    closeYtModal();
                }
            });
        </script>
    </section>



    {{-- BLOGS heading, FEATURED GEARS and products section hidden --
    <section id="blogs" class="gear">
        <div class="container">
            <div class="section-header left-align">
                <a href="{{ route('public.blog') }}" style="text-decoration: none;"><h2 style="color: #fff !important; cursor: pointer;">{!! theme_option('homepage_blogs_title', 'BLOGS') !!}</h2></a>
                <h3 style="color: var(--accent-color) !important; margin-top: 10px; font-size: 1.4rem; font-weight: 800;">{!! theme_option('homepage_gears_title', 'FEATURED <span class="highlight">GEARS</span>') !!}</h3>
                <p>{!! theme_option('homepage_gears_subtitle', 'Professional grade equipment and apparel for serious athletes.') !!}</p>
            </div>
            <div class="product-grid">
                @forelse($featuredProducts as $product)
                <div class="product-card">
                    @if($loop->first)
                        <span class="product-badge new">NEW</span>
                    @elseif($product->sale_price && $product->sale_price < $product->price)
                        <span class="product-badge sale">SALE</span>
                    @endif
                    <div class="product-img">
                        @php
                            $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                            $imgRaw = !empty($images[0]) ? $images[0] : '';
                            if ($imgRaw) {
                                if (str_starts_with($imgRaw, 'http://') || str_starts_with($imgRaw, 'https://')) {
                                    $imgUrl = $imgRaw;
                                } elseif (file_exists(public_path($imgRaw))) {
                                    $imgUrl = asset($imgRaw);
                                } else {
                                    $imgUrl = RvMedia::getImageUrl($imgRaw);
                                }
                            } else {
                                $imgUrl = 'https://via.placeholder.com/400x400?text=' . urlencode($product->name);
                            }
                        @endphp
                        <img src="{{ $imgUrl }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-info">
                        <div class="category">{{ strtoupper(optional($product->categories->first())->name ?? 'GEAR') }}</div>
                        <h4>{{ $product->name }}</h4>
                        <div class="price">
                            ${{ number_format($product->sale_price ?: $product->price, 0) }}
                            @if($product->sale_price && $product->sale_price < $product->price)
                                <span class="old-price">${{ number_format($product->price, 0) }}</span>
                            @endif
                        </div>
                    </div>
                  <button class="add-to-cart add-to-cart-button" data-id="{{ $product->id }}" data-url="{{ route('public.cart.add-to-cart') }}">{!! theme_option('homepage_gears_add_to_cart', 'ADD TO CART') !!} <i class="fas fa-shopping-cart"></i></button>
                </div>
                @empty
                <div class="product-card" style="grid-column: 1/-1; text-align:center; padding:40px;">
                    <p>No featured products available yet. Check back soon!</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
    --}}

    <section id="blogs" style="padding: 100px 0; background: #0d0d0d;">
        <div class="container">
            <div class="section-header left-align">
                <span style="color: #8ddf0d; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 3px; display: block; margin-bottom: 8px;">{!! theme_option('homepage_blogs_label', 'OD SPORTS') !!}</span>
                <h2 style="color: #8ddf0d !important; font-size: 2.5rem; font-weight: 800; margin: 0;">{!! theme_option('homepage_blogs_section_title', 'LATEST BLOGS') !!}</h2>
                <p style="color: rgba(255,255,255,0.6); margin-top: 15px;">{!! theme_option('homepage_blogs_subtitle', 'Insights, stories, and updates from Pakistan\'s sports scene.') !!}</p>
            </div>

            @php
                $resolveImg = function($val) {
                    if (!$val) return '';
                    if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) return $val;
                    if (file_exists(public_path($val))) return asset($val);
                    return \RvMedia::getImageUrl($val);
                };
            @endphp

            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px; margin-top: 50px;">

                @if(isset($latestPosts) && $latestPosts->count() > 0)
                    @foreach($latestPosts as $post)
                    @php
                        $rawDesc  = $post->getAttributes()['description'] ?? '';
                        $sepPos   = strpos($rawDesc, '||');
                        $postCat  = $sepPos !== false ? trim(substr($rawDesc, 0, $sepPos)) : null;
                        $postExcerpt = $sepPos !== false ? trim(substr($rawDesc, $sepPos + 2)) : $rawDesc;
                        $postImgUrl  = $post->image ? $resolveImg(\RvMedia::getImageUrl($post->image)) : '';
                    @endphp
                    <a href="{{ route('public.blog') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; display: block; transition: transform 0.3s, border-color 0.3s;" onmouseover="this.style.transform='translateY(-6px)';this.style.borderColor='#8ddf0d'" onmouseout="this.style.transform='translateY(0)';this.style.borderColor='#222'">
                        @if($postImgUrl)
                        <div style="height: 200px; overflow: hidden;">
                            <img src="{{ $postImgUrl }}" alt="{{ $post->getAttributes()['name'] ?? $post->name }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.4s ease;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        </div>
                        @endif
                        <div style="padding: 24px;">
                            @if($postCat)
                            <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 10px;">{{ $postCat }}</span>
                            @endif
                            <h3 style="color: #fff; font-size: 18px; font-weight: 700; margin: 0 0 10px; line-height: 1.4;">{{ $post->getAttributes()['name'] ?? $post->name }}</h3>
                            <div style="color: #64748b; font-size: 12px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-user-edit"></i>
                                <span>Written by: <strong style="color: #fff;">{{ optional($post->author)->name ?? 'OD Sports' }}</strong></span>
                            </div>
                            @if($postExcerpt)
                            <p style="color: #94a3b8; font-size: 14px; line-height: 1.6; margin: 0 0 16px;">{{ Str::limit(strip_tags($postExcerpt), 120) }}</p>
                            @endif
                            <span style="color: #8ddf0d; font-size: 13px; font-weight: 700;">READ MORE <i class="fas fa-arrow-right" style="font-size: 11px;"></i></span>
                        </div>
                    </a>
                    @endforeach
                @else
                    {{-- Fallback: website portfolio stories as blog-style cards --}}
                    <a href="{{ route('public.blog') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; display: block; transition: transform 0.3s, border-color 0.3s;" onmouseover="this.style.transform='translateY(-6px)';this.style.borderColor='#8ddf0d'" onmouseout="this.style.transform='translateY(0)';this.style.borderColor='#222'">
                        <div style="height: 200px; overflow: hidden;">
                            <img src="https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=600" alt="Islamabad Marathon" style="width:100%; height:100%; object-fit:cover;">
                        </div>
                        <div style="padding: 24px;">
                            <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 10px;">EVENT MANAGEMENT</span>
                            <h3 style="color: #fff; font-size: 18px; font-weight: 700; margin: 0 0 10px; line-height: 1.4;">How We Grew the Islamabad Marathon from 500 to 6,000+ Participants</h3>
                            <div style="color: #64748b; font-size: 12px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-user-edit"></i>
                                <span>Written by: <strong style="color: #fff;">OD Sports</strong></span>
                            </div>
                            <p style="color: #94a3b8; font-size: 14px; line-height: 1.6; margin: 0 0 16px;">A behind-the-scenes look at 3 years of strategy, digital marketing, and on-ground execution that built Pakistan's largest marathon.</p>
                            <span style="color: #8ddf0d; font-size: 13px; font-weight: 700;">READ MORE <i class="fas fa-arrow-right" style="font-size: 11px;"></i></span>
                        </div>
                    </a>

                    <a href="{{ route('public.blog') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; display: block; transition: transform 0.3s, border-color 0.3s;" onmouseover="this.style.transform='translateY(-6px)';this.style.borderColor='#8ddf0d'" onmouseout="this.style.transform='translateY(0)';this.style.borderColor='#222'">
                        <div style="height: 200px; overflow: hidden;">
                            <img src="https://images.unsplash.com/photo-1471341971476-ae15ff5dd4ea?auto=format&fit=crop&w=600&q=80" alt="Sports Media Production" style="width:100%; height:100%; object-fit:cover;">
                        </div>
                        <div style="padding: 24px;">
                            <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 10px;">MEDIA PRODUCTION</span>
                            <h3 style="color: #fff; font-size: 18px; font-weight: 700; margin: 0 0 10px; line-height: 1.4;">18.6 Million Video Views: The Story Behind Our Sports Content Strategy</h3>
                            <div style="color: #64748b; font-size: 12px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-user-edit"></i>
                                <span>Written by: <strong style="color: #fff;">OD Sports</strong></span>
                            </div>
                            <p style="color: #94a3b8; font-size: 14px; line-height: 1.6; margin: 0 0 16px;">How cinematic race-day coverage, influencer tie-ins, and data-driven publishing drove record engagement across Pakistan's running community.</p>
                            <span style="color: #8ddf0d; font-size: 13px; font-weight: 700;">READ MORE <i class="fas fa-arrow-right" style="font-size: 11px;"></i></span>
                        </div>
                    </a>

                    <a href="{{ route('public.blog') }}" style="text-decoration: none; background: #151515; border: 1px solid #222; border-radius: 12px; overflow: hidden; display: block; transition: transform 0.3s, border-color 0.3s;" onmouseover="this.style.transform='translateY(-6px)';this.style.borderColor='#8ddf0d'" onmouseout="this.style.transform='translateY(0)';this.style.borderColor='#222'">
                        <div style="height: 200px; overflow: hidden;">
                            <img src="https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&w=600&q=80" alt="Influencer Marketing" style="width:100%; height:100%; object-fit:cover;">
                        </div>
                        <div style="padding: 24px;">
                            <span style="color: #8ddf0d; font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; display: block; margin-bottom: 10px;">INFLUENCER MARKETING</span>
                            <h3 style="color: #fff; font-size: 18px; font-weight: 700; margin: 0 0 10px; line-height: 1.4;">Why Authentic Athlete Partnerships Outperform Paid Ads in Pakistan</h3>
                            <div style="color: #64748b; font-size: 12px; margin-bottom: 12px; display: flex; align-items: center; gap: 6px;">
                                <i class="fas fa-user-edit"></i>
                                <span>Written by: <strong style="color: #fff;">OD Sports</strong></span>
                            </div>
                            <p style="color: #94a3b8; font-size: 14px; line-height: 1.6; margin: 0 0 16px;">Our 3.5-month influencer campaign for the Islamabad Marathon brought thousands of new runners — here's the playbook we used.</p>
                            <span style="color: #8ddf0d; font-size: 13px; font-weight: 700;">READ MORE <i class="fas fa-arrow-right" style="font-size: 11px;"></i></span>
                        </div>
                    </a>
                @endif

            </div>

            <div style="text-align: center; margin-top: 50px;">
                <a href="{{ route('public.blog') }}" class="primary-btn" style="text-decoration: none;">{!! theme_option('homepage_blogs_btn', 'VIEW ALL BLOGS') !!} <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <section id="team" class="expertise" style="background: rgba(255,255,255,0.02); padding: 100px 0;">
        <div class="container">
            <div class="section-header">
                <h2>{!! theme_option('homepage_team_title', 'The Team Behind the Moments') !!}</h2>
                <p>{!! theme_option('homepage_team_subtitle', 'A passionate crew of creatives, strategists, and sports enthusiasts — united by a love of sport and a commitment to making every project exceptional.') !!}</p>
            </div>
            
            <div style="margin-top: 60px; display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 30px;">
                <!-- Displaying top 4 members as preview -->
                <div class="expertise-card" style="text-align: center; background: var(--nav-bg);">
                    <div style="width: 120px; height: 120px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; background: #333;">
                        @php $t1 = theme_option('homepage_team_1_img', 'landing-assets/images/Imran Ghazli 1x1.png'); $t1u = (str_starts_with($t1,'http') ? $t1 : (file_exists(public_path($t1)) ? asset($t1) : RvMedia::getImageUrl($t1))); @endphp
                        <img src="{{ $t1u }}" alt="{!! theme_option('homepage_team_1_name', 'Imran Ghazali') !!}" style="width:100%; height:100%; object-fit:cover; object-position: top center;">
                    </div>
                    <h4>{!! theme_option('homepage_team_1_name', 'Imran Ghazali') !!}</h4>
                    <p style="color: var(--primary-color);">{!! theme_option('homepage_team_1_title', 'Founder & CEO') !!}</p>
                </div>
                <div class="expertise-card" style="text-align: center; background: var(--nav-bg);">
                    <div style="width: 120px; height: 120px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; background: #333;">
                        @php $t2 = theme_option('homepage_team_2_img', 'landing-assets/images/Aqib Mughal.jpg'); $t2u = (str_starts_with($t2,'http') ? $t2 : (file_exists(public_path($t2)) ? asset($t2) : RvMedia::getImageUrl($t2))); @endphp
                        <img src="{{ $t2u }}" alt="{!! theme_option('homepage_team_2_name', 'Aqib Mughal') !!}" style="width:100%; height:100%; object-fit:cover; object-position: top center;">
                    </div>
                    <h4>{!! theme_option('homepage_team_2_name', 'Aqib Mughal') !!}</h4>
                    <p style="color: var(--primary-color);">{!! theme_option('homepage_team_2_title', 'Director, Client Relations & Ops') !!}</p>
                </div>
                <div class="expertise-card" style="text-align: center; background: var(--nav-bg);">
                    <div style="width: 120px; height: 120px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; background: #333;">
                        @php $t3 = theme_option('homepage_team_3_img', 'landing-assets/images/Laiba Shakeel.jpg'); $t3u = (str_starts_with($t3,'http') ? $t3 : (file_exists(public_path($t3)) ? asset($t3) : RvMedia::getImageUrl($t3))); @endphp
                        <img src="{{ $t3u }}" alt="{!! theme_option('homepage_team_3_name', 'Laiba Shakeel') !!}" style="width:100%; height:100%; object-fit:cover; object-position: top center;">
                    </div>
                    <h4>{!! theme_option('homepage_team_3_name', 'Laiba Shakeel') !!}</h4>
                    <p style="color: var(--primary-color);">{!! theme_option('homepage_team_3_title', 'Senior Manager, Digital') !!}</p>
                </div>
                <div class="expertise-card" style="text-align: center; background: var(--nav-bg);">
                    <div style="width: 120px; height: 120px; margin: 0 auto 20px; border-radius: 50%; overflow: hidden; background: #333;">
                        @php $t4 = theme_option('homepage_team_4_img', 'landing-assets/images/Naeem Ansab.JPG'); $t4u = (str_starts_with($t4,'http') ? $t4 : (file_exists(public_path($t4)) ? asset($t4) : RvMedia::getImageUrl($t4))); @endphp
                        <img src="{{ $t4u }}" alt="{!! theme_option('homepage_team_4_name', 'Ansab Naeem') !!}" style="width:100%; height:100%; object-fit:cover; object-position: top center;">
                    </div>
                    <h4>{!! theme_option('homepage_team_4_name', 'Ansab Naeem') !!}</h4>
                    <p style="color: var(--primary-color);">{!! theme_option('homepage_team_4_title', 'Director, Media Production') !!}</p>
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 50px;">
                <a href="{{ route('public.about') }}#team" class="learn-more" style="font-size: 1.1rem; font-weight: 700;">{!! theme_option('homepage_team_btn', 'MEET THE FULL TEAM') !!} <i class="fas fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <section id="about" class="testimonials">
        <div class="container">
            <div class="section-header">
                <h2 class="orange-text-small">{!! theme_option('homepage_testimonials_title', 'TRUSTED BY PAKISTAN\'S SPORTS COMMUNITY') !!}</h2>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card">
                    <div class="user-info" style="align-items: center; gap: 20px;">
                        @php $tes1 = theme_option('homepage_testimonial_1_img', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=200'); $tes1u = (str_starts_with($tes1,'http') ? $tes1 : (file_exists(public_path($tes1)) ? asset($tes1) : RvMedia::getImageUrl($tes1))); @endphp
                        <img src="{{ $tes1u }}" alt="{!! theme_option('homepage_testimonial_1_name', 'Qasim Naz') !!}" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; object-position: top center; flex-shrink: 0; box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
                        <div>
                            <h4 style="font-size: 1.3rem; margin-bottom: 5px;">{!! theme_option('homepage_testimonial_1_name', 'Qasim Naz') !!}</h4>
                            <p style="font-size: 0.95rem; opacity: 0.8;">{!! theme_option('homepage_testimonial_1_title', 'Founder, Islamabad Run With Us (IRU)') !!}</p>
                        </div>
                    </div>
                    <p class="quote" style="margin-top: 20px;">{!! theme_option('homepage_testimonial_1_quote', 'Optimize Digital has been an integral partner in the journey of the Islamabad Marathon — the pioneer marathon in Pakistan. From the very beginning, their dedication and expertise in digital outreach have played a vital role in the growth and success of this event.') !!}</p>
                    <div class="stars">★★★★★</div>
                </div>
                <div class="testimonial-card">
                    <div class="user-info" style="align-items: center; gap: 20px;">
                        @php $tes2 = theme_option('homepage_testimonial_2_img', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=200'); $tes2u = (str_starts_with($tes2,'http') ? $tes2 : (file_exists(public_path($tes2)) ? asset($tes2) : RvMedia::getImageUrl($tes2))); @endphp
                        <img src="{{ $tes2u }}" alt="{!! theme_option('homepage_testimonial_2_name', 'Brent Weigner') !!}" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; object-position: top center; flex-shrink: 0; box-shadow: 0 4px 15px rgba(0,0,0,0.5);">
                        <div>
                            <h4 style="font-size: 1.3rem; margin-bottom: 5px;">{!! theme_option('homepage_testimonial_2_name', 'Brent Weigner') !!}</h4>
                            <p style="font-size: 0.95rem; opacity: 0.8;">{!! theme_option('homepage_testimonial_2_title', 'Globally Renowned Running Icon') !!}</p>
                        </div>
                    </div>
                    <p class="quote">{!! theme_option('homepage_testimonial_2_quote', 'I\'ve never seen this level of Facebook and Instagram coverage for any event before. It was brilliant — timely, engaging, and incredibly well done.') !!}</p>
                    <div class="stars">★★★★★</div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-elevate" id="contact">
        <div class="container">
            @if(session('mail_error'))
                <div style="background:#2b0d0d;border:1px solid #ef4444;color:#ef4444;padding:16px 24px;border-radius:10px;margin-bottom:30px;font-weight:600;text-align:center;">
                    <i class="fas fa-exclamation-circle" style="margin-right:8px;"></i>{{ session('mail_error') }}
                </div>
            @endif
            @isset($errors)
                @if($errors->any() && old('_form') === 'contact')
                    <div style="background:#2b0d0d;border:1px solid #ef4444;color:#ef4444;padding:16px 24px;border-radius:10px;margin-bottom:30px;">
                        <ul style="margin:0;padding-left:20px;">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
                    </div>
                @endif
            @endisset
            <form action="/od-contact-submit" method="POST">
                @csrf
                <input type="hidden" name="_form" value="contact">
                <div class="elevate-box">
                    <div class="elevate-info">
                        <h2>{!! theme_option('homepage_contact_title', 'READY TO TAKE YOUR <br><span class="highlight">SPORTS BRAND FURTHER?</span>') !!}</h2>
                        <p>{!! theme_option('homepage_contact_subtitle', 'Whether you\'re organising a city-wide run, launching an athleisure brand, or building a cricket community — OD Sports is the team that gets it done.') !!}</p>
                        <ul class="check-list">
                            <li><i class="fas fa-check"></i> {!! theme_option('homepage_contact_check_1', 'Professional Event Execution') !!}</li>
                            <li><i class="fas fa-check"></i> {!! theme_option('homepage_contact_check_2', 'Digital Visibility & Growth') !!}</li>
                            <li><i class="fas fa-check"></i> {!! theme_option('homepage_contact_check_3', 'Expert Sports Storytelling') !!}</li>
                        </ul>

                        <div style="margin-top: 40px;">
                            <p style="font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 2px; color: rgba(255,255,255,0.5); margin-bottom: 16px;">Follow Us</p>
                            <div style="display: flex; gap: 14px; align-items: center; flex-wrap: wrap;">
                                <a href="{!! theme_option('global_social_facebook', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="{!! theme_option('global_social_instagram', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-instagram"></i>
                                </a>
                                <a href="{!! theme_option('global_social_youtube', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-youtube"></i>
                                </a>
                                <a href="{!! theme_option('global_social_tiktok', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-tiktok"></i>
                                </a>
                                <a href="{!! theme_option('global_social_linkedin', '#') !!}" target="_blank" rel="noopener"
                                   style="width: 44px; height: 44px; border-radius: 50%; background: rgba(255,255,255,0.08); border: 1px solid rgba(255,255,255,0.12); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 16px; transition: all 0.3s; text-decoration: none;"
                                   onmouseover="this.style.background='#8ddf0d';this.style.borderColor='#8ddf0d';this.style.color='#000'" onmouseout="this.style.background='rgba(255,255,255,0.08)';this.style.borderColor='rgba(255,255,255,0.12)';this.style.color='#fff'">
                                    <i class="fab fa-linkedin-in"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="elevate-form od-contact-form">
                        @if(session('contact_success'))
                        <div style="display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:50px 20px;min-height:420px;">
                            <div style="width:90px;height:90px;border-radius:50%;background:rgba(141,223,13,0.12);border:2px solid #8ddf0d;display:flex;align-items:center;justify-content:center;margin-bottom:28px;">
                                <i class="fas fa-check" style="color:#8ddf0d;font-size:36px;"></i>
                            </div>
                            <h3 style="color:#fff;font-size:2rem;font-weight:800;margin:0 0 12px;letter-spacing:-0.5px;">Message Sent!</h3>
                            <p style="color:rgba(255,255,255,0.55);font-size:1rem;line-height:1.7;max-width:280px;margin:0 0 10px;">Thank you for reaching out. Our team will get back to you within <strong style="color:#fff;">24 hours.</strong></p>
                            <p style="color:rgba(255,255,255,0.3);font-size:0.8rem;margin:0 0 36px;">Check your inbox for a confirmation.</p>
                            <a href="{{ route('public.index') }}#contact" style="background:rgba(141,223,13,0.1);border:1px solid rgba(141,223,13,0.3);color:#8ddf0d;padding:13px 30px;border-radius:8px;text-decoration:none;font-weight:700;font-size:0.8rem;text-transform:uppercase;letter-spacing:1.5px;transition:all 0.3s;" onmouseover="this.style.background='rgba(141,223,13,0.2)'" onmouseout="this.style.background='rgba(141,223,13,0.1)'">Send Another Message</a>
                        </div>
                        @else
                        <div style="margin-bottom: 28px;">
                            <span style="color: #8ddf0d; font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 3px;">{!! theme_option('homepage_contact_form_label', 'Free Consultation') !!}</span>
                            <h3 style="color: #fff; font-size: 1.6rem; font-weight: 800; margin: 6px 0 0; line-height: 1.3;">{!! theme_option('homepage_contact_form_heading', 'Book Your Strategy Call') !!}</h3>
                        </div>

                        <div class="od-form-row">
                            <div class="od-field-wrap">
                                <label class="od-label">Your Name <span style="color:#ef4444;">*</span></label>
                                <div class="od-input-icon-wrap">
                                    <i class="fas fa-user od-input-icon"></i>
                                    <input class="od-input" type="text" name="name" placeholder="e.g. Ahmed Khan" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="od-field-wrap">
                                <label class="od-label">Organization / Brand</label>
                                <div class="od-input-icon-wrap">
                                    <i class="fas fa-building od-input-icon"></i>
                                    <input class="od-input" type="text" name="org" placeholder="e.g. IRU Athletics" value="{{ old('org') }}">
                                </div>
                            </div>
                        </div>

                        <div class="od-field-wrap" style="margin-bottom: 18px;">
                            <label class="od-label">Email Address <span style="color:#ef4444;">*</span></label>
                            <div class="od-input-icon-wrap">
                                <i class="fas fa-envelope od-input-icon"></i>
                                <input class="od-input" type="email" name="email" placeholder="you@example.com" value="{{ old('email') }}" required>
                            </div>
                        </div>

                        <div class="od-field-wrap" style="margin-bottom: 18px;">
                            <label class="od-label">Interested Service</label>
                            <div class="od-input-icon-wrap">
                                <i class="fas fa-list-ul od-input-icon"></i>
                                <select class="od-input od-select" name="service">
                                    <option value="">{!! theme_option('homepage_contact_form_service_label', 'Select a service...') !!}</option>
                                    <option value="Event Management" {{ old('service') === 'Event Management' ? 'selected' : '' }}>{!! theme_option('homepage_contact_form_service_1', 'Event Management') !!}</option>
                                    <option value="Media Production" {{ old('service') === 'Media Production' ? 'selected' : '' }}>{!! theme_option('homepage_contact_form_service_2', 'Media Production') !!}</option>
                                    <option value="Sports Marketing" {{ old('service') === 'Sports Marketing' ? 'selected' : '' }}>{!! theme_option('homepage_contact_form_service_3', 'Sports Marketing') !!}</option>
                                    <option value="Digital Campaign Design" {{ old('service') === 'Digital Campaign Design' ? 'selected' : '' }}>{!! theme_option('homepage_contact_form_service_4', 'Digital Campaign Design') !!}</option>
                                    <option value="Influencer Marketing" {{ old('service') === 'Influencer Marketing' ? 'selected' : '' }}>{!! theme_option('homepage_contact_form_service_6', 'Influencer Marketing') !!}</option>
                                </select>
                            </div>
                        </div>

                        <div class="od-field-wrap" style="margin-bottom: 24px;">
                            <label class="od-label">Your Message <span style="color:#ef4444;">*</span></label>
                            <textarea class="od-input od-textarea" name="message" placeholder="{!! theme_option('homepage_contact_form_message', 'Tell us about your sports project...') !!}" required>{{ old('message') }}</textarea>
                        </div>

                        <button type="submit" class="od-submit-btn">
                            <span>{{ strip_tags(theme_option('homepage_contact_form_btn', 'BOOK A FREE STRATEGY CALL')) }}</span>
                            <i class="fas fa-calendar-alt"></i>
                        </button>
                        <p style="text-align: center; color: rgba(255,255,255,0.35); font-size: 12px; margin-top: 14px; margin-bottom: 0;">
                            <i class="fas fa-lock" style="margin-right:5px;"></i>{!! theme_option('homepage_contact_form_trust', 'No spam. Free consultation. No commitment.') !!}
                        </p>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </section>

    <!-- Cart Toast Notification -->
    <div id="od-cart-toast" style="position:fixed;bottom:30px;right:30px;z-index:99999;display:none;">
        <div style="background:linear-gradient(135deg,#0a0a0a,#1a1a2e);color:#fff;padding:16px 28px;border-radius:12px;font-family:'Inter',sans-serif;font-size:14px;box-shadow:0 8px 32px rgba(0,0,0,.45);border:1px solid rgba(163,230,53,.3);display:flex;align-items:center;gap:12px;min-width:260px;">
            <i class="fas fa-check-circle" style="color:#a3e635;font-size:20px;"></i>
            <span id="od-cart-toast-msg">Added to cart!</span>
        </div>
    </div>

@endsection

@section('script')
<script>
(function() {
    var csrfToken = document.querySelector('meta[name="csrf-token"]');
    if (!csrfToken) {
        console.error('CSRF token meta tag not found');
        return;
    }
function getXsrfToken() {
    var cookie = document.cookie.split(';').find(function(c) {
        return c.trim().startsWith('XSRF-TOKEN=');
    });
    return cookie ? decodeURIComponent(cookie.trim().split('=')[1]) : null;
}
    // Fixed selector to match actual button class in blade
    document.querySelectorAll('.gear .add-to-cart-button[data-id]').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            var button = this;
            var productId = button.getAttribute('data-id');
            var url = button.getAttribute('data-url');
            if (!productId || !url) return;

            button.disabled = true;
            button.innerHTML = 'ADDING... <i class="fas fa-spinner fa-spin"></i>';

          fetch(url, {
    method: 'POST',
    credentials: 'same-origin',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-XSRF-TOKEN': getXsrfToken(),
        'X-Requested-With': 'XMLHttpRequest',
        'Accept': 'application/json'
    },
    body: 'id=' + encodeURIComponent(productId) + '&qty=1'
})
            .then(function(r) {
                if (!r.ok && r.status === 419) {
                    throw new Error('CSRF token mismatch');
                }
                return r.json();
            })
            .then(function(res) {
                button.disabled = false;
                if (res.error) {
                    button.innerHTML = 'ADD TO CART <i class="fas fa-shopping-cart"></i>';
                    showCartToast(res.message || 'Could not add to cart', true);
                    return;
                }
                button.innerHTML = 'ADDED ✓ <i class="fas fa-check"></i>';
                showCartToast(res.message || 'Added to cart!');

                // Update cart count badge
                var cartBadges = document.querySelectorAll('.cart-count');
                if (cartBadges.length && res.data && res.data.count !== undefined) {
                    cartBadges.forEach(function(badge) {
                        badge.textContent = res.data.count;
                    });
                }

                setTimeout(function() {
                    button.innerHTML = 'ADD TO CART <i class="fas fa-shopping-cart"></i>';
                }, 2500);
            })
            .catch(function(err) {
                button.disabled = false;
                button.innerHTML = 'ADD TO CART <i class="fas fa-shopping-cart"></i>';
                showCartToast(err.message === 'CSRF token mismatch' ? 'Session expired. Please refresh the page.' : 'Network error. Please try again.', true);
            });
        });
    });

    function showCartToast(msg, isError) {
        var toast = document.getElementById('od-cart-toast');
        var msgEl = document.getElementById('od-cart-toast-msg');
        if (!toast || !msgEl) return;

        var icon = toast.querySelector('i');
        msgEl.textContent = msg;
        if (icon) {
            icon.className = isError ? 'fas fa-exclamation-circle' : 'fas fa-check-circle';
            icon.style.color = isError ? '#ef4444' : '#a3e635';
        }
        toast.style.display = 'block';
        toast.style.animation = 'none';
        toast.offsetHeight;
        toast.style.animation = 'odToastIn .4s ease forwards';
        clearTimeout(window._odToastTimer);
        window._odToastTimer = setTimeout(function() {
            toast.style.animation = 'odToastOut .4s ease forwards';
            setTimeout(function() { toast.style.display = 'none'; }, 400);
        }, 3000);
    }
})();
</script>

<style>
@keyframes odToastIn  { from { opacity:0; transform:translateY(20px); } to { opacity:1; transform:translateY(0); } }
@keyframes odToastOut { from { opacity:1; transform:translateY(0); } to { opacity:0; transform:translateY(20px); } }
</style>
@endsection

