@extends('layouts.landing')

@section('title', theme_option('portfolio_page_title', 'Our Work - OD Sports'))

@section('content')
@php
    $resolveImg = function($val) {
        if (!$val) return '';
        if (str_starts_with($val, 'http://') || str_starts_with($val, 'https://')) return $val;
        if (file_exists(public_path($val))) return asset($val);
        return RvMedia::getImageUrl($val);
    };
@endphp
    <style>
        :root {
            --folder-bg: rgba(255, 255, 255, 0.05);
            --folder-border: rgba(255, 255, 255, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.03);
            --glass-blur: blur(15px);
        }

        body.light-mode {
            --folder-bg: rgba(0, 0, 0, 0.03);
            --folder-border: rgba(0, 0, 0, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.7);
        }

        .portfolio-page {
            min-height: 100vh;
            padding-top: 100px;
            background: var(--bg-main);
            color: var(--text-main);
            overflow-x: hidden;
        }

        /* Hero Styling */
        .portfolio-header {
            text-align: center;
            margin-bottom: 60px;
            position: relative;
        }
        .portfolio-header h1,
        body.dark-mode .portfolio-header h1 {
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 900;
            line-height: 1;
            margin-bottom: 20px;
            letter-spacing: -2px;
            color: var(--accent-color) !important;
        }

        .highlight-text {
            color: var(--primary-color) !important;
        }

        .portfolio-header .badge {
            background: transparent;
            color: var(--accent-color);
            border: 2px solid var(--accent-color);
            padding: 5px 18px;
            border-radius: 50px;
            font-weight: 800;
            letter-spacing: 2px;
            font-size: 0.75rem;
        }

        body.dark-mode .portfolio-header .badge {
            background: transparent;
            color: var(--accent-color);
        }

        /* Folder System */
        .folder-grid {
            display: grid;
            grid-template-cols: repeat(auto-fill, minmax(320px, 1fr));
            gap: 40px;
            padding: 20px 0 100px;
        }

        .project-folder {
            position: relative;
            cursor: pointer;
            transition: all 0.5s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .folder-shape {
            position: relative;
            width: 100%;
            aspect-ratio: 3 / 4;
            background: var(--folder-bg);
            border: none;
            border-radius: 12px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: inherit;
            backdrop-filter: var(--glass-blur);
        }

        /* Folder Tab */
        .folder-shape::before {
            display: none;
        }

        .project-folder:hover .folder-shape {
            transform: translateY(-15px) rotateX(10deg);
            background: var(--primary-color);
            border-color: var(--primary-color);
            box-shadow: 0 30px 60px rgba(0,0,0,0.3);
        }

        .folder-preview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 0;
            transition: transform 0.6s ease;
            box-shadow: none;
        }

        .project-folder:hover .folder-preview {
            transform: scale(1.05) translateY(-5px);
        }

        .folder-info {
            margin-top: 20px;
            padding-left: 10px;
        }

        .folder-title,
        body.dark-mode .folder-title {
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 5px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            color: var(--accent-color) !important;
        }

        .folder-category,
        body.dark-mode .folder-category,
        body.dark-mode p.folder-category {
            font-size: 0.85rem;
            color: #fff !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }

        /* Immersive Gallery Overlays */
        .gallery-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: rgba(0,0,0,0.98);
            z-index: 20000;
            display: none;
            opacity: 0;
            transition: opacity 0.5s ease;
            backdrop-filter: blur(20px);
            padding: 80px 40px;
            overflow-y: auto;
        }

        .gallery-overlay.active {
            display: block;
            opacity: 1;
        }

        .close-gallery {
            position: fixed;
            top: 30px;
            right: 40px;
            font-size: 2rem;
            color: white;
            cursor: pointer;
            z-index: 20001;
            transition: transform 0.3s ease;
        }

        .close-gallery:hover {
            transform: rotate(90deg) scale(1.2);
            color: var(--accent-color);
        }

        .gallery-header h2,
        body.dark-mode .gallery-header h2 {
            color: var(--accent-color) !important;
            font-size: clamp(2rem, 5vw, 4rem);
            font-weight: 900;
            margin-bottom: 0 !important;
        }

        .gallery-title-row {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .event-popup-logo {
            display: none;
        }

        .event-initials-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 5px;
            width: 85px;
            height: 85px;
            border-radius: 50%;
            background: #000;
            border: 2.5px solid var(--accent-color);
            color: var(--accent-color);
            flex-shrink: 0;
            box-shadow: 0 0 25px rgba(173,255,47,0.35), inset 0 0 20px rgba(173,255,47,0.05);
            text-align: center;
        }

        .event-initials-badge i {
            font-size: 1.6rem;
            color: var(--accent-color);
        }

        .event-initials-badge span {
            font-size: 0.6rem;
            font-weight: 900;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: #fff;
        }

        .gallery-grid {
            columns: 3 300px;
            column-gap: 30px;
            max-width: 1400px;
            margin: 40px auto;
        }

        .gallery-item {
            margin-bottom: 30px;
            break-inside: avoid;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
        }

        .gallery-item img {
            width: 100%;
            height: auto;
            display: block;
            transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1);
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .impact-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }

        .impact-item h4 {
            color: var(--primary-color);
            font-size: 2rem;
            font-weight: 800;
            margin-bottom: 5px;
        }

        .impact-item p {
            font-size: 0.9rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

    </style>

    <div class="portfolio-page">
        <div class="container">
            <header class="portfolio-header">
                <span class="badge mb-4 d-inline-block">{!! theme_option('portfolio_badge', 'OUR WORK') !!}</span>
                <h1>{!! theme_option('portfolio_title', 'Our Work Speaks for Itself') !!}</h1>
                <p class="max-w-3xl mx-auto opacity-70 text-lg">{!! theme_option('portfolio_subtitle', 'From Pakistan\'s largest marathon to kids running in the hills of Islamabad — every project we take on gets the same commitment. Here\'s what we\'ve built.') !!}</p>
            </header>

            <div class="folder-grid">
                <!-- Project 1 -->
                <div class="project-folder" onclick="openGallery('project-iru')">
                    <div class="folder-shape">
                        <img src="{{ $resolveImg(theme_option('portfolio_1_img', 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=600')) }}" class="folder-preview" alt="{!! theme_option('portfolio_1_alt', 'Islamabad Marathon') !!}">
                    </div>
                    <div class="folder-info">
                        <h3 class="folder-title">{!! theme_option('portfolio_1_title', 'ISLAMABAD MARATHON & IRU (2022–2025)') !!}</h3>
                        <p class="folder-category">{!! theme_option('portfolio_1_category', 'Event Management | Digital Marketing | Sports Media Production') !!}</p>
                    </div>
                </div>

                <!-- Project 2 -->
                <div class="project-folder" onclick="openGallery('project-mtr')">
                    <div class="folder-shape">
                        <img src="{{ $resolveImg(theme_option('portfolio_2_img', 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&q=80&w=600')) }}" class="folder-preview" alt="{!! theme_option('portfolio_2_alt', 'Margalla Trail Runners') !!}">
                    </div>
                    <div class="folder-info">
                        <h3 class="folder-title">{!! theme_option('portfolio_2_title', 'MARGALLA TRAIL RUNNERS (MTR)') !!}</h3>
                        <p class="folder-category">{!! theme_option('portfolio_2_category', 'Sports Media Production | Digital Marketing | Event Coverage') !!}</p>
                    </div>
                </div>

                <!-- Project 3 -->
                <div class="project-folder" onclick="openGallery('project-yourpace')">
                    <div class="folder-shape">
                        <img src="{{ $resolveImg(theme_option('portfolio_3_img', 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=600')) }}" class="folder-preview" alt="{!! theme_option('portfolio_3_alt', 'YourPace') !!}">
                    </div>
                    <div class="folder-info">
                        <h3 class="folder-title">{!! theme_option('portfolio_3_title', 'YOURPACE BY INDRIVE') !!}</h3>
                        <p class="folder-category">{!! theme_option('portfolio_3_category', 'Event Management | Media Production | Documentary Production') !!}</p>
                    </div>
                </div>

                <!-- Project 4 -->
                <div class="project-folder" onclick="openGallery('project-twincity')">
                    <div class="folder-shape">
                        <img src="{{ $resolveImg(theme_option('portfolio_4_img', 'https://images.unsplash.com/photo-1571008887538-b36bb32f4571?auto=format&fit=crop&q=80&w=600')) }}" class="folder-preview" alt="{!! theme_option('portfolio_4_alt', 'Twin City Run') !!}">
                    </div>
                    <div class="folder-info">
                        <h3 class="folder-title">{!! theme_option('portfolio_4_title', 'TWIN CITY RUN & NIGHT RUN') !!}</h3>
                        <p class="folder-category">{!! theme_option('portfolio_4_category', 'Digital Marketing | Sports Media Production | Event Coverage') !!}</p>
                    </div>
                </div>

                <!-- Project 5 -->
                <div class="project-folder" onclick="openGallery('project-irc')">
                    <div class="folder-shape">
                        <img src="{{ $resolveImg(theme_option('portfolio_5_img', 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&q=80&w=600')) }}" class="folder-preview" alt="{!! theme_option('portfolio_5_alt', 'IRC Running Series') !!}">
                    </div>
                    <div class="folder-info">
                        <h3 class="folder-title">{!! theme_option('portfolio_5_title', 'IRC RUNNING SERIES') !!}</h3>
                        <p class="folder-category">{!! theme_option('portfolio_5_category', 'Sports Photography | Videography | Content Production') !!}</p>
                    </div>
                </div>

                <!-- Project 6 -->
                <div class="project-folder" onclick="openGallery('project-tabarak')">
                    <div class="folder-shape">
                        <img src="{{ $resolveImg(theme_option('portfolio_6_img', 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&q=80&w=600')) }}" class="folder-preview" alt="{!! theme_option('portfolio_6_alt', 'Tabarak Runs') !!}">
                    </div>
                    <div class="folder-info">
                        <h3 class="folder-title">{!! theme_option('portfolio_6_title', 'TABARAK RUNS — CROSS-PAKISTAN 1,600KM RUN') !!}</h3>
                        <p class="folder-category">{!! theme_option('portfolio_6_category', 'Social Media | Content Production | Live Coverage') !!}</p>
                    </div>
                </div>

                <!-- Project 7 -->
                <div class="project-folder" onclick="openGallery('project-shehroze')">
                    <div class="folder-shape">
                        <img src="{{ $resolveImg(theme_option('portfolio_7_img', 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=600')) }}" class="folder-preview" alt="{!! theme_option('portfolio_7_alt', 'Shehroze Kashif') !!}">
                    </div>
                    <div class="folder-info">
                        <h3 class="folder-title">{!! theme_option('portfolio_7_title', 'SHEHROZE KASHIF — PROJECT 14×8000ER') !!}</h3>
                        <p class="folder-category">{!! theme_option('portfolio_7_category', 'Social Media Strategy | Content Creation | PR & Platform Management') !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Overlays -->
    <div id="project-iru" class="gallery-overlay">
        <i class="fas fa-times close-gallery" onclick="closeGallery('project-iru')"></i>
        <div class="gallery-header">
            <div class="gallery-title-row">
                <div class="event-initials-badge"><i class="fas fa-flag-checkered"></i><span>{!! theme_option('portfolio_1_badge', 'IRU') !!}</span></div>
                <h2>{!! theme_option('portfolio_gallery1_title_1', 'ISLAMABAD MARATHON') !!} <span class="highlight-text">{!! theme_option('portfolio_gallery1_title_2', '& IRU') !!}</span></h2>
            </div>
            <p class="text-xl opacity-80 max-w-4xl">{!! theme_option('portfolio_gallery1_desc', 'OD Sports has been the long-term digital and event partner for Islamabad Run With Us (IRU) since 2022 — supporting the Islamabad Marathon and Margalla Half Marathon through four consecutive editions. From social media management and digital campaigns to race-day coverage, live streaming, and press engagement, we have been involved in every layer of the event\'s growth. Our consistent digital strategies, high-quality visual storytelling, and community-first approach helped transform the Islamabad Marathon from a local run into Pakistan\'s most recognised annual marathon — a nationwide movement that inspires participation and promotes running culture across the country.') !!}</p>
            <div class="impact-stats">
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery1_stat1_num', '6,000+') !!}</h4><p>{!! theme_option('portfolio_gallery1_stat1_label', 'Participants') !!}</p></div>
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery1_stat2_num', '8.66M') !!}</h4><p>{!! theme_option('portfolio_gallery1_stat2_label', 'People Reached') !!}</p></div>
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery1_stat3_num', '191.1K') !!}</h4><p>{!! theme_option('portfolio_gallery1_stat3_label', 'Engagements') !!}</p></div>
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery1_stat4_num', '18.8M') !!}</h4><p>{!! theme_option('portfolio_gallery1_stat4_label', 'Video Views') !!}</p></div>
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery1_stat5_num', '381K+') !!}</h4><p>{!! theme_option('portfolio_gallery1_stat5_label', 'Live Stream Views') !!}</p></div>
            </div>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery1_img1', 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=800')) }}"></div>
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery1_img2', 'https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?auto=format&fit=crop&w=800')) }}"></div>
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery1_img3', 'https://images.unsplash.com/photo-1533560904424-a0c61dc306fc?auto=format&fit=crop&q=80&w=800')) }}"></div>
        </div>
    </div>

    <div id="project-mtr" class="gallery-overlay">
        <i class="fas fa-times close-gallery" onclick="closeGallery('project-mtr')"></i>
        <div class="gallery-header">
            <div class="gallery-title-row">
                <div class="event-initials-badge"><i class="fas fa-mountain"></i><span>{!! theme_option('portfolio_2_badge', 'MTR') !!}</span></div>
                <h2>{!! theme_option('portfolio_gallery2_title_1', 'MARGALLA TRAIL') !!} <span class="highlight-text">{!! theme_option('portfolio_gallery2_title_2', 'RUNNERS (MTR)') !!}</span></h2>
            </div>
            <p class="text-xl opacity-80 max-w-4xl">{!! theme_option('portfolio_gallery2_desc', 'Since 2024, OD Sports has served as the official media and digital partner for Margalla Trail Runners — covering the Galyat Mountain Trail, Backyard Ultra, Hill Half Marathon, and Trail Running Festival. We craft immersive digital narratives that capture the grit, endurance, and spirit of trail athletes competing in Pakistan\'s most demanding terrains. Each campaign combines strategic social media management, creative content production, live amplification, and cinematic race-day coverage — turning every race into a story that resonates with the wider running community and inspires new participants to step onto the trails.') !!}</p>
            <div class="impact-stats">
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery2_stat1_num', '476.3K') !!}</h4><p>{!! theme_option('portfolio_gallery2_stat1_label', 'People Reached') !!}</p></div>
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery2_stat2_num', '9.8K+') !!}</h4><p>{!! theme_option('portfolio_gallery2_stat2_label', 'Engagements') !!}</p></div>
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery2_stat3_num', '2.25M') !!}</h4><p>{!! theme_option('portfolio_gallery2_stat3_label', 'Video Views') !!}</p></div>
            </div>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery2_img1', 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&q=80&w=800')) }}"></div>
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery2_img2', 'https://images.unsplash.com/photo-1551854838-212c50b4c184?auto=format&fit=crop&q=80&w=800')) }}"></div>
        </div>
    </div>

    <div id="project-yourpace" class="gallery-overlay">
        <i class="fas fa-times close-gallery" onclick="closeGallery('project-yourpace')"></i>
        <div class="gallery-header">
            <div class="gallery-title-row">
                <div class="event-initials-badge"><i class="fas fa-running"></i><span>{!! theme_option('portfolio_3_badge', 'YOURPACE') !!}</span></div>
                <h2>{!! theme_option('portfolio_gallery3_title_1', 'YOURPACE BY') !!} <span class="highlight-text">{!! theme_option('portfolio_gallery3_title_2', 'INDRIVE') !!}</span></h2>
            </div>
            <p class="text-xl opacity-80 max-w-4xl">{!! theme_option('portfolio_gallery3_desc', 'OD Sports partnered with YourPace, an inDrive initiative, to make running accessible for children from underprivileged backgrounds. The project ran across two chapters, covering 6–7 schools over 3 weeks in Islamabad and Karachi, featuring structured training sessions, school races, and community activities. We managed end-to-end coverage including event documentation, race-day branding, social media content, and the production of the full programme documentary — highlighting participation, inclusivity, and the initiative\'s lasting impact on young runners across Pakistan.') !!}</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery3_img1', 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=800')) }}"></div>
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery3_img2', 'https://images.unsplash.com/photo-1502086223501-7ea244b2896e?auto=format&fit=crop&q=80&w=800')) }}"></div>
        </div>
    </div>

    <div id="project-twincity" class="gallery-overlay">
        <i class="fas fa-times close-gallery" onclick="closeGallery('project-twincity')"></i>
        <div class="gallery-header">
            <div class="gallery-title-row">
                <div class="event-initials-badge"><i class="fas fa-moon"></i><span>{!! theme_option('portfolio_4_badge', 'TCR') !!}</span></div>
                <h2>{!! theme_option('portfolio_gallery4_title_1', 'TWIN CITY RUN') !!} <span class="highlight-text">{!! theme_option('portfolio_gallery4_title_2', '& NIGHT RUN') !!}</span></h2>
            </div>
            <p class="text-xl opacity-80 max-w-4xl">{!! theme_option('portfolio_gallery4_desc', 'OD Sports delivered full digital and media campaigns for two of Islamabad\'s most popular urban races. For the Night Run, we provided live video coverage, real-time reels and stories, and on-ground documentation to amplify the event as it happened. For the Twin City Run, we executed a complete digital campaign — designing graphics, memes, and reels, alongside on-ground coverage and live social updates — ensuring maximum visibility and fan engagement throughout.') !!}</p>
            <div class="impact-stats">
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery4_stat1_num', '800K+') !!}</h4><p>{!! theme_option('portfolio_gallery4_stat1_label', 'People Reached') !!}</p></div>
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery4_stat2_num', '700K+') !!}</h4><p>{!! theme_option('portfolio_gallery4_stat2_label', 'Video Views') !!}</p></div>
                <div class="impact-item"><h4>{!! theme_option('portfolio_gallery4_stat3_num', '10K+') !!}</h4><p>{!! theme_option('portfolio_gallery4_stat3_label', 'Engagements') !!}</p></div>
            </div>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery4_img1', 'https://images.unsplash.com/photo-1571008887538-b36bb32f4571?auto=format&fit=crop&q=80&w=800')) }}"></div>
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery4_img2', 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&q=80&w=800')) }}"></div>
        </div>
    </div>

    <div id="project-irc" class="gallery-overlay">
        <i class="fas fa-times close-gallery" onclick="closeGallery('project-irc')"></i>
        <div class="gallery-header">
            <div class="gallery-title-row">
                <div class="event-initials-badge"><i class="fas fa-medal"></i><span>{!! theme_option('portfolio_5_badge', 'IRC') !!}</span></div>
                <h2>{!! theme_option('portfolio_gallery5_title_1', 'IRC') !!} <span class="highlight-text">{!! theme_option('portfolio_gallery5_title_2', 'RUNNING SERIES') !!}</span></h2>
            </div>
            <p class="text-xl opacity-80 max-w-4xl">{!! theme_option('portfolio_gallery5_desc', 'OD Sports supported the IRC Running Series across three race editions, delivering end-to-end event coverage including professional photography, drone videography, and participant testimonial production. Our visual storytelling captured the energy, community spirit, and key milestones of each race — strengthening the series\' visibility and documenting its growth for both participants and sponsors.') !!}</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery5_img1', 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&q=80&w=800')) }}"></div>
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery5_img2', 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=800')) }}"></div>
        </div>
    </div>

    <div id="project-tabarak" class="gallery-overlay">
        <i class="fas fa-times close-gallery" onclick="closeGallery('project-tabarak')"></i>
        <div class="gallery-header">
            <div class="gallery-title-row">
                <div class="event-initials-badge"><i class="fas fa-route"></i><span>{!! theme_option('portfolio_6_badge', 'TABARAK') !!}</span></div>
                <h2>{!! theme_option('portfolio_gallery6_title_1', 'TABARAK RUNS') !!} <span class="highlight-text">{!! theme_option('portfolio_gallery6_title_2', 'CROSS-PAKISTAN 1,600KM RUN') !!}</span></h2>
            </div>
            <p class="text-xl opacity-80 max-w-4xl">{!! theme_option('portfolio_gallery6_desc', 'OD Sports documented the historic start of Tabarak Rehman\'s cross-Pakistan run — the first man in Pakistan to run 1,600 km from Cadet College Hasan Abdal to IBA Karachi in 35 days, raising $1 million USD for The Citizens Foundation. We captured the launch event, key visuals, and on-ground moments while producing real-time social media content to amplify his mission — highlighting the scale, purpose, and national significance of this landmark initiative for education.') !!}</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery6_img1', 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&q=80&w=800')) }}"></div>
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery6_img2', 'https://images.unsplash.com/photo-1444491741275-3747c03c9964?auto=format&fit=crop&q=80&w=800')) }}"></div>
        </div>
    </div>

    <div id="project-shehroze" class="gallery-overlay">
        <i class="fas fa-times close-gallery" onclick="closeGallery('project-shehroze')"></i>
        <div class="gallery-header">
            <div class="gallery-title-row">
                <div class="event-initials-badge"><i class="fas fa-hiking"></i><span>{!! theme_option('portfolio_7_badge', '14×8000') !!}</span></div>
                <h2>{!! theme_option('portfolio_gallery7_title_1', 'SHEHROZE KASHIF') !!} <span class="highlight-text">{!! theme_option('portfolio_gallery7_title_2', 'PROJECT 14×8000ER') !!}</span></h2>
            </div>
            <p class="text-xl opacity-80 max-w-4xl">{!! theme_option('portfolio_gallery7_desc', 'OD Sports managed the complete social media strategy and content creation for Shehroze Kashif\'s Project 14×8000er — his historic endeavour to summit all 14 peaks above 8,000 metres. Over 9 months, we curated and produced video content, managed his GoFundMe campaign, and handled full PR and platform management — helping Shehroze connect with a global audience of supporters and amplify his mission throughout one of mountaineering\'s greatest challenges.') !!}</p>
        </div>
        <div class="gallery-grid">
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery7_img1', 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=800')) }}"></div>
            <div class="gallery-item"><img src="{{ $resolveImg(theme_option('portfolio_gallery7_img2', 'https://images.unsplash.com/photo-1544465544-1b71aee9dfa3?auto=format&fit=crop&q=80&w=800')) }}"></div>
        </div>
    </div>

    <script>
        function openGallery(id) {
            const gallery = document.getElementById(id);
            if(gallery) {
                gallery.classList.add('active');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeGallery(id) {
            const gallery = document.getElementById(id);
            if(gallery) {
                gallery.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
        }
    </script>
@endsection