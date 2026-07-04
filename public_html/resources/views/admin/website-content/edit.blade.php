@extends('core/base::layouts.master')

@section('content')
    <style>
        * { box-sizing: border-box; }
        body { background: #0f172a; }

        .form-section {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
        }

        .form-section-title {
            color: #60a5fa;
            font-weight: 700;
            font-size: 16px;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #334155;
            text-transform: uppercase;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            color: #94a3b8;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            background: #0f172a !important;
            border: 1px solid #475569;
            border-radius: 8px;
            padding: 12px 16px;
            color: #f1f5f9 !important;
            font-size: 14px;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
            background: #0f172a !important;
            color: #ffffff !important;
        }

        .form-control::placeholder {
            color: #475569 !important;
        }

        textarea.form-control {
            min-height: 100px;
            resize: vertical;
        }

        .card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 12px;
            margin-bottom: 8px;
        }

        .card-header {
            padding: 16px 20px;
            background: #0f172a;
            border-radius: 12px 12px 0 0;
        }

        .card-header h4 {
            color: #60a5fa;
            margin: 0;
            font-size: 16px;
        }

        .btn-primary {
            background: #3b82f6;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            color: white;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #334155;
            border: none;
            border-radius: 8px;
            padding: 12px 28px;
            color: #e2e8f0;
            font-weight: 600;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
        }

        .page-header h1 { color: #f1f5f9; font-size: 28px; margin-bottom: 8px; }
        .page-header p { color: #64748b; }

        /* Custom Image Widget */
        .custom-img-widget {
            background: #0f172a;
            border: 2px dashed #475569;
            border-radius: 10px;
            padding: 16px;
            text-align: center;
            transition: border-color 0.2s;
        }
        .custom-img-widget:hover { border-color: #3b82f6; }

        .img-preview-area {
            margin-bottom: 12px;
            border-radius: 8px;
            overflow: hidden;
            background: #1e293b;
            display: inline-block;
        }
        .img-preview-area .img-preview {
            max-width: 100%;
            max-height: 220px;
            display: block;
            border-radius: 8px;
            object-fit: contain;
            cursor: pointer;
        }

        .img-empty {
            padding: 30px 16px;
            color: #475569;
            font-size: 14px;
        }
        .img-empty i { font-size: 32px; display: block; margin-bottom: 8px; }

        .img-action-bar {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-top: 12px;
        }
        .img-act-btn {
            padding: 7px 16px;
            border: none;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: opacity 0.2s, background 0.2s;
        }
        .img-act-btn:disabled { opacity: 0.35; cursor: not-allowed; }
        .img-act-view  { background: #3b82f6; color: #fff; }
        .img-act-view:hover:not(:disabled) { background: #2563eb; }
        .img-act-replace { background: #22c55e; color: #fff; }
        .img-act-replace:hover { background: #16a34a; }

        /* Fullscreen Lightbox */
        .img-lightbox-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.92);
            z-index: 99999;
            justify-content: center;
            align-items: center;
            cursor: zoom-out;
        }
        .img-lightbox-overlay.active { display: flex; }
        .img-lightbox-overlay img {
            max-width: 92vw;
            max-height: 92vh;
            border-radius: 8px;
            box-shadow: 0 0 60px rgba(0,0,0,0.6);
        }
        .img-lightbox-close {
            position: fixed;
            top: 20px;
            right: 28px;
            background: rgba(239,68,68,0.9);
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            font-size: 20px;
            cursor: pointer;
            z-index: 100000;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>

    <div class="page-header">
        <h1>Edit: {{ $pageTitle }}</h1>
        <p>Manage content for this section</p>
    </div>

    <form method="POST" action="{{ route('admin.website-content.update', $pageId) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Publishing Section -->
        <div class="form-section">
            <div class="form-section-title">Publishing</div>
            
            <div class="form-group">
                <label>Publish Page?</label>
                <select name="published" class="form-control">
                    <option value="yes" {{ $pageData['published'] === 'yes' ? 'selected' : '' }}>Yes</option>
                    <option value="no" {{ $pageData['published'] === 'no' ? 'selected' : '' }}>No</option>
                </select>
            </div>
        </div>

        <!-- SEO Section -->
        <div class="form-section">
            <div class="form-section-title">SEO Settings</div>
            
            <div class="form-group">
                <label>SEO Title</label>
                <input type="text" name="seo_title" class="form-control" value="{{ old('seo_title', $pageData['seo_title']) }}" placeholder="SEO Title">
            </div>
            
            <div class="form-group">
                <label>SEO Description</label>
                <textarea name="seo_description" class="form-control" placeholder="SEO Description">{{ old('seo_description', $pageData['seo_description']) }}</textarea>
            </div>
        </div>



        @if($pageId === 'homepage')
<div class="form-section">
    <div class="form-section-title">Hero Section</div>
    <div class="form-group"><label>Hero Background Image</label>
        @include('admin.website-content._image_field', ['name' => 'hero_bg', 'value' => old('hero_bg', theme_option('homepage_hero_bg', 'landing-assets/images/hero-bg2.jpg'))])</div>
    <div class="form-group"><label>Badge Text</label>
        <input type="text" name="badge" class="form-control" value="{{ old('badge', theme_option('homepage_badge', 'ESTABLISHED 2022')) }}"></div>
    <div class="form-group"><label>Main Heading</label>
        <textarea name="heading" class="form-control">{{ old('heading', theme_option('homepage_heading', 'WE PLAN, PROMOTE & PRODUCE <span class="highlight">SPORTS EVENTS</span> ACROSS PAKISTAN')) }}</textarea></div>
    <div class="form-group"><label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', theme_option('homepage_description', 'From grassroots runs to national marathons — OD Sports is the end-to-end sports agency trusted by Pakistan\'s biggest events, brands and federations.')) }}</textarea></div>
    <div class="form-group"><label>Primary Button Text</label>
        <input type="text" name="btn_primary" class="form-control" value="{{ old('btn_primary', theme_option('homepage_btn_primary', 'BOOK A MEETING')) }}"></div>
    <div class="form-group"><label>Secondary Button Text</label>
        <input type="text" name="btn_secondary" class="form-control" value="{{ old('btn_secondary', theme_option('homepage_btn_secondary', 'SEE OUR WORK')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Ticker Bar</div>
    <div class="form-group"><label>Ticker Item 1</label>
        <input type="text" name="ticker_1" class="form-control" value="{{ old('ticker_1', theme_option('homepage_ticker_1', '18.6M+ VIDEO VIEWS')) }}"></div>
    <div class="form-group"><label>Ticker Item 2</label>
        <input type="text" name="ticker_2" class="form-control" value="{{ old('ticker_2', theme_option('homepage_ticker_2', '● 8.66M+ PEOPLE REACHED')) }}"></div>
    <div class="form-group"><label>Ticker Item 3</label>
        <input type="text" name="ticker_3" class="form-control" value="{{ old('ticker_3', theme_option('homepage_ticker_3', '● 6,000+ MARATHON PARTICIPANTS')) }}"></div>
    <div class="form-group"><label>Ticker Item 4</label>
        <input type="text" name="ticker_4" class="form-control" value="{{ old('ticker_4', theme_option('homepage_ticker_4', '● 25+ EVENTS DELIVERED')) }}"></div>
    <div class="form-group"><label>Ticker Item 5</label>
        <input type="text" name="ticker_5" class="form-control" value="{{ old('ticker_5', theme_option('homepage_ticker_5', '● 3+ YEARS AS PAKISTAN\'S #1 SPORTS AGENCY')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Expertise Section</div>
    <div class="form-group"><label>Section Title</label>
        <textarea name="expertise_title" class="form-control">{{ old('expertise_title', theme_option('homepage_expertise_title', 'WHERE SPORT MEETS <span class="highlight">STRATEGY</span>')) }}</textarea></div>
    <div class="form-group"><label>Section Subtitle</label>
        <textarea name="expertise_subtitle" class="form-control">{{ old('expertise_subtitle', theme_option('homepage_expertise_subtitle', 'From Islamabad to Karachi, Lahore to Galyat — OD Sports brings local and national sports events, clubs, and brands to life.')) }}</textarea></div>
    <div class="form-group"><label>Banner Image URL</label>
        @include('admin.website-content._image_field', ['name' => 'expertise_img_1', 'value' => old('expertise_img_1', theme_option('homepage_expertise_img_1', 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&q=80&w=2000'))])</div>
    <div class="form-group"><label>Main Title</label>
        <textarea name="expertise_main_title" class="form-control">{{ old('expertise_main_title', theme_option('homepage_expertise_main_title', 'PAKISTAN\'S MOST TRUSTED <br><span class="highlight">SPORTS AGENCY</span>')) }}</textarea></div>
    <div class="form-group"><label>Description Paragraph 1</label>
        <textarea name="expertise_main_desc_1" class="form-control">{{ old('expertise_main_desc_1', theme_option('homepage_expertise_main_desc_1', 'OD Sports is a full-service sports agency built at the intersection of sport, media, and creativity.')) }}</textarea></div>
    <div class="form-group"><label>Description Paragraph 2</label>
        <textarea name="expertise_main_desc_2" class="form-control">{{ old('expertise_main_desc_2', theme_option('homepage_expertise_main_desc_2', 'From the Islamabad Marathon to trail races in the Himalayas, we don\'t just show up. We understand the game, the audience, and what it takes to make every moment matter.')) }}</textarea></div>
    <div class="form-group"><label>Side Image URL</label>
        @include('admin.website-content._image_field', ['name' => 'expertise_img_2', 'value' => old('expertise_img_2', theme_option('homepage_expertise_img_2', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?auto=format&fit=crop&q=80&w=1200'))])</div>
    <div class="form-group"><label>Button Text</label>
        <input type="text" name="expertise_btn" class="form-control" value="{{ old('expertise_btn', theme_option('homepage_expertise_btn', 'LEARN OUR STORY')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Services Grid</div>
    <div class="form-group"><label>Services Section Title</label>
        <textarea name="services_title" class="form-control">{{ old('services_title', theme_option('homepage_services_title', 'Full-Service Sports Solutions for Every Game')) }}</textarea></div>
    <div class="form-group"><label>Services Section Subtitle</label>
        <textarea name="services_subtitle" class="form-control">{{ old('services_subtitle', theme_option('homepage_services_subtitle', 'OD Sports is Pakistan\'s Most Trusted Sports Agency — delivering complete solutions for sports events, teams, and brands across the country.')) }}</textarea></div>
    <div class="form-group"><label>Service 1 Title</label>
        <input type="text" name="service_1_title" class="form-control" value="{{ old('service_1_title', theme_option('homepage_service_1_title', 'Sports Event Management')) }}"></div>
    <div class="form-group"><label>Service 1 Description</label>
        <textarea name="service_1_desc" class="form-control">{{ old('service_1_desc', theme_option('homepage_service_1_desc', 'End-to-end planning, logistics, on-ground execution, and post-event reporting for every type of sports event in Pakistan.')) }}</textarea></div>
    <div class="form-group"><label>Service 1 Button Text</label>
        <input type="text" name="service_1_btn" class="form-control" value="{{ old('service_1_btn', theme_option('homepage_service_1_btn', 'LEARN MORE')) }}"></div>
    <div class="form-group"><label>Service 2 Title</label>
        <input type="text" name="service_2_title" class="form-control" value="{{ old('service_2_title', theme_option('homepage_service_2_title', 'Sports Media Production')) }}"></div>
    <div class="form-group"><label>Service 2 Description</label>
        <textarea name="service_2_desc" class="form-control">{{ old('service_2_desc', theme_option('homepage_service_2_desc', 'Professional photography, cinematic videography, live streaming, and short-form content that captures every moment and drives real reach.')) }}</textarea></div>
    <div class="form-group"><label>Service 2 Button Text</label>
        <input type="text" name="service_2_btn" class="form-control" value="{{ old('service_2_btn', theme_option('homepage_service_2_btn', 'LEARN MORE')) }}"></div>
    <div class="form-group"><label>Service 3 Title</label>
        <input type="text" name="service_3_title" class="form-control" value="{{ old('service_3_title', theme_option('homepage_service_3_title', 'Sports Marketing & Strategy')) }}"></div>
    <div class="form-group"><label>Service 3 Description</label>
        <textarea name="service_3_desc" class="form-control">{{ old('service_3_desc', theme_option('homepage_service_3_desc', 'Full-cycle digital campaigns, social media management, PR outreach, and community building for sports events and brands.')) }}</textarea></div>
    <div class="form-group"><label>Service 3 Button Text</label>
        <input type="text" name="service_3_btn" class="form-control" value="{{ old('service_3_btn', theme_option('homepage_service_3_btn', 'LEARN MORE')) }}"></div>
    <div class="form-group"><label>Service 4 Title</label>
        <input type="text" name="service_4_title" class="form-control" value="{{ old('service_4_title', theme_option('homepage_service_4_title', 'Digital Campaign Design')) }}"></div>
    <div class="form-group"><label>Service 4 Description</label>
        <textarea name="service_4_desc" class="form-control">{{ old('service_4_desc', theme_option('homepage_service_4_desc', 'Bold, sport-first creative — social templates, motion graphics, countdown content, event posters, and branded digital kits.')) }}</textarea></div>
    <div class="form-group"><label>Service 4 Button Text</label>
        <input type="text" name="service_4_btn" class="form-control" value="{{ old('service_4_btn', theme_option('homepage_service_4_btn', 'LEARN MORE')) }}"></div>
    <div class="form-group"><label>Service 6 Title</label>
        <input type="text" name="service_6_title" class="form-control" value="{{ old('service_6_title', theme_option('homepage_service_6_title', 'Influencer & Athlete Marketing')) }}"></div>
    <div class="form-group"><label>Service 6 Description</label>
        <textarea name="service_6_desc" class="form-control">{{ old('service_6_desc', theme_option('homepage_service_6_desc', 'Authentic partnerships with Pakistan\'s top fitness influencers, athletes, and community leaders to amplify your campaign.')) }}</textarea></div>
    <div class="form-group"><label>Service 6 Button Text</label>
        <input type="text" name="service_6_btn" class="form-control" value="{{ old('service_6_btn', theme_option('homepage_service_6_btn', 'LEARN MORE')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Blogs & Featured Gears Section</div>
    <div class="form-group"><label>Blogs Heading</label>
        <input type="text" name="blogs_title" class="form-control" value="{{ old('blogs_title', theme_option('homepage_blogs_title', 'BLOGS')) }}"></div>
    <div class="form-group"><label>Gears Title</label>
        <textarea name="gears_title" class="form-control">{{ old('gears_title', theme_option('homepage_gears_title', 'FEATURED <span class="highlight">GEARS</span>')) }}</textarea></div>
    <div class="form-group"><label>Gears Subtitle</label>
        <input type="text" name="gears_subtitle" class="form-control" value="{{ old('gears_subtitle', theme_option('homepage_gears_subtitle', 'Professional grade equipment and apparel for serious athletes.')) }}"></div>
    <div class="form-group"><label>Add to Cart Button Text</label>
        <input type="text" name="gears_add_to_cart" class="form-control" value="{{ old('gears_add_to_cart', theme_option('homepage_gears_add_to_cart', 'ADD TO CART')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Gear/Product Images (Featured Products)</div>
    <p style="color: #94a3b8; font-size: 13px; margin-bottom: 20px;">These are the product images shown in the Gears section. Replacing an image here updates the actual product image everywhere on the site.</p>
    @foreach($featuredProducts as $index => $product)
    @php
        $prodImgs = $product->images;
        $prodImgRaw = !empty($prodImgs[0]) ? $prodImgs[0] : '';
        $prodImgDisplay = '';
        if ($prodImgRaw) {
            if (str_starts_with($prodImgRaw, 'http://') || str_starts_with($prodImgRaw, 'https://')) {
                $prodImgDisplay = $prodImgRaw;
            } elseif (file_exists(public_path($prodImgRaw))) {
                $prodImgDisplay = asset($prodImgRaw);
            } else {
                $prodImgDisplay = RvMedia::getImageUrl($prodImgRaw, null, false, RvMedia::getDefaultImage());
            }
        }
    @endphp
    <div class="form-group">
        <label>Product {{ $index + 1 }}: {{ $product->name }}</label>
        <input type="hidden" name="gear_product_id_{{ $index }}" value="{{ $product->id }}">
        <div class="custom-img-widget" data-name="gear_{{ $index }}_img">
            <input type="hidden" name="gear_{{ $index }}_img" value="{{ $prodImgRaw }}" class="img-value">
            <input type="file" name="gear_{{ $index }}_img_file" accept="image/*" class="img-file-input" style="display:none;">

            <div class="img-preview-area" @if(!$prodImgDisplay) style="display:none;" @endif>
                <img src="{{ $prodImgDisplay }}" alt="Preview" class="img-preview">
            </div>

            <div class="img-empty" @if($prodImgDisplay) style="display:none;" @endif>
                <i class="fa fa-image"></i>
                <span>No image</span>
            </div>

            <div class="img-action-bar">
                <button type="button" class="img-act-btn img-act-view" title="View Full Size" @if(!$prodImgDisplay) disabled @endif>
                    <i class="fa fa-eye"></i> View
                </button>
                <button type="button" class="img-act-btn img-act-replace" title="Choose from PC">
                    <i class="fa fa-upload"></i> Replace
                </button>
            </div>
        </div>
    </div>
    @endforeach
    @if($featuredProducts->isEmpty())
        <p style="color: #64748b;">No featured products found. Mark products as "Featured" in the Ecommerce module to manage their images here.</p>
    @endif
</div>

<div class="form-section">
    <div class="form-section-title">Featured Projects Section</div>
    <div class="form-group"><label>Section Badge</label>
        <textarea name="portfolio_badge" class="form-control">{{ old('portfolio_badge', theme_option('homepage_portfolio_badge', 'FEATURED <span class="highlight">PROJECTS</span>')) }}</textarea></div>
    <div class="form-group"><label>Section Title</label>
        <textarea name="portfolio_title" class="form-control">{{ old('portfolio_title', theme_option('homepage_portfolio_title', 'FROM THE FIELD <span class="outline-text">TO THE FEED</span>')) }}</textarea></div>
    <div class="form-group"><label>Section Subtitle</label>
        <textarea name="portfolio_subtitle" class="form-control">{{ old('portfolio_subtitle', theme_option('homepage_portfolio_subtitle', 'We\'ve been behind some of Pakistan\'s biggest sports moments. Here\'s a taste of what we\'ve built.')) }}</textarea></div>
    <div class="form-group"><label>Project 1 Image URL</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_1_img', 'value' => old('portfolio_1_img', theme_option('homepage_portfolio_1_img', 'portfolio/marathon_race_day.png'))])</div>
    <div class="form-group"><label>Project 1 Tag</label>
        <input type="text" name="portfolio_1_tag" class="form-control" value="{{ old('portfolio_1_tag', theme_option('homepage_portfolio_1_tag', 'MARATHON 2022-2025')) }}"></div>
    <div class="form-group"><label>Project 1 Title</label>
        <input type="text" name="portfolio_1_title" class="form-control" value="{{ old('portfolio_1_title', theme_option('homepage_portfolio_1_title', 'Islamabad Marathon 2022–2025')) }}"></div>
    <div class="form-group"><label>Project 1 Description</label>
        <textarea name="portfolio_1_desc" class="form-control">{{ old('portfolio_1_desc', theme_option('homepage_portfolio_1_desc', '3-year ongoing digital and event partner. Grew the event from 500 to 6,000+ participants. Delivered 18.6M video views and reached 8.66M people.')) }}</textarea></div>
    <div class="form-group"><label>Project 1 Button Text</label>
        <input type="text" name="portfolio_1_btn" class="form-control" value="{{ old('portfolio_1_btn', theme_option('homepage_portfolio_1_btn', 'VIEW CASE STUDY')) }}"></div>
    <div class="form-group"><label>Project 2 Image URL</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_2_img', 'value' => old('portfolio_2_img', theme_option('homepage_portfolio_2_img', 'portfolio/kids_running.png'))])</div>
    <div class="form-group"><label>Project 2 Tag</label>
        <input type="text" name="portfolio_2_tag" class="form-control" value="{{ old('portfolio_2_tag', theme_option('homepage_portfolio_2_tag', 'KIDS RUNNING')) }}"></div>
    <div class="form-group"><label>Project 2 Title</label>
        <input type="text" name="portfolio_2_title" class="form-control" value="{{ old('portfolio_2_title', theme_option('homepage_portfolio_2_title', 'YourPace by inDrive')) }}"></div>
    <div class="form-group"><label>Project 2 Description</label>
        <textarea name="portfolio_2_desc" class="form-control">{{ old('portfolio_2_desc', theme_option('homepage_portfolio_2_desc', 'Pakistan launch of a global kids running movement. Multi-city execution across Islamabad and Karachi — branding, event management, and full documentary production.')) }}</textarea></div>
    <div class="form-group"><label>Project 3 Image URL</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_3_img', 'value' => old('portfolio_3_img', theme_option('homepage_portfolio_3_img', 'portfolio/trail_runner.png'))])</div>
    <div class="form-group"><label>Project 3 Tag</label>
        <input type="text" name="portfolio_3_tag" class="form-control" value="{{ old('portfolio_3_tag', theme_option('homepage_portfolio_3_tag', 'TRAIL RUNNING')) }}"></div>
    <div class="form-group"><label>Project 3 Title</label>
        <input type="text" name="portfolio_3_title" class="form-control" value="{{ old('portfolio_3_title', theme_option('homepage_portfolio_3_title', 'Galyat Mountain Trail & Margalla Trail Runners')) }}"></div>
    <div class="form-group"><label>Project 3 Description</label>
        <textarea name="portfolio_3_desc" class="form-control">{{ old('portfolio_3_desc', theme_option('homepage_portfolio_3_desc', 'Official media partner for MTR since 2024. Covered the Backyard Ultra, Hill Half Marathon, and Trail Running Festival with cinematic productions that reached 476K+ people.')) }}</textarea></div>
    <div class="form-group"><label>Portfolio Button Text</label>
        <input type="text" name="portfolio_btn" class="form-control" value="{{ old('portfolio_btn', theme_option('homepage_portfolio_btn', 'VIEW FULL PORTFOLIO')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Stats Section</div>
    <div class="form-group"><label>Background Image URL</label>
        @include('admin.website-content._image_field', ['name' => 'stats_bg', 'value' => old('stats_bg', theme_option('homepage_stats_bg', 'https://images.unsplash.com/photo-1533560904424-a0c61dc306fc?auto=format&fit=crop&q=80&w=2000'))])</div>
    <div class="form-group"><label>Stat 1 Number</label>
        <input type="text" name="stat_1_number" class="form-control" value="{{ old('stat_1_number', theme_option('homepage_stat_1_number', '18.6M+')) }}"></div>
    <div class="form-group"><label>Stat 1 Label</label>
        <input type="text" name="stat_1_label" class="form-control" value="{{ old('stat_1_label', theme_option('homepage_stat_1_label', 'VIDEO VIEWS')) }}"></div>
    <div class="form-group"><label>Stat 2 Number</label>
        <input type="text" name="stat_2_number" class="form-control" value="{{ old('stat_2_number', theme_option('homepage_stat_2_number', '8.66M+')) }}"></div>
    <div class="form-group"><label>Stat 2 Label</label>
        <input type="text" name="stat_2_label" class="form-control" value="{{ old('stat_2_label', theme_option('homepage_stat_2_label', 'PEOPLE REACHED')) }}"></div>
    <div class="form-group"><label>Stat 3 Number</label>
        <input type="text" name="stat_3_number" class="form-control" value="{{ old('stat_3_number', theme_option('homepage_stat_3_number', '6,000+')) }}"></div>
    <div class="form-group"><label>Stat 3 Label</label>
        <input type="text" name="stat_3_label" class="form-control" value="{{ old('stat_3_label', theme_option('homepage_stat_3_label', 'MARATHON PARTICIPANTS')) }}"></div>
    <div class="form-group"><label>Stat 4 Number</label>
        <input type="text" name="stat_4_number" class="form-control" value="{{ old('stat_4_number', theme_option('homepage_stat_4_number', '25+')) }}"></div>
    <div class="form-group"><label>Stat 4 Label</label>
        <input type="text" name="stat_4_label" class="form-control" value="{{ old('stat_4_label', theme_option('homepage_stat_4_label', 'EVENTS DELIVERED')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Testimonials Section</div>
    <div class="form-group"><label>Section Title</label>
        <input type="text" name="testimonials_title" class="form-control" value="{{ old('testimonials_title', theme_option('homepage_testimonials_title', 'TRUSTED BY PAKISTAN\'S SPORTS COMMUNITY')) }}"></div>
    <div class="form-group"><label>Testimonial 1 Photo URL</label>
        @include('admin.website-content._image_field', ['name' => 'testimonial_1_img', 'value' => old('testimonial_1_img', theme_option('homepage_testimonial_1_img', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=200'))])</div>
    <div class="form-group"><label>Testimonial 1 Name</label>
        <input type="text" name="testimonial_1_name" class="form-control" value="{{ old('testimonial_1_name', theme_option('homepage_testimonial_1_name', 'Qasim Naz')) }}"></div>
    <div class="form-group"><label>Testimonial 1 Title</label>
        <input type="text" name="testimonial_1_title" class="form-control" value="{{ old('testimonial_1_title', theme_option('homepage_testimonial_1_title', 'Founder, Islamabad Run With Us (IRU)')) }}"></div>
    <div class="form-group"><label>Testimonial 1 Quote</label>
        <textarea name="testimonial_1_quote" class="form-control">{{ old('testimonial_1_quote', theme_option('homepage_testimonial_1_quote', 'Optimize Digital has been an integral partner in the journey of the Islamabad Marathon — the pioneer marathon in Pakistan.')) }}</textarea></div>
    <div class="form-group"><label>Testimonial 2 Photo URL</label>
        @include('admin.website-content._image_field', ['name' => 'testimonial_2_img', 'value' => old('testimonial_2_img', theme_option('homepage_testimonial_2_img', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=200'))])</div>
    <div class="form-group"><label>Testimonial 2 Name</label>
        <input type="text" name="testimonial_2_name" class="form-control" value="{{ old('testimonial_2_name', theme_option('homepage_testimonial_2_name', 'Brent Weigner')) }}"></div>
    <div class="form-group"><label>Testimonial 2 Title</label>
        <input type="text" name="testimonial_2_title" class="form-control" value="{{ old('testimonial_2_title', theme_option('homepage_testimonial_2_title', 'Globally Renowned Running Icon')) }}"></div>
    <div class="form-group"><label>Testimonial 2 Quote</label>
        <textarea name="testimonial_2_quote" class="form-control">{{ old('testimonial_2_quote', theme_option('homepage_testimonial_2_quote', 'I\'ve never seen this level of Facebook and Instagram coverage for any event before. It was brilliant — timely, engaging, and incredibly well done.')) }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Contact Section</div>
    <div class="form-group"><label>Section Title</label>
        <textarea name="contact_title" class="form-control">{{ old('contact_title', theme_option('homepage_contact_title', 'READY TO TAKE YOUR <br><span class="highlight">SPORTS BRAND FURTHER?</span>')) }}</textarea></div>
    <div class="form-group"><label>Section Subtitle</label>
        <textarea name="contact_subtitle" class="form-control">{{ old('contact_subtitle', theme_option('homepage_contact_subtitle', 'Whether you\'re organising a city-wide run, launching an athleisure brand, or building a cricket community — OD Sports is the team that gets it done.')) }}</textarea></div>
    <div class="form-group"><label>Checklist Item 1</label>
        <input type="text" name="contact_check_1" class="form-control" value="{{ old('contact_check_1', theme_option('homepage_contact_check_1', 'Professional Event Execution')) }}"></div>
    <div class="form-group"><label>Checklist Item 2</label>
        <input type="text" name="contact_check_2" class="form-control" value="{{ old('contact_check_2', theme_option('homepage_contact_check_2', 'Digital Visibility & Growth')) }}"></div>
    <div class="form-group"><label>Checklist Item 3</label>
        <input type="text" name="contact_check_3" class="form-control" value="{{ old('contact_check_3', theme_option('homepage_contact_check_3', 'Expert Sports Storytelling')) }}"></div>
    <div class="form-group"><label>Form: Name Placeholder</label>
        <input type="text" name="contact_form_name" class="form-control" value="{{ old('contact_form_name', theme_option('homepage_contact_form_name', 'Your Name')) }}"></div>
    <div class="form-group"><label>Form: Organization Placeholder</label>
        <input type="text" name="contact_form_org" class="form-control" value="{{ old('contact_form_org', theme_option('homepage_contact_form_org', 'Organization/Brand')) }}"></div>
    <div class="form-group"><label>Form: Service Dropdown Label</label>
        <input type="text" name="contact_form_service_label" class="form-control" value="{{ old('contact_form_service_label', theme_option('homepage_contact_form_service_label', 'Interested Service')) }}"></div>
    <div class="form-group"><label>Form: Service Option 1</label>
        <input type="text" name="contact_form_service_1" class="form-control" value="{{ old('contact_form_service_1', theme_option('homepage_contact_form_service_1', 'Event Management')) }}"></div>
    <div class="form-group"><label>Form: Service Option 2</label>
        <input type="text" name="contact_form_service_2" class="form-control" value="{{ old('contact_form_service_2', theme_option('homepage_contact_form_service_2', 'Media Production')) }}"></div>
    <div class="form-group"><label>Form: Service Option 3</label>
        <input type="text" name="contact_form_service_3" class="form-control" value="{{ old('contact_form_service_3', theme_option('homepage_contact_form_service_3', 'Sports Marketing')) }}"></div>
    <div class="form-group"><label>Form: Service Option 4</label>
        <input type="text" name="contact_form_service_4" class="form-control" value="{{ old('contact_form_service_4', theme_option('homepage_contact_form_service_4', 'Digital Campaign Design')) }}"></div>
    <div class="form-group"><label>Form: Service Option 6</label>
        <input type="text" name="contact_form_service_6" class="form-control" value="{{ old('contact_form_service_6', theme_option('homepage_contact_form_service_6', 'Influencer Marketing')) }}"></div>
    <div class="form-group"><label>Form: Message Placeholder</label>
        <textarea name="contact_form_message" class="form-control">{{ old('contact_form_message', theme_option('homepage_contact_form_message', 'Tell us about your sports project...')) }}</textarea></div>
    <div class="form-group"><label>Form: Submit Button Text</label>
        <input type="text" name="contact_form_btn" class="form-control" value="{{ old('contact_form_btn', theme_option('homepage_contact_form_btn', 'BOOK A FREE STRATEGY CALL')) }}"></div>
    <div class="form-group"><label>Form: Mini Label (e.g. "Free Consultation")</label>
        <input type="text" name="contact_form_label" class="form-control" value="{{ old('contact_form_label', theme_option('homepage_contact_form_label', 'Free Consultation')) }}"></div>
    <div class="form-group"><label>Form: Sub-Heading (e.g. "Book Your Strategy Call")</label>
        <input type="text" name="contact_form_heading" class="form-control" value="{{ old('contact_form_heading', theme_option('homepage_contact_form_heading', 'Book Your Strategy Call')) }}"></div>
    <div class="form-group"><label>Form: Trust Text Below Button</label>
        <input type="text" name="contact_form_trust" class="form-control" value="{{ old('contact_form_trust', theme_option('homepage_contact_form_trust', 'No spam. Free consultation. No commitment.')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">YouTube Videos Section</div>
    <div class="form-group"><label>Section Label (small text above title)</label>
        <input type="text" name="videos_label" class="form-control" value="{{ old('videos_label', theme_option('homepage_videos_label', 'OD SPORTS')) }}"></div>
    <div class="form-group"><label>Section Title</label>
        <input type="text" name="videos_title" class="form-control" value="{{ old('videos_title', theme_option('homepage_videos_title', 'WATCH OUR WORK')) }}"></div>
    <div class="form-group"><label>Section Subtitle</label>
        <textarea name="videos_subtitle" class="form-control">{{ old('videos_subtitle', theme_option('homepage_videos_subtitle', 'Behind-the-lens footage from Pakistan\'s biggest sports events.')) }}</textarea></div>
    <p style="color:#94a3b8;font-size:13px;margin:0 0 16px;">Enter the YouTube Video ID (the part after <code>youtu.be/</code>). Clear the ID field to hide a video slot.</p>
    @for($vi = 1; $vi <= 10; $vi++)
    <div style="background:#1a1a1a;border:1px solid #2a2a2a;border-radius:8px;padding:16px;margin-bottom:12px;">
        <p style="color:#8ddf0d;font-size:12px;font-weight:700;margin:0 0 10px;">VIDEO {{ $vi }}</p>
        <div class="form-group" style="margin-bottom:10px;"><label>Video ID</label>
            <input type="text" name="video_{{ $vi }}_id" class="form-control" value="{{ old('video_'.$vi.'_id', $pageData['video_'.$vi.'_id'] ?? '') }}" placeholder="e.g. z3OUvM8NgNU"></div>
        <div class="form-group" style="margin-bottom:10px;"><label>Video Title</label>
            <input type="text" name="video_{{ $vi }}_title" class="form-control" value="{{ old('video_'.$vi.'_title', $pageData['video_'.$vi.'_title'] ?? '') }}"></div>
        <div class="form-group" style="margin-bottom:0;"><label>Video Tag</label>
            <input type="text" name="video_{{ $vi }}_tag" class="form-control" value="{{ old('video_'.$vi.'_tag', $pageData['video_'.$vi.'_tag'] ?? '') }}" placeholder="e.g. MARATHON"></div>
    </div>
    @endfor
    <div class="form-group"><label>Channel URL</label>
        <input type="text" name="videos_channel_url" class="form-control" value="{{ old('videos_channel_url', theme_option('homepage_videos_channel_url', 'https://www.youtube.com/@ODSportspk')) }}"></div>
    <div class="form-group"><label>Channel Button Text</label>
        <input type="text" name="videos_channel_btn" class="form-control" value="{{ old('videos_channel_btn', theme_option('homepage_videos_channel_btn', 'View Full YouTube Channel')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Latest Blogs Section</div>
    <div class="form-group"><label>Section Label (small text above title)</label>
        <input type="text" name="blogs_label" class="form-control" value="{{ old('blogs_label', theme_option('homepage_blogs_label', 'OD SPORTS')) }}"></div>
    <div class="form-group"><label>Section Title</label>
        <input type="text" name="blogs_section_title" class="form-control" value="{{ old('blogs_section_title', theme_option('homepage_blogs_section_title', 'LATEST BLOGS')) }}"></div>
    <div class="form-group"><label>Section Subtitle</label>
        <textarea name="blogs_subtitle" class="form-control">{{ old('blogs_subtitle', theme_option('homepage_blogs_subtitle', 'Insights, stories, and updates from Pakistan\'s sports scene.')) }}</textarea></div>
    <div class="form-group"><label>View All Button Text</label>
        <input type="text" name="blogs_btn" class="form-control" value="{{ old('blogs_btn', theme_option('homepage_blogs_btn', 'VIEW ALL BLOGS')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Team Section</div>
    <div class="form-group"><label>Section Title</label>
        <textarea name="team_title" class="form-control">{{ old('team_title', theme_option('homepage_team_title', 'THE TEAM BEHIND <span class="highlight">THE MOMENTS</span>')) }}</textarea></div>
    <div class="form-group"><label>Section Subtitle</label>
        <textarea name="team_subtitle" class="form-control">{{ old('team_subtitle', theme_option('homepage_team_subtitle', 'A passionate crew of creatives, strategists, and sports enthusiasts driving every project forward.')) }}</textarea></div>
    <div class="form-group"><label>Member 1 Photo URL</label>
        @include('admin.website-content._image_field', ['name' => 'team_1_img', 'value' => old('team_1_img', theme_option('homepage_team_1_img', 'landing-assets/images/Imran Ghazli 1x1.png'))])</div>
    <div class="form-group"><label>Member 1 Name</label>
        <input type="text" name="team_1_name" class="form-control" value="{{ old('team_1_name', theme_option('homepage_team_1_name', 'Imran Ghazali')) }}"></div>
    <div class="form-group"><label>Member 1 Title</label>
        <input type="text" name="team_1_title" class="form-control" value="{{ old('team_1_title', theme_option('homepage_team_1_title', 'Founder & CEO')) }}"></div>
    <div class="form-group"><label>Member 2 Photo URL</label>
        @include('admin.website-content._image_field', ['name' => 'team_2_img', 'value' => old('team_2_img', theme_option('homepage_team_2_img', 'landing-assets/images/Aqib Mughal.jpg'))])</div>
    <div class="form-group"><label>Member 2 Name</label>
        <input type="text" name="team_2_name" class="form-control" value="{{ old('team_2_name', theme_option('homepage_team_2_name', 'Aqib Mughal')) }}"></div>
    <div class="form-group"><label>Member 2 Title</label>
        <input type="text" name="team_2_title" class="form-control" value="{{ old('team_2_title', theme_option('homepage_team_2_title', 'Director, Client Relations & Ops')) }}"></div>
    <div class="form-group"><label>Member 3 Photo URL</label>
        @include('admin.website-content._image_field', ['name' => 'team_3_img', 'value' => old('team_3_img', theme_option('homepage_team_3_img', 'landing-assets/images/Laiba Shakeel.jpg'))])</div>
    <div class="form-group"><label>Member 3 Name</label>
        <input type="text" name="team_3_name" class="form-control" value="{{ old('team_3_name', theme_option('homepage_team_3_name', 'Laiba Shakeel')) }}"></div>
    <div class="form-group"><label>Member 3 Title</label>
        <input type="text" name="team_3_title" class="form-control" value="{{ old('team_3_title', theme_option('homepage_team_3_title', 'Senior Manager, Digital')) }}"></div>
    <div class="form-group"><label>Member 4 Photo URL</label>
        @include('admin.website-content._image_field', ['name' => 'team_4_img', 'value' => old('team_4_img', theme_option('homepage_team_4_img', 'landing-assets/images/Naeem Ansab.JPG'))])</div>
    <div class="form-group"><label>Member 4 Name</label>
        <input type="text" name="team_4_name" class="form-control" value="{{ old('team_4_name', theme_option('homepage_team_4_name', 'Ansab Naeem')) }}"></div>
    <div class="form-group"><label>Member 4 Title</label>
        <input type="text" name="team_4_title" class="form-control" value="{{ old('team_4_title', theme_option('homepage_team_4_title', 'Director, Media Production')) }}"></div>
    <div class="form-group"><label>Team Button Text</label>
        <input type="text" name="team_btn" class="form-control" value="{{ old('team_btn', theme_option('homepage_team_btn', 'MEET THE FULL TEAM')) }}"></div>
</div>
@endif

        @if($pageId === 'services_index')
<div class="form-section">
    <div class="form-section-title">Hero Section</div>
    <div class="form-group"><label>Page Title (Browser Tab)</label>
        <input type="text" name="page_title" class="form-control" value="{{ old('page_title', theme_option('services_index_page_title', 'Our Services - OD Sports')) }}"></div>
    <div class="form-group"><label>Hero Background Image</label>
        @include('admin.website-content._image_field', ['name' => 'hero_img', 'value' => old('hero_img', theme_option('services_index_hero_img', 'https://images.unsplash.com/photo-1579952363873-27f3bade9f55?auto=format&fit=crop&w=2000&q=80'))])</div>
    <div class="form-group"><label>Hero Title</label>
        <textarea name="hero_title" class="form-control">{{ old('hero_title', theme_option('services_index_hero_title', 'Full-Service Sports Solutions — From Ideation to Execution')) }}</textarea></div>
    <div class="form-group"><label>Hero Subtitle</label>
        <textarea name="hero_subtitle" class="form-control">{{ old('hero_subtitle', theme_option('services_index_hero_subtitle', 'Every service we offer is built for the sports world.')) }}</textarea></div>
    <div class="form-group"><label>Services Section Title</label>
        <input type="text" name="section_title" class="form-control" value="{{ old('section_title', theme_option('services_index_section_title', 'END-TO-END SOLUTIONS')) }}"></div>
    <div class="form-group"><label>Services Section Subtitle</label>
        <textarea name="section_subtitle" class="form-control">{{ old('section_subtitle', theme_option('services_index_section_subtitle', 'From event management to influencer marketing — we deliver complete sports solutions across Pakistan.')) }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Navigation Labels</div>
    <div class="form-group"><label>Nav 1: Event Management</label>
        <input type="text" name="nav_label_1" class="form-control" value="{{ old('nav_label_1', theme_option('services_index_nav_label_1', 'Event Management')) }}"></div>
    <div class="form-group"><label>Nav 2: Media Production</label>
        <input type="text" name="nav_label_2" class="form-control" value="{{ old('nav_label_2', theme_option('services_index_nav_label_2', 'Media Production')) }}"></div>
    <div class="form-group"><label>Nav 3: Sports Marketing</label>
        <input type="text" name="nav_label_3" class="form-control" value="{{ old('nav_label_3', theme_option('services_index_nav_label_3', 'Sports Marketing')) }}"></div>
    <div class="form-group"><label>Nav 4: Campaign Design</label>
        <input type="text" name="nav_label_4" class="form-control" value="{{ old('nav_label_4', theme_option('services_index_nav_label_4', 'Campaign Design')) }}"></div>
    <div class="form-group"><label>Nav 6: Influencer Marketing</label>
        <input type="text" name="nav_label_6" class="form-control" value="{{ old('nav_label_6', theme_option('services_index_nav_label_6', 'Influencer Marketing')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Service 1: Event Management</div>
    <div class="form-group"><label>Card Icon (emoji)</label>
        <input type="text" name="service1_icon" class="form-control" value="{{ old('service1_icon', theme_option('services_index_service1_icon', '🏃')) }}" style="font-size:20px;"></div>
    <div class="form-group"><label>Image</label>
        @include('admin.website-content._image_field', ['name' => 'service1_img', 'value' => old('service1_img', theme_option('services_index_service1_img', 'https://images.unsplash.com/photo-1551958219-acbc608c6377'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="service1_title" class="form-control" value="{{ old('service1_title', theme_option('services_index_service1_title', 'Sports Event Management')) }}"></div>
    <div class="form-group"><label>Description</label>
        <textarea name="service1_desc" class="form-control">{{ old('service1_desc', theme_option('services_index_service1_desc', 'End-to-end planning and execution for marathons, tournaments, and community sports events.')) }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Service 2: Media Production</div>
    <div class="form-group"><label>Card Icon (emoji)</label>
        <input type="text" name="service2_icon" class="form-control" value="{{ old('service2_icon', theme_option('services_index_service2_icon', '🎬')) }}" style="font-size:20px;"></div>
    <div class="form-group"><label>Image</label>
        @include('admin.website-content._image_field', ['name' => 'service2_img', 'value' => old('service2_img', theme_option('services_index_service2_img', 'https://images.unsplash.com/photo-1533560904424-a0c61dc306fc'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="service2_title" class="form-control" value="{{ old('service2_title', theme_option('services_index_service2_title', 'Sports Media Production')) }}"></div>
    <div class="form-group"><label>Description</label>
        <textarea name="service2_desc" class="form-control">{{ old('service2_desc', theme_option('services_index_service2_desc', 'Cinematic videography, professional photography, and live streaming.')) }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Service 3: Sports Marketing</div>
    <div class="form-group"><label>Card Icon (emoji)</label>
        <input type="text" name="service3_icon" class="form-control" value="{{ old('service3_icon', theme_option('services_index_service3_icon', '📢')) }}" style="font-size:20px;"></div>
    <div class="form-group"><label>Image</label>
        @include('admin.website-content._image_field', ['name' => 'service3_img', 'value' => old('service3_img', theme_option('services_index_service3_img', 'https://images.unsplash.com/photo-1552664730-d307ca884978'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="service3_title" class="form-control" value="{{ old('service3_title', theme_option('services_index_service3_title', 'Sports Marketing & Strategy')) }}"></div>
    <div class="form-group"><label>Description</label>
        <textarea name="service3_desc" class="form-control">{{ old('service3_desc', theme_option('services_index_service3_desc', 'Data-driven digital marketing and community-first strategies.')) }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Service 4: Campaign Design</div>
    <div class="form-group"><label>Card Icon (emoji)</label>
        <input type="text" name="service4_icon" class="form-control" value="{{ old('service4_icon', theme_option('services_index_service4_icon', '🎨')) }}" style="font-size:20px;"></div>
    <div class="form-group"><label>Image</label>
        @include('admin.website-content._image_field', ['name' => 'service4_img', 'value' => old('service4_img', theme_option('services_index_service4_img', 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="service4_title" class="form-control" value="{{ old('service4_title', theme_option('services_index_service4_title', 'Digital Campaign Design')) }}"></div>
    <div class="form-group"><label>Description</label>
        <textarea name="service4_desc" class="form-control">{{ old('service4_desc', theme_option('services_index_service4_desc', 'Bold visual identities, event branding, and social media kits.')) }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Service 6: Influencer Marketing</div>
    <div class="form-group"><label>Card Icon (emoji)</label>
        <input type="text" name="service6_icon" class="form-control" value="{{ old('service6_icon', theme_option('services_index_service6_icon', '⭐')) }}" style="font-size:20px;"></div>
    <div class="form-group"><label>Image</label>
        @include('admin.website-content._image_field', ['name' => 'service6_img', 'value' => old('service6_img', theme_option('services_index_service6_img', 'https://images.unsplash.com/photo-1517841905240-472988babdf9'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="service6_title" class="form-control" value="{{ old('service6_title', theme_option('services_index_service6_title', 'Influencer & Athlete Marketing')) }}"></div>
    <div class="form-group"><label>Description</label>
        <textarea name="service6_desc" class="form-control">{{ old('service6_desc', theme_option('services_index_service6_desc', 'Connecting brands with Pakistan\'s most influential athletes.')) }}</textarea></div>
</div>
@endif

        @if($pageId === 'services_event_management')
@php $pfx = 'event_'; $capCount = 8; $lcCount = 8; @endphp
@include('admin.website-content._service_form', ['pfx' => $pfx, 'capCount' => $capCount, 'lcCount' => $lcCount, 'hasImpact' => true])
@endif

        @if($pageId === 'services_media_production')
@php $pfx = 'media_'; $capCount = 7; $lcCount = 5; @endphp
@include('admin.website-content._service_form', ['pfx' => $pfx, 'capCount' => $capCount, 'lcCount' => $lcCount, 'hasImpact' => true])
@endif

        @if($pageId === 'services_sports_marketing')
@php $pfx = 'sportsmarketing_'; $capCount = 7; $lcCount = 5; @endphp
@include('admin.website-content._service_form', ['pfx' => $pfx, 'capCount' => $capCount, 'lcCount' => $lcCount, 'hasImpact' => true])
@endif


        @if($pageId === 'services_campaign_design')
@php $pfx = 'campaign_'; $capCount = 7; $lcCount = 4; $stratCount = 5; @endphp
@include('admin.website-content._service_form', ['pfx' => $pfx, 'capCount' => $capCount, 'lcCount' => $lcCount, 'hasImpact' => true, 'stratCount' => $stratCount])
@endif

        @if($pageId === 'services_influencer_marketing')
@php $pfx = 'influencer_'; $capCount = 6; $lcCount = 4; @endphp
@include('admin.website-content._service_form', ['pfx' => $pfx, 'capCount' => $capCount, 'lcCount' => $lcCount, 'hasImpact' => true])
@endif
        @if($pageId === 'services_custom_printing')
@php $pfx = 'printing_'; $capCount = 4; $lcCount = 5; @endphp
@include('admin.website-content._service_form', ['pfx' => $pfx, 'capCount' => $capCount, 'lcCount' => $lcCount, 'hasImpact' => false])
@endif
        @if($pageId === 'portfolio')
<div class="form-section">
    <div class="form-section-title">Page Header</div>
    <div class="form-group"><label>Page Title (Browser Tab)</label>
        <input type="text" name="page_title" class="form-control" value="{{ old('page_title', theme_option('portfolio_page_title', 'Our Work - OD Sports')) }}"></div>
    <div class="form-group"><label>Badge Text</label>
        <input type="text" name="badge" class="form-control" value="{{ old('badge', theme_option('portfolio_badge', 'OUR WORK SPEAKS FOR ITSELF')) }}"></div>
    <div class="form-group"><label>Title Word 1</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', theme_option('portfolio_title', 'PREMIUM')) }}"></div>
    <div class="form-group"><label>Title Accent Word</label>
        <input type="text" name="title_accent" class="form-control" value="{{ old('title_accent', theme_option('portfolio_title_accent', 'PROJECTS')) }}"></div>
    <div class="form-group"><label>Subtitle</label>
        <textarea name="subtitle" class="form-control">{{ old('subtitle', theme_option('portfolio_subtitle', 'From Pakistan\'s largest marathon to kids running in the hills of Islamabad — every project we take on gets the same commitment. Here\'s what we\'ve built.')) }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Project 1 — Islamabad Marathon & IRU</div>
    <div class="form-group"><label>Gallery Badge Text (short code shown in popup circle)</label>
        <input type="text" name="1_badge" class="form-control" value="{{ old('1_badge', theme_option('portfolio_1_badge', 'IRU')) }}"></div>
    <div class="form-group"><label>Cover Image URL</label>
        @include('admin.website-content._image_field', ['name' => '1_img', 'value' => old('1_img', theme_option('portfolio_1_img', 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=600'))])</div>
    <div class="form-group"><label>Image Alt Text</label>
        <input type="text" name="1_alt" class="form-control" value="{{ old('1_alt', theme_option('portfolio_1_alt', 'Islamabad Marathon')) }}"></div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="1_title" class="form-control" value="{{ old('1_title', theme_option('portfolio_1_title', 'ISLAMABAD MARATHON & IRU')) }}"></div>
    <div class="form-group"><label>Category</label>
        <input type="text" name="1_category" class="form-control" value="{{ old('1_category', theme_option('portfolio_1_category', 'Event Management | Marketing | Media')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 1</label>
        <input type="text" name="gallery1_title_1" class="form-control" value="{{ old('gallery1_title_1', theme_option('portfolio_gallery1_title_1', 'ISLAMABAD MARATHON')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 2 (Accent)</label>
        <input type="text" name="gallery1_title_2" class="form-control" value="{{ old('gallery1_title_2', theme_option('portfolio_gallery1_title_2', '& IRU')) }}"></div>
    <div class="form-group"><label>Gallery Description</label>
        <textarea name="gallery1_desc" class="form-control">{{ old('gallery1_desc', theme_option('portfolio_gallery1_desc', 'Since 2022, we\'ve supported IRU through four editions of the Islamabad Marathon.')) }}</textarea></div>
    <div class="form-group"><label>Stat 1 Number</label>
        <input type="text" name="gallery1_stat1_num" class="form-control" value="{{ old('gallery1_stat1_num', theme_option('portfolio_gallery1_stat1_num', '6,000+')) }}"></div>
    <div class="form-group"><label>Stat 1 Label</label>
        <input type="text" name="gallery1_stat1_label" class="form-control" value="{{ old('gallery1_stat1_label', theme_option('portfolio_gallery1_stat1_label', 'Participants')) }}"></div>
    <div class="form-group"><label>Stat 2 Number</label>
        <input type="text" name="gallery1_stat2_num" class="form-control" value="{{ old('gallery1_stat2_num', theme_option('portfolio_gallery1_stat2_num', '8.66M')) }}"></div>
    <div class="form-group"><label>Stat 2 Label</label>
        <input type="text" name="gallery1_stat2_label" class="form-control" value="{{ old('gallery1_stat2_label', theme_option('portfolio_gallery1_stat2_label', 'Reach')) }}"></div>
    <div class="form-group"><label>Stat 3 Number</label>
        <input type="text" name="gallery1_stat3_num" class="form-control" value="{{ old('gallery1_stat3_num', theme_option('portfolio_gallery1_stat3_num', '18.8M')) }}"></div>
    <div class="form-group"><label>Stat 3 Label</label>
        <input type="text" name="gallery1_stat3_label" class="form-control" value="{{ old('gallery1_stat3_label', theme_option('portfolio_gallery1_stat3_label', 'Video Views')) }}"></div>
    <div class="form-group"><label>Stat 4 Number</label>
        <input type="text" name="gallery1_stat4_num" class="form-control" value="{{ old('gallery1_stat4_num', theme_option('portfolio_gallery1_stat4_num', '18.8M')) }}"></div>
    <div class="form-group"><label>Stat 4 Label</label>
        <input type="text" name="gallery1_stat4_label" class="form-control" value="{{ old('gallery1_stat4_label', theme_option('portfolio_gallery1_stat4_label', 'Video Views')) }}"></div>
    <div class="form-group"><label>Stat 5 Number</label>
        <input type="text" name="gallery1_stat5_num" class="form-control" value="{{ old('gallery1_stat5_num', theme_option('portfolio_gallery1_stat5_num', '381K+')) }}"></div>
    <div class="form-group"><label>Stat 5 Label</label>
        <input type="text" name="gallery1_stat5_label" class="form-control" value="{{ old('gallery1_stat5_label', theme_option('portfolio_gallery1_stat5_label', 'Live Stream Views')) }}"></div>
    <div class="form-group"><label>Gallery Image 1 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery1_img1', 'value' => old('gallery1_img1', theme_option('portfolio_gallery1_img1', 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=800'))])</div>
    <div class="form-group"><label>Gallery Image 2 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery1_img2', 'value' => old('gallery1_img2', theme_option('portfolio_gallery1_img2', 'https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?auto=format&fit=crop&w=800'))])</div>
    <div class="form-group"><label>Gallery Image 3 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery1_img3', 'value' => old('gallery1_img3', theme_option('portfolio_gallery1_img3', 'https://images.unsplash.com/photo-1533560904424-a0c61dc306fc?auto=format&fit=crop&q=80&w=800'))])</div>
</div>

<div class="form-section">
    <div class="form-section-title">Project 2 — Margalla Trail Runners</div>
    <div class="form-group"><label>Gallery Badge Text (short code shown in popup circle)</label>
        <input type="text" name="2_badge" class="form-control" value="{{ old('2_badge', theme_option('portfolio_2_badge', 'MTR')) }}"></div>
    <div class="form-group"><label>Cover Image URL</label>
        @include('admin.website-content._image_field', ['name' => '2_img', 'value' => old('2_img', theme_option('portfolio_2_img', 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&q=80&w=600'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="2_title" class="form-control" value="{{ old('2_title', theme_option('portfolio_2_title', 'MARGALLA TRAIL RUNNERS')) }}"></div>
    <div class="form-group"><label>Category</label>
        <input type="text" name="2_category" class="form-control" value="{{ old('2_category', theme_option('portfolio_2_category', 'Media Production | Digital Marketing')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 1</label>
        <input type="text" name="gallery2_title_1" class="form-control" value="{{ old('gallery2_title_1', theme_option('portfolio_gallery2_title_1', 'MARGALLA TRAIL')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 2 (Accent)</label>
        <input type="text" name="gallery2_title_2" class="form-control" value="{{ old('gallery2_title_2', theme_option('portfolio_gallery2_title_2', 'RUNNERS')) }}"></div>
    <div class="form-group"><label>Gallery Description</label>
        <textarea name="gallery2_desc" class="form-control">{{ old('gallery2_desc', theme_option('portfolio_gallery2_desc', 'Official media partner since 2024. We craft immersive narratives that capture the grit and spirit of trail athletes.')) }}</textarea></div>
    <div class="form-group"><label>Stat 1 Number</label>
        <input type="text" name="gallery2_stat1_num" class="form-control" value="{{ old('gallery2_stat1_num', theme_option('portfolio_gallery2_stat1_num', '476K+')) }}"></div>
    <div class="form-group"><label>Stat 1 Label</label>
        <input type="text" name="gallery2_stat1_label" class="form-control" value="{{ old('gallery2_stat1_label', theme_option('portfolio_gallery2_stat1_label', 'People Reached')) }}"></div>
    <div class="form-group"><label>Stat 2 Number</label>
        <input type="text" name="gallery2_stat2_num" class="form-control" value="{{ old('gallery2_stat2_num', theme_option('portfolio_gallery2_stat2_num', '2.25M')) }}"></div>
    <div class="form-group"><label>Stat 2 Label</label>
        <input type="text" name="gallery2_stat2_label" class="form-control" value="{{ old('gallery2_stat2_label', theme_option('portfolio_gallery2_stat2_label', 'Video Views')) }}"></div>
    <div class="form-group"><label>Stat 3 Number</label>
        <input type="text" name="gallery2_stat3_num" class="form-control" value="{{ old('gallery2_stat3_num', theme_option('portfolio_gallery2_stat3_num', '9.8K+')) }}"></div>
    <div class="form-group"><label>Stat 3 Label</label>
        <input type="text" name="gallery2_stat3_label" class="form-control" value="{{ old('gallery2_stat3_label', theme_option('portfolio_gallery2_stat3_label', 'Engagements')) }}"></div>
    <div class="form-group"><label>Gallery Image 1 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery2_img1', 'value' => old('gallery2_img1', theme_option('portfolio_gallery2_img1', 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&q=80&w=800'))])</div>
    <div class="form-group"><label>Gallery Image 2 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery2_img2', 'value' => old('gallery2_img2', theme_option('portfolio_gallery2_img2', 'https://images.unsplash.com/photo-1551854838-212c50b4c184?auto=format&fit=crop&q=80&w=800'))])</div>
</div>

<div class="form-section">
    <div class="form-section-title">Project 3 — YourPace by inDrive</div>
    <div class="form-group"><label>Gallery Badge Text (short code shown in popup circle)</label>
        <input type="text" name="3_badge" class="form-control" value="{{ old('3_badge', theme_option('portfolio_3_badge', 'YOURPACE')) }}"></div>
    <div class="form-group"><label>Cover Image URL</label>
        @include('admin.website-content._image_field', ['name' => '3_img', 'value' => old('3_img', theme_option('portfolio_3_img', 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=600'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="3_title" class="form-control" value="{{ old('3_title', theme_option('portfolio_3_title', 'YOURPACE BY INDRIVE')) }}"></div>
    <div class="form-group"><label>Category</label>
        <input type="text" name="3_category" class="form-control" value="{{ old('3_category', theme_option('portfolio_3_category', 'Event Management | Media Production')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 1</label>
        <input type="text" name="gallery3_title_1" class="form-control" value="{{ old('gallery3_title_1', theme_option('portfolio_gallery3_title_1', 'YOURPACE BY')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 2 (Accent)</label>
        <input type="text" name="gallery3_title_2" class="form-control" value="{{ old('gallery3_title_2', theme_option('portfolio_gallery3_title_2', 'INDRIVE')) }}"></div>
    <div class="form-group"><label>Gallery Description</label>
        <textarea name="gallery3_desc" class="form-control">{{ old('gallery3_desc', theme_option('portfolio_gallery3_desc', 'An inDrive initiative for underprivileged children. End-to-end coverage including documentation, branding, and documentary production.')) }}</textarea></div>
    <div class="form-group"><label>Gallery Image 1 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery3_img1', 'value' => old('gallery3_img1', theme_option('portfolio_gallery3_img1', 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=800'))])</div>
    <div class="form-group"><label>Gallery Image 2 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery3_img2', 'value' => old('gallery3_img2', theme_option('portfolio_gallery3_img2', 'https://images.unsplash.com/photo-1502086223501-7ea244b2896e?auto=format&fit=crop&q=80&w=800'))])</div>
</div>

<div class="form-section">
    <div class="form-section-title">Project 4 — Twin City & Night Run</div>
    <div class="form-group"><label>Gallery Badge Text (short code shown in popup circle)</label>
        <input type="text" name="4_badge" class="form-control" value="{{ old('4_badge', theme_option('portfolio_4_badge', 'TCR')) }}"></div>
    <div class="form-group"><label>Cover Image URL</label>
        @include('admin.website-content._image_field', ['name' => '4_img', 'value' => old('4_img', theme_option('portfolio_4_img', 'https://images.unsplash.com/photo-1532444458054-015fddf2b2ca?auto=format&fit=crop&q=80&w=600'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="4_title" class="form-control" value="{{ old('4_title', theme_option('portfolio_4_title', 'TWIN CITY & NIGHT RUN')) }}"></div>
    <div class="form-group"><label>Category</label>
        <input type="text" name="4_category" class="form-control" value="{{ old('4_category', theme_option('portfolio_4_category', 'Digital Marketing | Media | Coverage')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 1</label>
        <input type="text" name="gallery4_title_1" class="form-control" value="{{ old('gallery4_title_1', theme_option('portfolio_gallery4_title_1', 'TWIN CITY RUN')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 2 (Accent)</label>
        <input type="text" name="gallery4_title_2" class="form-control" value="{{ old('gallery4_title_2', theme_option('portfolio_gallery4_title_2', '& NIGHT RUN')) }}"></div>
    <div class="form-group"><label>Gallery Description</label>
        <textarea name="gallery4_desc" class="form-control">{{ old('gallery4_desc', theme_option('portfolio_gallery4_desc', 'Full digital and media campaigns for Islamabad\'s popular urban races.')) }}</textarea></div>
    <div class="form-group"><label>Stat 1 Number</label>
        <input type="text" name="gallery4_stat1_num" class="form-control" value="{{ old('gallery4_stat1_num', theme_option('portfolio_gallery4_stat1_num', '800K+')) }}"></div>
    <div class="form-group"><label>Stat 1 Label</label>
        <input type="text" name="gallery4_stat1_label" class="form-control" value="{{ old('gallery4_stat1_label', theme_option('portfolio_gallery4_stat1_label', 'People Reached')) }}"></div>
    <div class="form-group"><label>Stat 2 Number</label>
        <input type="text" name="gallery4_stat2_num" class="form-control" value="{{ old('gallery4_stat2_num', theme_option('portfolio_gallery4_stat2_num', '700K+')) }}"></div>
    <div class="form-group"><label>Stat 2 Label</label>
        <input type="text" name="gallery4_stat2_label" class="form-control" value="{{ old('gallery4_stat2_label', theme_option('portfolio_gallery4_stat2_label', 'Video Views')) }}"></div>
    <div class="form-group"><label>Stat 3 Number</label>
        <input type="text" name="gallery4_stat3_num" class="form-control" value="{{ old('gallery4_stat3_num', theme_option('portfolio_gallery4_stat3_num', '10K+')) }}"></div>
    <div class="form-group"><label>Stat 3 Label</label>
        <input type="text" name="gallery4_stat3_label" class="form-control" value="{{ old('gallery4_stat3_label', theme_option('portfolio_gallery4_stat3_label', 'Engagements')) }}"></div>
    <div class="form-group"><label>Gallery Image 1 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery4_img1', 'value' => old('gallery4_img1', theme_option('portfolio_gallery4_img1', 'https://images.unsplash.com/photo-1532444458054-015fddf2b2ca?auto=format&fit=crop&q=80&w=800'))])</div>
    <div class="form-group"><label>Gallery Image 2 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery4_img2', 'value' => old('gallery4_img2', theme_option('portfolio_gallery4_img2', 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&q=80&w=800'))])</div>
</div>

<div class="form-section">
    <div class="form-section-title">Project 5 — IRC Running Series</div>
    <div class="form-group"><label>Gallery Badge Text (short code shown in popup circle)</label>
        <input type="text" name="5_badge" class="form-control" value="{{ old('5_badge', theme_option('portfolio_5_badge', 'IRC')) }}"></div>
    <div class="form-group"><label>Cover Image URL</label>
        @include('admin.website-content._image_field', ['name' => '5_img', 'value' => old('5_img', theme_option('portfolio_5_img', 'https://images.unsplash.com/photo-1547483161-5918641d402b?auto=format&fit=crop&q=80&w=600'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="5_title" class="form-control" value="{{ old('5_title', theme_option('portfolio_5_title', 'IRC RUNNING SERIES')) }}"></div>
    <div class="form-group"><label>Category</label>
        <input type="text" name="5_category" class="form-control" value="{{ old('5_category', theme_option('portfolio_5_category', 'Sports Photography | Videography')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 1</label>
        <input type="text" name="gallery5_title_1" class="form-control" value="{{ old('gallery5_title_1', theme_option('portfolio_gallery5_title_1', 'IRC')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 2 (Accent)</label>
        <input type="text" name="gallery5_title_2" class="form-control" value="{{ old('gallery5_title_2', theme_option('portfolio_gallery5_title_2', 'RUNNING SERIES')) }}"></div>
    <div class="form-group"><label>Gallery Description</label>
        <textarea name="gallery5_desc" class="form-control">{{ old('gallery5_desc', theme_option('portfolio_gallery5_desc', 'End-to-end event coverage across three race editions including professional photography, drone videography, and testimonial production.')) }}</textarea></div>
    <div class="form-group"><label>Gallery Image 1 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery5_img1', 'value' => old('gallery5_img1', theme_option('portfolio_gallery5_img1', 'https://images.unsplash.com/photo-1547483161-5918641d402b?auto=format&fit=crop&q=80&w=800'))])</div>
    <div class="form-group"><label>Gallery Image 2 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery5_img2', 'value' => old('gallery5_img2', theme_option('portfolio_gallery5_img2', 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=800'))])</div>
</div>

<div class="form-section">
    <div class="form-section-title">Project 6 — Tabarak Runs Cross-Pakistan</div>
    <div class="form-group"><label>Gallery Badge Text (short code shown in popup circle)</label>
        <input type="text" name="6_badge" class="form-control" value="{{ old('6_badge', theme_option('portfolio_6_badge', 'TABARAK')) }}"></div>
    <div class="form-group"><label>Cover Image URL</label>
        @include('admin.website-content._image_field', ['name' => '6_img', 'value' => old('6_img', theme_option('portfolio_6_img', 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&q=80&w=600'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="6_title" class="form-control" value="{{ old('6_title', theme_option('portfolio_6_title', 'TABARAK RUNS CROSS-PAKISTAN')) }}"></div>
    <div class="form-group"><label>Category</label>
        <input type="text" name="6_category" class="form-control" value="{{ old('6_category', theme_option('portfolio_6_category', 'Social Media | Content Production')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 1</label>
        <input type="text" name="gallery6_title_1" class="form-control" value="{{ old('gallery6_title_1', theme_option('portfolio_gallery6_title_1', 'TABARAK RUNS')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 2 (Accent)</label>
        <input type="text" name="gallery6_title_2" class="form-control" value="{{ old('gallery6_title_2', theme_option('portfolio_gallery6_title_2', 'CROSS-PAKISTAN')) }}"></div>
    <div class="form-group"><label>Gallery Description</label>
        <textarea name="gallery6_desc" class="form-control">{{ old('gallery6_desc', theme_option('portfolio_gallery6_desc', 'Documenting the historic 1,600km run from Hasan Abdal to Karachi.')) }}</textarea></div>
    <div class="form-group"><label>Gallery Image 1 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery6_img1', 'value' => old('gallery6_img1', theme_option('portfolio_gallery6_img1', 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&q=80&w=800'))])</div>
    <div class="form-group"><label>Gallery Image 2 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery6_img2', 'value' => old('gallery6_img2', theme_option('portfolio_gallery6_img2', 'https://images.unsplash.com/photo-1444491741275-3747c03c9964?auto=format&fit=crop&q=80&w=800'))])</div>
</div>

<div class="form-section">
    <div class="form-section-title">Project 7 — Shehroze Kashif 14x8000er</div>
    <div class="form-group"><label>Gallery Badge Text (short code shown in popup circle)</label>
        <input type="text" name="7_badge" class="form-control" value="{{ old('7_badge', theme_option('portfolio_7_badge', '14×8000')) }}"></div>
    <div class="form-group"><label>Cover Image URL</label>
        @include('admin.website-content._image_field', ['name' => '7_img', 'value' => old('7_img', theme_option('portfolio_7_img', 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=600'))])</div>
    <div class="form-group"><label>Title</label>
        <input type="text" name="7_title" class="form-control" value="{{ old('7_title', theme_option('portfolio_7_title', 'SHEHROZE KASHIF 14X8000ER')) }}"></div>
    <div class="form-group"><label>Category</label>
        <input type="text" name="7_category" class="form-control" value="{{ old('7_category', theme_option('portfolio_7_category', 'Social Strategy | Content | PR')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 1</label>
        <input type="text" name="gallery7_title_1" class="form-control" value="{{ old('gallery7_title_1', theme_option('portfolio_gallery7_title_1', 'SHEHROZE KASHIF')) }}"></div>
    <div class="form-group"><label>Gallery Title Line 2 (Accent)</label>
        <input type="text" name="gallery7_title_2" class="form-control" value="{{ old('gallery7_title_2', theme_option('portfolio_gallery7_title_2', '14X8000ER')) }}"></div>
    <div class="form-group"><label>Gallery Description</label>
        <textarea name="gallery7_desc" class="form-control">{{ old('gallery7_desc', theme_option('portfolio_gallery7_desc', 'Social media strategy and content creation for Shehroze Kashif\'s historic endeavour to summit all 14 peaks above 8,000 metres.')) }}</textarea></div>
    <div class="form-group"><label>Gallery Image 1 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery7_img1', 'value' => old('gallery7_img1', theme_option('portfolio_gallery7_img1', 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=800'))])</div>
    <div class="form-group"><label>Gallery Image 2 URL</label>
        @include('admin.website-content._image_field', ['name' => 'gallery7_img2', 'value' => old('gallery7_img2', theme_option('portfolio_gallery7_img2', 'https://images.unsplash.com/photo-1544465544-1b71aee9dfa3?auto=format&fit=crop&q=80&w=800'))])</div>
</div>
@endif

        @if($pageId === 'about')
<div class="form-section">
    <div class="form-section-title">Hero Section</div>
    <div class="form-group"><label>Page Title (Browser Tab)</label>
        <input type="text" name="page_title" class="form-control" value="{{ old('page_title', theme_option('about_page_title', 'About Us - OD Sports')) }}"></div>
    <div class="form-group"><label>Hero Background Image</label>
        @include('admin.website-content._image_field', ['name' => 'hero_bg', 'value' => old('hero_bg', theme_option('about_hero_bg'))])</div>
    <div class="form-group"><label>Hero Subtitle</label>
        <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle', theme_option('about_hero_subtitle', 'OUR STORY')) }}"></div>
    <div class="form-group"><label>Hero Title Line 1</label>
        <input type="text" name="hero_title_1" class="form-control" value="{{ old('hero_title_1', theme_option('about_hero_title_1')) }}"></div>
    <div class="form-group"><label>Hero Title Line 2</label>
        <input type="text" name="hero_title_2" class="form-control" value="{{ old('hero_title_2', theme_option('about_hero_title_2')) }}"></div>
    <div class="form-group"><label>Hero Description</label>
        <textarea name="hero_desc" class="form-control">{{ old('hero_desc', theme_option('about_hero_desc')) }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Our Story Section</div>
    <div class="form-group"><label>Story Title</label>
        <input type="text" name="story_title" class="form-control" value="{{ old('story_title', theme_option('about_story_title')) }}"></div>
    <div class="form-group"><label>Story Paragraph 1</label>
        <textarea name="story_p1" class="form-control" rows="3">{{ old('story_p1', theme_option('about_story_p1')) }}</textarea></div>
    <div class="form-group"><label>Story Paragraph 2</label>
        <textarea name="story_p2" class="form-control" rows="2">{{ old('story_p2', theme_option('about_story_p2')) }}</textarea></div>
    <div class="form-group"><label>Story Paragraph 3</label>
        <textarea name="story_p3" class="form-control" rows="3">{{ old('story_p3', theme_option('about_story_p3')) }}</textarea></div>
    <div class="form-group"><label>Story Paragraph 4</label>
        <textarea name="story_p4" class="form-control" rows="3">{{ old('story_p4', theme_option('about_story_p4')) }}</textarea></div>
    <div class="form-group"><label>Story Paragraph 5</label>
        <textarea name="story_p5" class="form-control" rows="2">{{ old('story_p5', theme_option('about_story_p5')) }}</textarea></div>
    <div class="form-group"><label>Story Image</label>
        @include('admin.website-content._image_field', ['name' => 'story_img', 'value' => old('story_img', theme_option('about_story_img'))])</div>
    <div class="form-group"><label>Story Image Alt Text</label>
        <input type="text" name="story_img_alt" class="form-control" value="{{ old('story_img_alt', theme_option('about_story_img_alt')) }}"></div>
    <div class="form-group"><label>Growth Stat Number</label>
        <input type="text" name="growth_stat" class="form-control" value="{{ old('growth_stat', theme_option('about_growth_stat', '1,100%')) }}"></div>
    <div class="form-group"><label>Growth Stat Label</label>
        <input type="text" name="growth_label" class="form-control" value="{{ old('growth_label', theme_option('about_growth_label', 'Growth in Participation')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">What Makes Us Different</div>
    <div class="form-group"><label>Section Title</label>
        <input type="text" name="different_title" class="form-control" value="{{ old('different_title', theme_option('about_different_title')) }}"></div>
    <div class="form-group"><label>Point 1</label>
        <input type="text" name="different_p1" class="form-control" value="{{ old('different_p1', theme_option('about_different_p1')) }}"></div>
    <div class="form-group"><label>Point 2</label>
        <input type="text" name="different_p2" class="form-control" value="{{ old('different_p2', theme_option('about_different_p2')) }}"></div>
    <div class="form-group"><label>Point 3</label>
        <input type="text" name="different_p3" class="form-control" value="{{ old('different_p3', theme_option('about_different_p3')) }}"></div>
    <div class="form-group"><label>Point 4</label>
        <input type="text" name="different_p4" class="form-control" value="{{ old('different_p4', theme_option('about_different_p4')) }}"></div>
    <div class="form-group"><label>Point 5</label>
        <input type="text" name="different_p5" class="form-control" value="{{ old('different_p5', theme_option('about_different_p5')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Team Section (up to 15 members)</div>
    <div class="form-group"><label>Team Section Title</label>
        <input type="text" name="team_title" class="form-control" value="{{ old('team_title', theme_option('about_team_title')) }}"></div>
    <div class="form-group"><label>Team Section Subtitle</label>
        <textarea name="team_subtitle" class="form-control">{{ old('team_subtitle', theme_option('about_team_subtitle')) }}</textarea></div>
    @for($i = 1; $i <= 15; $i++)
    <div style="background: #0f172a; padding: 16px; border-radius: 8px; margin-bottom: 16px;">
        <h5 style="color: #60a5fa; margin-bottom: 12px;">Team Member {{ $i }}</h5>
        <div class="form-group"><label>Name</label>
            <input type="text" name="team_{{ $i }}_name" class="form-control" value="{{ old('team_'.$i.'_name', theme_option('about_team_'.$i.'_name')) }}"></div>
        <div class="form-group"><label>Role</label>
            <input type="text" name="team_{{ $i }}_role" class="form-control" value="{{ old('team_'.$i.'_role', theme_option('about_team_'.$i.'_role')) }}"></div>
        <div class="form-group"><label>Photo</label>
            @include('admin.website-content._image_field', ['name' => 'team_'.$i.'_img', 'value' => old('team_'.$i.'_img', theme_option('about_team_'.$i.'_img', 'https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?auto=format&fit=crop&q=80&w=300'))])</div>
    </div>
    @endfor
</div>

<div class="form-section">
    <div class="form-section-title">CTA Section</div>
    <div class="form-group"><label>CTA Background Image</label>
        @include('admin.website-content._image_field', ['name' => 'cta_bg', 'value' => old('cta_bg', theme_option('about_cta_bg'))])</div>
    <div class="form-group"><label>CTA Title Line 1</label>
        <input type="text" name="cta_title_1" class="form-control" value="{{ old('cta_title_1', theme_option('about_cta_title_1')) }}"></div>
    <div class="form-group"><label>CTA Title Line 2</label>
        <input type="text" name="cta_title_2" class="form-control" value="{{ old('cta_title_2', theme_option('about_cta_title_2')) }}"></div>
    <div class="form-group"><label>Office 1 Title</label>
        <input type="text" name="office1_title" class="form-control" value="{{ old('office1_title', theme_option('about_office1_title')) }}"></div>
    <div class="form-group"><label>Office 1 Address</label>
        <textarea name="office1_address" class="form-control">{{ old('office1_address', theme_option('about_office1_address')) }}</textarea></div>
    <div class="form-group"><label>Office 2 Title</label>
        <input type="text" name="office2_title" class="form-control" value="{{ old('office2_title', theme_option('about_office2_title')) }}"></div>
    <div class="form-group"><label>Office 2 Address</label>
        <textarea name="office2_address" class="form-control">{{ old('office2_address', theme_option('about_office2_address')) }}</textarea></div>
    <div class="form-group"><label>CTA Button Text</label>
        <input type="text" name="cta_btn" class="form-control" value="{{ old('cta_btn', theme_option('about_cta_btn', 'Call Us: +92 320 1223359')) }}"></div>
    <div class="form-group"><label>CTA Button Link (e.g. tel:+923201223359 or a URL)</label>
        <input type="text" name="cta_btn_link" class="form-control" value="{{ old('cta_btn_link', theme_option('about_cta_btn_link', 'tel:+923201223359')) }}"></div>
</div>
@endif

        @if($pageId === 'custom_orders')
<div class="form-section">
    <div class="form-section-title">Hero Section</div>
    <div class="form-group"><label>Page Title (Browser Tab)</label>
        <input type="text" name="orders_page_title" class="form-control" value="{{ old('orders_page_title', $pageData['orders_page_title'] ?? 'Custom Orders & Merchandise - OD Sports') }}"></div>
    <div class="form-group"><label>Hero Background Image</label>
        @include('admin.website-content._image_field', ['name' => 'hero_bg', 'value' => old('hero_bg', $pageData['hero_bg'] ?? 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=2000&q=80')])</div>
    <div class="form-group"><label>Hero Subtitle</label>
        <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle', $pageData['hero_subtitle'] ?? 'PAGE 4 — CUSTOM ORDERS') }}"></div>
    <div class="form-group"><label>Hero Title Line 1</label>
        <input type="text" name="hero_title_1" class="form-control" value="{{ old('hero_title_1', $pageData['hero_title_1'] ?? 'Custom Merchandise') }}"></div>
    <div class="form-group"><label>Hero Title Line 2</label>
        <input type="text" name="hero_title_2" class="form-control" value="{{ old('hero_title_2', $pageData['hero_title_2'] ?? 'for Your Team or Event') }}"></div>
    <div class="form-group"><label>Hero Description</label>
        <textarea name="hero_desc" class="form-control">{{ old('hero_desc', $pageData['hero_desc'] ?? 'Need jerseys, event t-shirts, banners, or branded fan gear? Tell us what you need — we handle design, printing, and delivery anywhere in Pakistan.') }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">What We Make Section</div>
    <div class="form-group"><label>Section Title</label>
        <input type="text" name="whatwemake_title" class="form-control" value="{{ old('whatwemake_title', $pageData['whatwemake_title'] ?? 'WHAT WE MAKE') }}"></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Card 1 — Apparel</h5>
    <div class="form-group"><label>Card 1 Title</label>
        <input type="text" name="card1_title" class="form-control" value="{{ old('card1_title', $pageData['card1_title'] ?? 'Apparel') }}"></div>
    <div class="form-group"><label>Card 1 Item 1</label>
        <input type="text" name="card1_item1" class="form-control" value="{{ old('card1_item1', $pageData['card1_item1'] ?? 'Team jerseys and training kits') }}"></div>
    <div class="form-group"><label>Card 1 Item 2</label>
        <input type="text" name="card1_item2" class="form-control" value="{{ old('card1_item2', $pageData['card1_item2'] ?? 'Event t-shirts and race-day gear') }}"></div>
    <div class="form-group"><label>Card 1 Item 3</label>
        <input type="text" name="card1_item3" class="form-control" value="{{ old('card1_item3', $pageData['card1_item3'] ?? 'Hoodies, tracksuits, and casual wear') }}"></div>
    <div class="form-group"><label>Card 1 Item 4</label>
        <input type="text" name="card1_item4" class="form-control" value="{{ old('card1_item4', $pageData['card1_item4'] ?? 'Compression gear and running apparel') }}"></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Card 2 — Event Branding</h5>
    <div class="form-group"><label>Card 2 Title</label>
        <input type="text" name="card2_title" class="form-control" value="{{ old('card2_title', $pageData['card2_title'] ?? 'Event Branding') }}"></div>
    <div class="form-group"><label>Card 2 Item 1</label>
        <input type="text" name="card2_item1" class="form-control" value="{{ old('card2_item1', $pageData['card2_item1'] ?? 'Pull-up banners and perimeter boards') }}"></div>
    <div class="form-group"><label>Card 2 Item 2</label>
        <input type="text" name="card2_item2" class="form-control" value="{{ old('card2_item2', $pageData['card2_item2'] ?? 'Start/finish arches and race structures') }}"></div>
    <div class="form-group"><label>Card 2 Item 3</label>
        <input type="text" name="card2_item3" class="form-control" value="{{ old('card2_item3', $pageData['card2_item3'] ?? 'Flags and fan-zone materials') }}"></div>
    <div class="form-group"><label>Card 2 Item 4</label>
        <input type="text" name="card2_item4" class="form-control" value="{{ old('card2_item4', $pageData['card2_item4'] ?? 'Sponsor backdrops and photo walls') }}"></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Card 3 — Fan Merchandise</h5>
    <div class="form-group"><label>Card 3 Title</label>
        <input type="text" name="card3_title" class="form-control" value="{{ old('card3_title', $pageData['card3_title'] ?? 'Fan Merchandise') }}"></div>
    <div class="form-group"><label>Card 3 Item 1</label>
        <input type="text" name="card3_item1" class="form-control" value="{{ old('card3_item1', $pageData['card3_item1'] ?? 'Caps, beanies, and headwear') }}"></div>
    <div class="form-group"><label>Card 3 Item 2</label>
        <input type="text" name="card3_item2" class="form-control" value="{{ old('card3_item2', $pageData['card3_item2'] ?? 'Tote bags and drawstring backpacks') }}"></div>
    <div class="form-group"><label>Card 3 Item 3</label>
        <input type="text" name="card3_item3" class="form-control" value="{{ old('card3_item3', $pageData['card3_item3'] ?? 'Water bottles and drinkware') }}"></div>
    <div class="form-group"><label>Card 3 Item 4</label>
        <input type="text" name="card3_item4" class="form-control" value="{{ old('card3_item4', $pageData['card3_item4'] ?? 'Lanyards and accessories') }}"></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Card 4 — Custom Orders</h5>
    <div class="form-group"><label>Card 4 Title</label>
        <input type="text" name="card4_title" class="form-control" value="{{ old('card4_title', $pageData['card4_title'] ?? 'Custom Orders') }}"></div>
    <div class="form-group"><label>Card 4 Item 1</label>
        <input type="text" name="card4_item1" class="form-control" value="{{ old('card4_item1', $pageData['card4_item1'] ?? 'Sponsor co-branding on any merchandise') }}"></div>
    <div class="form-group"><label>Card 4 Item 2</label>
        <input type="text" name="card4_item2" class="form-control" value="{{ old('card4_item2', $pageData['card4_item2'] ?? 'Club and academy uniform packs') }}"></div>
    <div class="form-group"><label>Card 4 Item 3</label>
        <input type="text" name="card4_item3" class="form-control" value="{{ old('card4_item3', $pageData['card4_item3'] ?? 'Full event merchandise packages') }}"></div>
    <div class="form-group"><label>Card 4 Item 4</label>
        <input type="text" name="card4_item4" class="form-control" value="{{ old('card4_item4', $pageData['card4_item4'] ?? 'Packaging design for product launches') }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">How It Works Section</div>
    <div class="form-group"><label>Section Title Line 1</label>
        <input type="text" name="lifecycle_title_1" class="form-control" value="{{ old('lifecycle_title_1', $pageData['lifecycle_title_1'] ?? 'HOW IT') }}"></div>
    <div class="form-group"><label>Section Title Line 2</label>
        <input type="text" name="lifecycle_title_2" class="form-control" value="{{ old('lifecycle_title_2', $pageData['lifecycle_title_2'] ?? 'WORKS') }}"></div>
    <div class="form-group"><label>Step 1 Number</label>
        <input type="text" name="phase1_num" class="form-control" value="{{ old('phase1_num', $pageData['phase1_num'] ?? '01') }}"></div>
    <div class="form-group"><label>Step 1 Title</label>
        <input type="text" name="phase1_title" class="form-control" value="{{ old('phase1_title', $pageData['phase1_title'] ?? 'Tell Us What You Need') }}"></div>
    <div class="form-group"><label>Step 1 Description</label>
        <textarea name="phase1_desc" class="form-control">{{ old('phase1_desc', $pageData['phase1_desc'] ?? 'Fill out the form below with your requirements, event name, quantity, design preferences, and deadline.') }}</textarea></div>
    <div class="form-group"><label>Step 2 Number</label>
        <input type="text" name="phase2_num" class="form-control" value="{{ old('phase2_num', $pageData['phase2_num'] ?? '02') }}"></div>
    <div class="form-group"><label>Step 2 Title</label>
        <input type="text" name="phase2_title" class="form-control" value="{{ old('phase2_title', $pageData['phase2_title'] ?? 'We Design It') }}"></div>
    <div class="form-group"><label>Step 2 Description</label>
        <textarea name="phase2_desc" class="form-control">{{ old('phase2_desc', $pageData['phase2_desc'] ?? 'Our design team creates mockups tailored to your team identity, colours, and event branding.') }}</textarea></div>
    <div class="form-group"><label>Step 3 Number</label>
        <input type="text" name="phase3_num" class="form-control" value="{{ old('phase3_num', $pageData['phase3_num'] ?? '03') }}"></div>
    <div class="form-group"><label>Step 3 Title</label>
        <input type="text" name="phase3_title" class="form-control" value="{{ old('phase3_title', $pageData['phase3_title'] ?? 'You Approve It') }}"></div>
    <div class="form-group"><label>Step 3 Description</label>
        <textarea name="phase3_desc" class="form-control">{{ old('phase3_desc', $pageData['phase3_desc'] ?? 'Review and approve the designs. We handle all revisions until you\'re happy.') }}</textarea></div>
    <div class="form-group"><label>Step 4 Number</label>
        <input type="text" name="phase4_num" class="form-control" value="{{ old('phase4_num', $pageData['phase4_num'] ?? '04') }}"></div>
    <div class="form-group"><label>Step 4 Title</label>
        <input type="text" name="phase4_title" class="form-control" value="{{ old('phase4_title', $pageData['phase4_title'] ?? 'We Print & Deliver') }}"></div>
    <div class="form-group"><label>Step 4 Description</label>
        <textarea name="phase4_desc" class="form-control">{{ old('phase4_desc', $pageData['phase4_desc'] ?? 'We manage production and delivery to your location across Pakistan.') }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Order Form Section</div>
    <div class="form-group"><label>Form Mini Label (small green text above sub-heading)</label>
        <input type="text" name="form_mini_label" class="form-control" value="{{ old('form_mini_label', $pageData['form_mini_label'] ?? 'Custom Printing') }}"></div>
    <div class="form-group"><label>Form Sub-Heading</label>
        <input type="text" name="form_sub_heading" class="form-control" value="{{ old('form_sub_heading', $pageData['form_sub_heading'] ?? 'Tell Us What You Need') }}"></div>
    <div class="form-group"><label>Form Title Line 1</label>
        <input type="text" name="form_title_1" class="form-control" value="{{ old('form_title_1', $pageData['form_title_1'] ?? 'Ready to') }}"></div>
    <div class="form-group"><label>Form Title Line 2 (Accent)</label>
        <input type="text" name="form_title_2" class="form-control" value="{{ old('form_title_2', $pageData['form_title_2'] ?? 'Gear Up?') }}"></div>
    <div class="form-group"><label>Form Description</label>
        <textarea name="form_desc" class="form-control">{{ old('form_desc', $pageData['form_desc'] ?? 'Whether you need 50 jerseys or a full event merchandise package — we\'ll handle everything from first sketch to final delivery.') }}</textarea></div>
    <div class="form-group"><label>Benefit 1</label>
        <input type="text" name="form_benefit1" class="form-control" value="{{ old('form_benefit1', $pageData['form_benefit1'] ?? 'Low Minimum Order Quantities') }}"></div>
    <div class="form-group"><label>Benefit 2</label>
        <input type="text" name="form_benefit2" class="form-control" value="{{ old('form_benefit2', $pageData['form_benefit2'] ?? 'Nationwide Shipping in Pakistan') }}"></div>
    <div class="form-group"><label>Benefit 3</label>
        <input type="text" name="form_benefit3" class="form-control" value="{{ old('form_benefit3', $pageData['form_benefit3'] ?? 'Premium Technical Fabrics') }}"></div>
    <div class="form-group"><label>Full Name Field Placeholder</label>
        <input type="text" name="form_name" class="form-control" value="{{ old('form_name', $pageData['form_name'] ?? 'e.g. Ahmed Khan') }}"></div>
    <div class="form-group"><label>Organization Field Placeholder</label>
        <input type="text" name="form_org" class="form-control" value="{{ old('form_org', $pageData['form_org'] ?? 'e.g. FC Lahore') }}"></div>
    <div class="form-group"><label>Email Field Placeholder</label>
        <input type="text" name="form_email" class="form-control" value="{{ old('form_email', $pageData['form_email'] ?? 'you@example.com') }}"></div>
    <div class="form-group"><label>Phone Field Placeholder</label>
        <input type="text" name="form_phone" class="form-control" value="{{ old('form_phone', $pageData['form_phone'] ?? '+92 300 0000000') }}"></div>
    <div class="form-group"><label>Dropdown Option 1 Label</label>
        <input type="text" name="form_select1" class="form-control" value="{{ old('form_select1', $pageData['form_select1'] ?? 'Team Jerseys') }}"></div>
    <div class="form-group"><label>Dropdown Option 2 Label</label>
        <input type="text" name="form_select2" class="form-control" value="{{ old('form_select2', $pageData['form_select2'] ?? 'Event Banners') }}"></div>
    <div class="form-group"><label>Dropdown Option 3 Label</label>
        <input type="text" name="form_select3" class="form-control" value="{{ old('form_select3', $pageData['form_select3'] ?? 'Fan Gear') }}"></div>
    <div class="form-group"><label>Dropdown Option 4 Label</label>
        <input type="text" name="form_select4" class="form-control" value="{{ old('form_select4', $pageData['form_select4'] ?? 'Full Event Branding') }}"></div>
    <div class="form-group"><label>Quantity Field Placeholder</label>
        <input type="text" name="form_qty" class="form-control" value="{{ old('form_qty', $pageData['form_qty'] ?? 'e.g. 50') }}"></div>
    <div class="form-group"><label>Message Field Placeholder</label>
        <textarea name="form_message" class="form-control">{{ old('form_message', $pageData['form_message'] ?? 'Tell us about colours, logos, deadlines...') }}</textarea></div>
    <div class="form-group"><label>File Upload Label</label>
        <input type="text" name="form_upload" class="form-control" value="{{ old('form_upload', $pageData['form_upload'] ?? 'Upload Logos / References') }}"></div>
    <div class="form-group"><label>Submit Button Text</label>
        <input type="text" name="form_btn" class="form-control" value="{{ old('form_btn', $pageData['form_btn'] ?? 'Request a Custom Order') }}"></div>
    <div class="form-group"><label>Trust Text (below submit button)</label>
        <input type="text" name="form_trust_text" class="form-control" value="{{ old('form_trust_text', $pageData['form_trust_text'] ?? 'Free quote. No commitment required.') }}"></div>
</div>
@endif
@if($pageId === 'blog')

<div class="form-section">
    <div class="form-section-title">Hero Section</div>
    <div class="form-group"><label>Page Title (Browser Tab)</label>
        <input type="text" name="page_title" class="form-control" value="{{ old('page_title', $pageData['page_title'] ?? 'Blog - OD Sports') }}"></div>
    <div class="form-group"><label>Hero Background Image</label>
        @include('admin.website-content._image_field', ['name' => 'hero_bg', 'value' => old('hero_bg', $pageData['hero_bg'] ?? 'https://images.unsplash.com/photo-1504016798967-59a258e9386d?auto=format&fit=crop&w=2000&q=80')])</div>
    <div class="form-group"><label>Hero Title</label>
        <input type="text" name="hero_title" class="form-control" value="{{ old('hero_title', $pageData['hero_title'] ?? 'News, Insights & Stories from Pakistan\'s Sports Scene') }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Latest Posts Section Heading</div>
    <div class="form-group"><label>Mini Label (small green text above heading)</label>
        <input type="text" name="posts_mini_label" class="form-control" value="{{ old('posts_mini_label', $pageData['posts_mini_label'] ?? 'OD SPORTS') }}"></div>
    <div class="form-group"><label>Title Word 1 (white)</label>
        <input type="text" name="posts_title_1" class="form-control" value="{{ old('posts_title_1', $pageData['posts_title_1'] ?? 'LATEST') }}"></div>
    <div class="form-group"><label>Title Word 2 (blue accent)</label>
        <input type="text" name="posts_title_2" class="form-control" value="{{ old('posts_title_2', $pageData['posts_title_2'] ?? 'BLOGS') }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Portfolio Stories Section</div>
    <div class="form-group"><label>Section Subtitle</label>
        <input type="text" name="portfolio_section_subtitle" class="form-control" value="{{ old('portfolio_section_subtitle', $pageData['portfolio_section_subtitle'] ?? 'From Our Portfolio') }}"></div>
    <div class="form-group"><label>Section Title Line 1</label>
        <input type="text" name="portfolio_section_title_1" class="form-control" value="{{ old('portfolio_section_title_1', $pageData['portfolio_section_title_1'] ?? 'Stories Behind the') }}"></div>
    <div class="form-group"><label>Section Title Line 2</label>
        <input type="text" name="portfolio_section_title_2" class="form-control" value="{{ old('portfolio_section_title_2', $pageData['portfolio_section_title_2'] ?? 'Projects') }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Featured Gears Section</div>
    <div class="form-group"><label>Title Part 1</label>
        <input type="text" name="gears_title_1" class="form-control" value="{{ old('gears_title_1', $pageData['gears_title_1'] ?? 'FEATURED') }}"></div>
    <div class="form-group"><label>Title Part 2 (accent)</label>
        <input type="text" name="gears_title_2" class="form-control" value="{{ old('gears_title_2', $pageData['gears_title_2'] ?? 'GEARS') }}"></div>
    <div class="form-group"><label>Subtitle</label>
        <input type="text" name="gears_subtitle" class="form-control" value="{{ old('gears_subtitle', $pageData['gears_subtitle'] ?? 'Professional grade equipment and apparel for serious athletes.') }}"></div>
    <div class="form-group"><label>"New" Badge Text</label>
        <input type="text" name="gears_badge_new" class="form-control" value="{{ old('gears_badge_new', $pageData['gears_badge_new'] ?? 'NEW') }}"></div>
    <div class="form-group"><label>"Sale" Badge Text</label>
        <input type="text" name="gears_badge_sale" class="form-control" value="{{ old('gears_badge_sale', $pageData['gears_badge_sale'] ?? 'SALE') }}"></div>
    <div class="form-group"><label>Add to Cart Button Text</label>
        <input type="text" name="gears_add_to_cart" class="form-control" value="{{ old('gears_add_to_cart', $pageData['gears_add_to_cart'] ?? 'ADD TO CART') }}"></div>
    <div class="form-group"><label>Empty Products Message</label>
        <input type="text" name="gears_empty_message" class="form-control" value="{{ old('gears_empty_message', $pageData['gears_empty_message'] ?? 'No featured products available yet. Check back soon!') }}"></div>
</div>

{{-- ═══════════════════════════════════════════════════════
     BLOG POSTS MANAGEMENT — Create / Edit / List
     Uses AJAX (no nested form conflict with main page form)
═══════════════════════════════════════════════════════ --}}

{{-- Quill rich-text editor assets --}}
<link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
<style>
    .ql-toolbar.ql-snow   { background:#1e293b; border-color:#475569; border-radius:8px 8px 0 0; }
    .ql-container.ql-snow { background:#0f172a; border-color:#475569; border-radius:0 0 8px 8px; color:#f1f5f9; min-height:260px; font-size:14px; }
    .ql-editor             { color:#f1f5f9; min-height:240px; }
    .ql-editor.ql-blank::before { color:#475569; }
    .ql-stroke             { stroke:#94a3b8 !important; }
    .ql-fill               { fill:#94a3b8 !important; }
    .ql-picker-label, .ql-picker-item { color:#94a3b8 !important; }
    .ql-picker-options     { background:#1e293b !important; border-color:#475569 !important; }
    .ql-picker-item:hover  { background:#334155 !important; }
    .bp-btn-primary { background:#1d4ed8; color:#fff; border:none; padding:9px 20px; border-radius:8px; cursor:pointer; font-size:13px; font-weight:600; transition:.2s; }
    .bp-btn-primary:hover  { background:#1e40af; }
    .bp-btn-primary:disabled { opacity:.5; cursor:not-allowed; }
    .bp-btn-secondary { background:#334155; color:#cbd5e1; border:none; padding:9px 20px; border-radius:8px; cursor:pointer; font-size:13px; font-weight:600; transition:.2s; }
    .bp-btn-secondary:hover { background:#475569; }
    .bp-status-badge { display:inline-block; padding:2px 10px; border-radius:4px; font-size:11px; font-weight:700; letter-spacing:.5px; text-transform:uppercase; }
</style>

{{-- Pass all post data to JS --}}
<script>
var _bpData = {
    @foreach($blogPosts as $_bp)
    "{{ $_bp->id }}": {
        name:        @json($_bp->getAttributes()['name']        ?? ''),
        description: @json($_bp->getAttributes()['description'] ?? ''),
        content:     @json($_bp->getAttributes()['content']     ?? ''),
        status:      @json((string)$_bp->status),
        created_at:  @json($_bp->created_at ? $_bp->created_at->format('Y-m-d\TH:i') : ''),
        @php
            $_bpImg = $_bp->image ?? '';
            if ($_bpImg && str_starts_with($_bpImg,'http'))              $_bpImgUrl = $_bpImg;
            elseif ($_bpImg && file_exists(public_path($_bpImg)))        $_bpImgUrl = asset($_bpImg);
            elseif ($_bpImg)                                             $_bpImgUrl = \RvMedia::getImageUrl($_bpImg);
            else                                                         $_bpImgUrl = '';
        @endphp
        image_url:   @json($_bpImgUrl),
    },
    @endforeach
};
var _bpCsrf   = "{{ csrf_token() }}";
var _bpStore  = "{{ route('admin.website-content.blog.posts.store') }}";
var _bpUpdate = "{{ url('admin/website-content/blog/posts') }}";
var _bpDelete = "{{ url('admin/website-content/blog/posts') }}";
</script>

<div class="form-section">
    <div class="form-section-title" style="display:flex;justify-content:space-between;align-items:center;">
        <span>Blog Posts ({{ $blogPosts->count() }})</span>
        <button type="button" class="bp-btn-primary" onclick="bpToggleForm(null)">+ New Post</button>
    </div>

    {{-- Create / Edit Form (hidden by default) --}}
    <div id="bp-form-wrap" style="display:none;background:#0f172a;border:1px solid #334155;border-radius:10px;padding:20px;margin-bottom:24px;">
        <h5 id="bp-form-heading" style="color:#60a5fa;margin:0 0 18px;font-size:15px;font-weight:700;">New Blog Post</h5>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group">
                <label>Title *</label>
                <input type="text" id="bp-title" class="form-control" placeholder="Post title">
            </div>
            <div class="form-group">
                <label>Slug (URL key)</label>
                <input type="text" id="bp-slug" class="form-control" placeholder="auto-generated-from-title">
            </div>
        </div>

        <div class="form-group">
            <label>Category Label <span style="color:#475569;font-weight:400;text-transform:none;">(optional — shown above title, e.g. EVENT MANAGEMENT | SPORTS NEWS)</span></label>
            <input type="text" id="bp-category" class="form-control" placeholder="e.g. DIGITAL MARKETING | SPORTS NEWS">
        </div>

        <div class="form-group">
            <label>Short Description <span style="color:#475569;font-weight:400;text-transform:none;">(shown in blog card listing)</span></label>
            <textarea id="bp-desc" class="form-control" rows="2" placeholder="Brief summary..."></textarea>
        </div>

        <div class="form-group">
            <label>Thumbnail / Cover Image</label>
            <div style="display:flex;align-items:flex-start;gap:14px;flex-wrap:wrap;">
                <img id="bp-img-preview" src="" alt="" style="display:none;width:140px;height:90px;object-fit:cover;border-radius:8px;border:1px solid #334155;">
                <div>
                    <input type="file" id="bp-img-file" accept="image/*" style="color:#94a3b8;font-size:13px;">
                    <div style="color:#475569;font-size:11px;margin-top:4px;">JPG, PNG, WEBP — max 5 MB</div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Content <span style="color:#475569;font-weight:400;text-transform:none;">(rich text)</span></label>
            <div id="bp-editor"></div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;">
            <div class="form-group">
                <label>Publish Date</label>
                <input type="datetime-local" id="bp-publish-date" class="form-control">
            </div>
            <div class="form-group">
                <label>Status</label>
                <select id="bp-status" class="form-control">
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                </select>
            </div>
        </div>

        <div style="display:flex;gap:12px;margin-top:6px;">
            <button type="button" id="bp-save-btn" class="bp-btn-primary" onclick="bpSave()">Save Post</button>
            <button type="button" class="bp-btn-secondary" onclick="bpCloseForm()">Cancel</button>
        </div>
        <div id="bp-msg" style="display:none;margin-top:14px;padding:10px 14px;border-radius:6px;font-size:13px;"></div>
    </div>

    {{-- Existing posts list --}}
    <div id="bp-list">
        @forelse($blogPosts as $_post)
        @php
            $_pImg = $_post->image ?? '';
            if ($_pImg && str_starts_with($_pImg,'http'))           $_pImgUrl = $_pImg;
            elseif ($_pImg && file_exists(public_path($_pImg)))     $_pImgUrl = asset($_pImg);
            elseif ($_pImg)                                         $_pImgUrl = \RvMedia::getImageUrl($_pImg);
            else                                                    $_pImgUrl = '';
            $_pStatus  = (string)$_post->status;
            $_pName    = $_post->getAttributes()['name'] ?? $_post->name;
        @endphp
        <div id="bp-row-{{ $_post->id }}" style="background:#0f172a;border:1px solid #2d3748;border-radius:10px;padding:12px 16px;margin-bottom:10px;display:flex;align-items:center;gap:14px;">
            @if($_pImgUrl)
                <img src="{{ $_pImgUrl }}" style="width:90px;height:60px;object-fit:cover;border-radius:6px;flex-shrink:0;">
            @else
                <div style="width:90px;height:60px;background:#1e293b;border-radius:6px;display:flex;align-items:center;justify-content:center;color:#475569;font-size:10px;flex-shrink:0;">No Image</div>
            @endif
            <div style="flex:1;min-width:0;">
                <div style="color:#f1f5f9;font-weight:600;font-size:14px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $_pName }}</div>
                <div style="color:#64748b;font-size:12px;margin-top:3px;">{{ $_post->created_at ? $_post->created_at->format('M d, Y') : '—' }}</div>
            </div>
            <span class="bp-status-badge" style="background:{{ $_pStatus==='published'?'#14532d':'#1e293b' }};color:{{ $_pStatus==='published'?'#86efac':'#94a3b8' }};flex-shrink:0;">
                {{ $_pStatus }}
            </span>
            <button type="button" class="bp-btn-primary" style="flex-shrink:0;padding:6px 14px;"
                onclick="bpToggleForm({{ $_post->id }})">Edit</button>
            <button type="button" style="flex-shrink:0;background:#7f1d1d;color:#fca5a5;border:none;padding:6px 14px;border-radius:8px;cursor:pointer;font-size:13px;font-weight:600;"
                onclick="bpDelete({{ $_post->id }}, this)">Delete</button>
        </div>
        @empty
        <p style="color:#64748b;font-style:italic;text-align:center;padding:24px;">No blog posts yet. Create your first one above.</p>
        @endforelse
    </div>
</div>

<script>
(function () {
    var quill      = null;
    var editingId  = null;

    function initQuill() {
        if (quill) return;
        quill = new Quill('#bp-editor', {
            theme: 'snow',
            placeholder: 'Write your blog post content here...',
            modules: { toolbar: [
                [{ header: [1,2,3,false] }],
                ['bold','italic','underline','strike'],
                ['blockquote','code-block'],
                [{ list:'ordered' },{ list:'bullet' }],
                ['link'],['clean']
            ]}
        });
    }

    window.bpToggleForm = function(postId) {
        var wrap = document.getElementById('bp-form-wrap');
        if (wrap.style.display !== 'none' && editingId == postId) {
            bpCloseForm(); return;
        }
        initQuill();
        editingId = postId;

        document.getElementById('bp-title').value       = '';
        document.getElementById('bp-slug').value        = '';
        document.getElementById('bp-category').value    = '';
        document.getElementById('bp-desc').value        = '';
        document.getElementById('bp-img-file').value    = '';
        document.getElementById('bp-publish-date').value = '';
        document.getElementById('bp-status').value      = 'published';
        document.getElementById('bp-msg').style.display = 'none';
        var preview = document.getElementById('bp-img-preview');
        preview.style.display = 'none'; preview.src = '';
        quill.root.innerHTML = '';

        if (postId && _bpData[postId]) {
            var d = _bpData[postId];
            document.getElementById('bp-form-heading').textContent = 'Edit Post';
            document.getElementById('bp-title').value        = d.name || '';
            var _rawDesc = d.description || '';
            var _sepIdx  = _rawDesc.indexOf('||');
            if (_sepIdx !== -1) {
                document.getElementById('bp-category').value = _rawDesc.substring(0, _sepIdx).trim();
                document.getElementById('bp-desc').value     = _rawDesc.substring(_sepIdx + 2).trim();
            } else {
                document.getElementById('bp-category').value = '';
                document.getElementById('bp-desc').value     = _rawDesc;
            }
            document.getElementById('bp-status').value       = d.status      || 'published';
            document.getElementById('bp-publish-date').value = d.created_at  || '';
            quill.root.innerHTML = d.content || '';
            if (d.image_url) { preview.src = d.image_url; preview.style.display = 'block'; }
        } else {
            document.getElementById('bp-form-heading').textContent = 'New Blog Post';
        }

        wrap.style.display = 'block';
        wrap.scrollIntoView({ behavior: 'smooth', block: 'start' });
    };

    window.bpCloseForm = function() {
        document.getElementById('bp-form-wrap').style.display = 'none';
        editingId = null;
    };

    window.bpSave = function() {
        var title = document.getElementById('bp-title').value.trim();
        if (!title) { alert('Please enter a post title.'); return; }

        var btn = document.getElementById('bp-save-btn');
        btn.disabled = true; btn.textContent = 'Saving…';

        var fd = new FormData();
        fd.append('_token',            _bpCsrf);
        fd.append('post_title',        title);
        fd.append('post_slug',         document.getElementById('bp-slug').value.trim());
        var _cat  = document.getElementById('bp-category').value.trim();
        var _desc = document.getElementById('bp-desc').value.trim();
        fd.append('post_description', _cat ? (_cat + '||' + _desc) : _desc);
        fd.append('post_content',      quill ? quill.root.innerHTML : '');
        fd.append('post_status',       document.getElementById('bp-status').value);
        fd.append('post_publish_date', document.getElementById('bp-publish-date').value);
        var imgFile = document.getElementById('bp-img-file').files[0];
        if (imgFile) fd.append('post_image_file', imgFile);

        var url = editingId ? (_bpUpdate + '/' + editingId + '/update') : _bpStore;

        fetch(url, { method: 'POST', body: fd })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                btn.disabled = false; btn.textContent = 'Save Post';
                var msg = document.getElementById('bp-msg');
                if (data.success) {
                    msg.style.display   = 'block';
                    msg.style.background = '#14532d';
                    msg.style.color      = '#86efac';
                    msg.textContent      = 'Post saved successfully! Refreshing…';
                    setTimeout(function() { window.location.reload(); }, 1200);
                } else {
                    msg.style.display   = 'block';
                    msg.style.background = '#7f1d1d';
                    msg.style.color      = '#fca5a5';
                    msg.textContent      = 'Error: ' + (data.message || 'Unknown error');
                }
            })
            .catch(function(err) {
                btn.disabled = false; btn.textContent = 'Save Post';
                alert('Request failed: ' + err);
            });
    };

    // Auto-generate slug from title (new posts only)
    document.getElementById('bp-title').addEventListener('input', function() {
        if (editingId) return;
        document.getElementById('bp-slug').value = this.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g,'').replace(/\s+/g,'-').replace(/-+/g,'-').replace(/^-|-$/g,'');
    });

    // Delete post
    window.bpDelete = function(postId, btn) {
        if (!confirm('Delete this post? This cannot be undone.')) return;
        btn.disabled = true; btn.textContent = 'Deleting…';
        var fd = new FormData();
        fd.append('_token', _bpCsrf);
        fd.append('_method', 'DELETE');
        fetch(_bpDelete + '/' + postId + '/delete', { method: 'POST', body: fd })
            .then(function(r) { return r.json(); })
            .then(function(data) {
                if (data.success) {
                    var row = document.getElementById('bp-row-' + postId);
                    if (row) row.remove();
                } else {
                    btn.disabled = false; btn.textContent = 'Delete';
                    alert('Error: ' + (data.message || 'Could not delete post'));
                }
            })
            .catch(function(err) {
                btn.disabled = false; btn.textContent = 'Delete';
                alert('Request failed: ' + err);
            });
    };

    // Instant image preview
    document.getElementById('bp-img-file').addEventListener('change', function() {
        var f = this.files[0]; if (!f) return;
        var reader = new FileReader();
        reader.onload = function(e) {
            var p = document.getElementById('bp-img-preview');
            p.src = e.target.result; p.style.display = 'block';
        };
        reader.readAsDataURL(f);
    });
}());
</script>

<div class="form-section">
    <div class="form-section-title">Page Settings</div>
    <div class="form-group"><label>Page Title (Browser Tab)</label>
        <input type="text" name="page_title" class="form-control" value="{{ old('page_title', $pageData['page_title'] ?? 'Blog - OD Sports') }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Hero Section</div>
    <div class="form-group"><label>Hero Background Image</label>
        @include('admin.website-content._image_field', ['name' => 'hero_bg', 'value' => old('hero_bg', $pageData['hero_bg'] ?? 'https://images.unsplash.com/photo-1504016798967-59a258e9386d?auto=format&fit=crop&w=2000&q=80')])</div>
    <div class="form-group"><label>Hero Subtitle</label>
        <input type="text" name="hero_subtitle" class="form-control" value="{{ old('hero_subtitle', $pageData['hero_subtitle'] ?? 'OD SPORTS BLOG') }}"></div>
    <div class="form-group"><label>Hero Title</label>
        <textarea name="hero_title" class="form-control">{{ old('hero_title', $pageData['hero_title'] ?? 'News, Insights & Stories <br>from Pakistan\'s Sports Scene') }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Portfolio Stories Section</div>
    <div class="form-group"><label>Section Subtitle (small text above title)</label>
        <input type="text" name="portfolio_section_subtitle" class="form-control" value="{{ old('portfolio_section_subtitle', $pageData['portfolio_section_subtitle'] ?? 'From Our Portfolio') }}"></div>
    <div class="form-group"><label>Section Title Part 1</label>
        <input type="text" name="portfolio_section_title_1" class="form-control" value="{{ old('portfolio_section_title_1', $pageData['portfolio_section_title_1'] ?? 'Stories Behind the') }}"></div>
    <div class="form-group"><label>Section Title Part 2 (colored)</label>
        <input type="text" name="portfolio_section_title_2" class="form-control" value="{{ old('portfolio_section_title_2', $pageData['portfolio_section_title_2'] ?? 'Projects') }}"></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Project 1 — Islamabad Marathon & IRU</h5>
    <div class="form-group"><label>Project 1 Image</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_1_img', 'value' => old('portfolio_1_img', $pageData['portfolio_1_img'] ?? '')])</div>
    <div class="form-group"><label>Project 1 Category</label>
        <input type="text" name="portfolio_1_category" class="form-control" value="{{ old('portfolio_1_category', $pageData['portfolio_1_category'] ?? '') }}"></div>
    <div class="form-group"><label>Project 1 Title</label>
        <input type="text" name="portfolio_1_title" class="form-control" value="{{ old('portfolio_1_title', $pageData['portfolio_1_title'] ?? '') }}"></div>
    <div class="form-group"><label>Project 1 Description</label>
        <textarea name="portfolio_gallery1_desc" class="form-control" style="min-height: 160px;">{{ old('portfolio_gallery1_desc', $pageData['portfolio_gallery1_desc'] ?? '') }}</textarea></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Project 2 — Margalla Trail Runners</h5>
    <div class="form-group"><label>Project 2 Image</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_2_img', 'value' => old('portfolio_2_img', $pageData['portfolio_2_img'] ?? '')])</div>
    <div class="form-group"><label>Project 2 Category</label>
        <input type="text" name="portfolio_2_category" class="form-control" value="{{ old('portfolio_2_category', $pageData['portfolio_2_category'] ?? '') }}"></div>
    <div class="form-group"><label>Project 2 Title</label>
        <input type="text" name="portfolio_2_title" class="form-control" value="{{ old('portfolio_2_title', $pageData['portfolio_2_title'] ?? '') }}"></div>
    <div class="form-group"><label>Project 2 Description</label>
        <textarea name="portfolio_gallery2_desc" class="form-control" style="min-height: 160px;">{{ old('portfolio_gallery2_desc', $pageData['portfolio_gallery2_desc'] ?? '') }}</textarea></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Project 3 — YourPace by inDrive</h5>
    <div class="form-group"><label>Project 3 Image</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_3_img', 'value' => old('portfolio_3_img', $pageData['portfolio_3_img'] ?? '')])</div>
    <div class="form-group"><label>Project 3 Category</label>
        <input type="text" name="portfolio_3_category" class="form-control" value="{{ old('portfolio_3_category', $pageData['portfolio_3_category'] ?? '') }}"></div>
    <div class="form-group"><label>Project 3 Title</label>
        <input type="text" name="portfolio_3_title" class="form-control" value="{{ old('portfolio_3_title', $pageData['portfolio_3_title'] ?? '') }}"></div>
    <div class="form-group"><label>Project 3 Description</label>
        <textarea name="portfolio_gallery3_desc" class="form-control" style="min-height: 160px;">{{ old('portfolio_gallery3_desc', $pageData['portfolio_gallery3_desc'] ?? '') }}</textarea></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Project 4 — Twin City Run & Night Run</h5>
    <div class="form-group"><label>Project 4 Image</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_4_img', 'value' => old('portfolio_4_img', $pageData['portfolio_4_img'] ?? '')])</div>
    <div class="form-group"><label>Project 4 Category</label>
        <input type="text" name="portfolio_4_category" class="form-control" value="{{ old('portfolio_4_category', $pageData['portfolio_4_category'] ?? '') }}"></div>
    <div class="form-group"><label>Project 4 Title</label>
        <input type="text" name="portfolio_4_title" class="form-control" value="{{ old('portfolio_4_title', $pageData['portfolio_4_title'] ?? '') }}"></div>
    <div class="form-group"><label>Project 4 Description</label>
        <textarea name="portfolio_gallery4_desc" class="form-control" style="min-height: 160px;">{{ old('portfolio_gallery4_desc', $pageData['portfolio_gallery4_desc'] ?? '') }}</textarea></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Project 5 — IRC Running Series</h5>
    <div class="form-group"><label>Project 5 Image</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_5_img', 'value' => old('portfolio_5_img', $pageData['portfolio_5_img'] ?? '')])</div>
    <div class="form-group"><label>Project 5 Category</label>
        <input type="text" name="portfolio_5_category" class="form-control" value="{{ old('portfolio_5_category', $pageData['portfolio_5_category'] ?? '') }}"></div>
    <div class="form-group"><label>Project 5 Title</label>
        <input type="text" name="portfolio_5_title" class="form-control" value="{{ old('portfolio_5_title', $pageData['portfolio_5_title'] ?? '') }}"></div>
    <div class="form-group"><label>Project 5 Description</label>
        <textarea name="portfolio_gallery5_desc" class="form-control" style="min-height: 160px;">{{ old('portfolio_gallery5_desc', $pageData['portfolio_gallery5_desc'] ?? '') }}</textarea></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Project 6 — Tabarak Runs Cross-Pakistan</h5>
    <div class="form-group"><label>Project 6 Image</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_6_img', 'value' => old('portfolio_6_img', $pageData['portfolio_6_img'] ?? '')])</div>
    <div class="form-group"><label>Project 6 Category</label>
        <input type="text" name="portfolio_6_category" class="form-control" value="{{ old('portfolio_6_category', $pageData['portfolio_6_category'] ?? '') }}"></div>
    <div class="form-group"><label>Project 6 Title</label>
        <input type="text" name="portfolio_6_title" class="form-control" value="{{ old('portfolio_6_title', $pageData['portfolio_6_title'] ?? '') }}"></div>
    <div class="form-group"><label>Project 6 Description</label>
        <textarea name="portfolio_gallery6_desc" class="form-control" style="min-height: 160px;">{{ old('portfolio_gallery6_desc', $pageData['portfolio_gallery6_desc'] ?? '') }}</textarea></div>

    <h5 style="color: #60a5fa; margin: 20px 0 10px;">Project 7 — Shehroze Kashif 14x8000er</h5>
    <div class="form-group"><label>Project 7 Image</label>
        @include('admin.website-content._image_field', ['name' => 'portfolio_7_img', 'value' => old('portfolio_7_img', $pageData['portfolio_7_img'] ?? '')])</div>
    <div class="form-group"><label>Project 7 Category</label>
        <input type="text" name="portfolio_7_category" class="form-control" value="{{ old('portfolio_7_category', $pageData['portfolio_7_category'] ?? '') }}"></div>
    <div class="form-group"><label>Project 7 Title</label>
        <input type="text" name="portfolio_7_title" class="form-control" value="{{ old('portfolio_7_title', $pageData['portfolio_7_title'] ?? '') }}"></div>
    <div class="form-group"><label>Project 7 Description</label>
        <textarea name="portfolio_gallery7_desc" class="form-control" style="min-height: 160px;">{{ old('portfolio_gallery7_desc', $pageData['portfolio_gallery7_desc'] ?? '') }}</textarea></div>
</div>

<div class="form-section">
    <div class="form-section-title">Featured Gears Section</div>
    <div class="form-group"><label>Gears Section Title</label>
        <textarea name="gears_title" class="form-control">{{ old('gears_title', $pageData['gears_title'] ?? 'FEATURED <span class="highlight">GEARS</span>') }}</textarea></div>
    <div class="form-group"><label>Gears Section Subtitle</label>
        <input type="text" name="gears_subtitle" class="form-control" value="{{ old('gears_subtitle', $pageData['gears_subtitle'] ?? 'Professional grade equipment and apparel for serious athletes.') }}"></div>
    <div class="form-group"><label>"NEW" Badge Text</label>
        <input type="text" name="gears_badge_new" class="form-control" value="{{ old('gears_badge_new', $pageData['gears_badge_new'] ?? 'NEW') }}"></div>
    <div class="form-group"><label>"SALE" Badge Text</label>
        <input type="text" name="gears_badge_sale" class="form-control" value="{{ old('gears_badge_sale', $pageData['gears_badge_sale'] ?? 'SALE') }}"></div>
    <div class="form-group"><label>Add to Cart Button Text</label>
        <input type="text" name="gears_add_to_cart" class="form-control" value="{{ old('gears_add_to_cart', $pageData['gears_add_to_cart'] ?? 'ADD TO CART') }}"></div>
    <div class="form-group"><label>Empty State Message (when no products)</label>
        <input type="text" name="gears_empty_message" class="form-control" value="{{ old('gears_empty_message', $pageData['gears_empty_message'] ?? 'No featured products available yet. Check back soon!') }}"></div>

    <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid #334155;">
        <h5 style="color: #60a5fa; margin-bottom: 16px;">Featured Products ({{ isset($featuredProducts) ? count($featuredProducts) : 0 }})</h5>
        @if(isset($featuredProducts) && count($featuredProducts) > 0)
            @foreach($featuredProducts as $index => $product)
            @php
                $images = is_array($product->images) ? $product->images : json_decode($product->images, true);
                $rawImgVal = !empty($images[0]) ? $images[0] : ($product->image ?? '');
            @endphp
            <div style="background: #0f172a; border: 1px solid #334155; border-radius: 10px; padding: 16px; margin-bottom: 16px;">
                <h6 style="color: #60a5fa; margin: 0 0 14px;">Product {{ $index + 1 }}</h6>
                <input type="hidden" name="product_id_{{ $index }}" value="{{ $product->id }}">
                <div class="form-group"><label>Product Image</label>
                    @include('admin.website-content._image_field', ['name' => 'product_img_' . $index, 'value' => $rawImgVal])</div>
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div class="form-group" style="margin-bottom: 0;"><label>Product Name</label>
                        <input type="text" name="product_name_{{ $index }}" class="form-control" value="{{ $product->name }}"></div>
                    <div class="form-group" style="margin-bottom: 0;"><label>Price ($)</label>
                        <input type="number" name="product_price_{{ $index }}" class="form-control" value="{{ $product->sale_price ?: $product->price }}" step="0.01"></div>
                </div>
            </div>
            @endforeach
        @else
            <p style="color: #64748b; font-style: italic;">No featured products found.</p>
        @endif
    </div>
</div>
@endif
@if($pageId === 'global_settings')
<div class="form-section">
    <div class="form-section-title">Header Configuration</div>
    <div class="form-group"><label>Site Title</label>
        <input type="text" name="site_title" class="form-control" value="{{ old('site_title', theme_option('global_site_title', 'OD SPORTS - Premium Sports Solutions')) }}"></div>
    <div class="form-group"><label>Site Logo</label>
        @include('admin.website-content._image_field', ['name' => 'site_logo', 'value' => old('site_logo', theme_option('global_site_logo', 'favicon.jpeg'))])</div>
    <div class="form-group"><label>Nav: Home</label>
        <input type="text" name="nav_home" class="form-control" value="{{ old('nav_home', theme_option('global_nav_home', 'HOME')) }}"></div>
    <div class="form-group"><label>Nav: Services</label>
        <input type="text" name="nav_services" class="form-control" value="{{ old('nav_services', theme_option('global_nav_services', 'SERVICES')) }}"></div>
    <div class="form-group"><label>Nav: Portfolio</label>
        <input type="text" name="nav_portfolio" class="form-control" value="{{ old('nav_portfolio', theme_option('global_nav_portfolio', 'PORTFOLIO')) }}"></div>
    <div class="form-group"><label>Nav: About</label>
        <input type="text" name="nav_about" class="form-control" value="{{ old('nav_about', theme_option('global_nav_about', 'ABOUT')) }}"></div>
    <div class="form-group"><label>Nav: Orders</label>
        <input type="text" name="nav_orders" class="form-control" value="{{ old('nav_orders', theme_option('global_nav_orders', 'CUSTOM ORDERS')) }}"></div>
    <div class="form-group"><label>Nav: Blog</label>
        <input type="text" name="nav_blog" class="form-control" value="{{ old('nav_blog', theme_option('global_nav_blog', 'BLOGS')) }}"></div>
    <div class="form-group"><label>Nav: Contact</label>
        <input type="text" name="nav_contact" class="form-control" value="{{ old('nav_contact', theme_option('global_nav_contact', 'CONTACT')) }}"></div>
    <div class="form-group"><label>Search Placeholder</label>
        <input type="text" name="nav_search_placeholder" class="form-control" value="{{ old('nav_search_placeholder', theme_option('global_nav_search_placeholder', 'Search...')) }}"></div>
    <div class="form-group"><label>CTA Button Text</label>
        <input type="text" name="navbar_cta_text" class="form-control" value="{{ old('navbar_cta_text', theme_option('global_navbar_cta_text', 'BOOK A MEETING')) }}"></div>
    <div class="form-group"><label>CTA Button Link</label>
        <input type="text" name="navbar_cta_link" class="form-control" value="{{ old('navbar_cta_link', theme_option('global_navbar_cta_link', '#contact')) }}"></div>
</div>

<div class="form-section">
    <div class="form-section-title">Footer Configuration</div>
    <div class="form-group"><label>Footer Slogan</label>
        <input type="text" name="footer_slogan" class="form-control" value="{{ old('footer_slogan', theme_option('global_footer_slogan', 'Sport. Strategy. Story.')) }}"></div>
    <div class="form-group"><label>Company Address</label>
        <input type="text" name="company_address" class="form-control" value="{{ old('company_address', theme_option('global_company_address', 'Blue Area, Islamabad')) }}"></div>
    <div class="form-group"><label>Company Phone</label>
        <input type="text" name="company_phone" class="form-control" value="{{ old('company_phone', theme_option('global_company_phone', '+92 320 1223359')) }}"></div>
    <div class="form-group"><label>Company Email</label>
        <input type="text" name="company_email" class="form-control" value="{{ old('company_email', theme_option('global_company_email', 'hello@odsports.com')) }}"></div>
    <div class="form-group"><label>Facebook Link</label>
        <input type="text" name="social_facebook" class="form-control" value="{{ old('social_facebook', theme_option('global_social_facebook', '#')) }}"></div>
    <div class="form-group"><label>Instagram Link</label>
        <input type="text" name="social_instagram" class="form-control" value="{{ old('social_instagram', theme_option('global_social_instagram', '#')) }}"></div>
    <div class="form-group"><label>YouTube Link</label>
        <input type="text" name="social_youtube" class="form-control" value="{{ old('social_youtube', theme_option('global_social_youtube', '#')) }}"></div>
    <div class="form-group"><label>TikTok Link</label>
        <input type="text" name="social_tiktok" class="form-control" value="{{ old('social_tiktok', theme_option('global_social_tiktok', '#')) }}"></div>
    <div class="form-group"><label>LinkedIn Link</label>
        <input type="text" name="social_linkedin" class="form-control" value="{{ old('social_linkedin', theme_option('global_social_linkedin', '#')) }}"></div>
    <div class="form-group"><label>Copyright Text</label>
        <input type="text" name="footer_copyright" class="form-control" value="{{ old('footer_copyright', theme_option('global_footer_copyright', '© 2025 OD Sports — Part of Optimize Digital. All rights reserved.')) }}"></div>
</div>
@endif

        <div class="form-group" style="margin-top: 30px;">
            <button type="submit" class="btn-primary">Save Changes</button>
            <a href="{{ route('admin.website-content.index') }}" class="btn-secondary" style="margin-left: 12px;">Cancel</a>
        </div>
    </form>

<!-- Fullscreen Lightbox -->
<div class="img-lightbox-overlay" id="imgLightbox">
    <button class="img-lightbox-close" id="imgLightboxClose">&times;</button>
    <img src="" alt="Full size preview" id="imgLightboxImg">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var lightbox = document.getElementById('imgLightbox');
    var lightboxImg = document.getElementById('imgLightboxImg');

    // VIEW — open image fullscreen
    document.querySelectorAll('.img-act-view').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var widget = this.closest('.custom-img-widget');
            var img = widget.querySelector('.img-preview');
            if (img && img.src && img.src !== window.location.href) {
                lightboxImg.src = img.src;
                lightbox.classList.add('active');
            }
        });
    });

    // Also open lightbox by clicking the preview image
    document.querySelectorAll('.img-preview').forEach(function(img) {
        img.addEventListener('click', function() {
            if (this.src && this.src !== window.location.href) {
                lightboxImg.src = this.src;
                lightbox.classList.add('active');
            }
        });
    });

    // Close lightbox
    document.getElementById('imgLightboxClose').addEventListener('click', function() {
        lightbox.classList.remove('active');
    });
    lightbox.addEventListener('click', function(e) {
        if (e.target === lightbox) lightbox.classList.remove('active');
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') lightbox.classList.remove('active');
    });

    // REPLACE — open file picker from PC
    document.querySelectorAll('.img-act-replace').forEach(function(btn) {
        btn.addEventListener('click', function() {
            var widget = this.closest('.custom-img-widget');
            widget.querySelector('.img-file-input').click();
        });
    });

    // DELETE — clear image value, set delete flag, hide preview
    document.querySelectorAll('.img-act-delete').forEach(function(btn) {
        btn.addEventListener('click', function() {
            if (!confirm('Remove this image? Save Changes to apply.')) return;
            var widget = this.closest('.custom-img-widget');
            widget.querySelector('.img-value').value = '';
            widget.querySelector('.img-delete-flag').value = '1';
            widget.querySelector('.img-file-input').value = '';
            var preview = widget.querySelector('.img-preview');
            if (preview) { preview.src = ''; }
            widget.querySelector('.img-preview-area').style.display = 'none';
            widget.querySelector('.img-empty').style.display = '';
            widget.querySelector('.img-act-view').disabled = true;
            this.disabled = true;
        });
    });

    // File selected — show instant preview
    document.querySelectorAll('.img-file-input').forEach(function(input) {
        input.addEventListener('change', function() {
            var widget = this.closest('.custom-img-widget');
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = widget.querySelector('.img-preview');
                    img.src = e.target.result;
                    widget.querySelector('.img-preview-area').style.display = '';
                    widget.querySelector('.img-empty').style.display = 'none';
                    widget.querySelector('.img-act-view').disabled = false;
                };
                reader.readAsDataURL(this.files[0]);
            }
        });
    });

});
</script>
@endsection
