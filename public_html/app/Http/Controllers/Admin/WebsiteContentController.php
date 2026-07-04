<?php

namespace App\Http\Controllers\Admin;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Http\Responses\BaseHttpResponse;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Theme;

class WebsiteContentController extends BaseController
{
    protected $pages = [
        'homepage' => 'Page: Homepage',
        'services_index' => 'Page: Services Main',
        'services_event_management' => 'Service: Event Management',
        'services_media_production' => 'Service: Media Production',
        'services_sports_marketing' => 'Service: Sports Marketing',

        'services_campaign_design' => 'Service: Campaign Design',
        'services_influencer_marketing' => 'Service: Influencer Marketing',
        'services_custom_printing' => 'Service: Custom Printing',
        'portfolio' => 'Page: Portfolio',
        'about' => 'Page: About Us',
        'custom_orders' => 'Page: Custom Orders',
        'blog' => 'Page: Blog',
        'global_settings' => 'Global Settings (Header & Footer)',
    ];

    public function index()
    {
        page_title()->setTitle('Website Content Management');

        return view('admin.website-content.index', [
            'pages' => $this->pages,
        ]);
    }

    public function edit($pageId)
    {
        if (!isset($this->pages[$pageId])) {
            abort(404);
        }

        page_title()->setTitle('Edit: ' . $this->pages[$pageId]);

        // Get all theme options for this page
        $pageData = [];
        $prefixMap = [
            'homepage' => 'homepage_',
            'services_index' => 'services_index_',
            'services_event_management' => 'event_',
            'services_media_production' => 'media_',
            'services_sports_marketing' => 'sportsmarketing_',
            'services_campaign_design' => 'campaign_',
            'services_influencer_marketing' => 'influencer_',
            'services_custom_printing' => 'printing_',
            'portfolio' => 'portfolio_',
            'about' => 'about_',
            'custom_orders' => 'orders_',
            'blog' => 'blog_',
            'contact' => 'contact_',
            'global_settings' => 'global_',
        ];
        $prefix = $prefixMap[$pageId] ?? $pageId . '_';

        // Common fields for all pages
        $fields = [
            'published' => 'yes',
            'seo_title' => '',
            'seo_description' => '',
            'page_title' => '',
        ];

        // Homepage specific fields
        if ($pageId === 'homepage') {
            $homepageFields = [
                'hero_bg' => '',
                'badge' => 'ESTABLISHED 2022',
                'heading' => 'We Plan, Promote & Produce Sports Events Across Pakistan',
                'description' => 'From grassroots tournaments to national championships, OD Sports is Pakistan’s most trusted sports agency delivering end-to-end planning, production, and promotion for every sport, every scale and every stage.',
                'btn_primary' => 'Book your meeting',
                'btn_secondary' => 'See Our Work',
                'ticker_1' => '18.6M+ Video Views',
                'ticker_2' => '| 8.66M+ People Reached',
                'ticker_3' => '| 6,000+ Athletes Participated',
                'ticker_4' => '| 25+ Events Delivered',
                'ticker_5' => '| 3+ Years as Pakistan’s Most Trusted Sports Agency',
                'expertise_title' => 'Where Sport Meets Strategy',
                'expertise_subtitle' => 'OD Sports isn’t just a production house. We are a sports-first strategy agency. We help brands, federations, and event organisers build community-driven campaigns that turn casual followers into lifelong participants.',
                'expertise_main_title' => 'Pakistan’s Most Trusted Sports Agency',
                'expertise_main_desc_1' => 'OD Sports is a full-service sports agency operating at the intersection of sport, media, and experience design. We work with running communities, sports federations, event organisers, fitness brands, and corporate partners to deliver world-class sports experiences from planning to execution to amplification.',
                'expertise_main_desc_2' => 'From marathons and trail races to cycling, triathlons, and multi-sport events, we don’t just organise events we build sporting culture across Pakistan. Every detail is designed to elevate performance, participation and visibility.',
                'expertise_img_1' => '',
                'expertise_img_2' => '',
                'expertise_btn' => 'Learn Our Story →',
                'services_title' => 'Full-Service Sports Solutions for Every Game',
                'services_subtitle' => 'OD Sports is Pakistan’s Most Trusted Sports Agency — delivering complete solutions for sports events, teams, and brands across the country.',
                'service_1_title' => 'Sports Event Management',
                'service_1_desc' => 'Planning & execution for road marathons and indoor tournaments.',
                'service_1_btn' => 'Learn More →',
                'service_2_title' => 'Sports Media Production',
                'service_2_desc' => 'High-performing photo, video, and live stream content.',
                'service_2_btn' => 'Learn More →',
                'service_3_title' => 'Sports Marketing & Strategy',
                'service_3_desc' => 'Community-first strategies that turn followers into fans.',
                'service_3_btn' => 'Learn More →',
                'service_4_title' => 'Digital Campaign Design',
                'service_4_desc' => 'High-energy visual identities and social media kits.',
                'service_4_btn' => 'Learn More →',
                'service_5_title' => 'Custom Printing & Merchandise',
                'service_5_desc' => 'Elite jerseys, banners, and technical sports gear.',
                'service_5_btn' => 'Learn More →',
                'service_6_title' => 'Influencer & Athlete Marketing',
                'service_6_desc' => 'Authentic reach through Pakistan’s top fitness leaders.',
                'service_6_btn' => 'Learn More →',
                'portfolio_title' => 'From the Field to the Feed',
                'portfolio_badge' => 'FEATURED <span class="highlight">PROJECTS</span>',
                'portfolio_subtitle' => 'We\'ve been behind some of Pakistan\'s biggest sports moments. Here\'s a taste of what we\'ve built.',
                'portfolio_1_img' => 'portfolio/marathon_race_day.png',
                'portfolio_2_img' => 'portfolio/kids_running.png',
                'portfolio_3_img' => 'portfolio/trail_runner.png',
                'portfolio_1_tag' => 'MARATHON 2022-2025',
                'portfolio_1_title' => 'Islamabad Marathon 2022–2025',
                'portfolio_1_desc' => '3-year ongoing digital and event partner. Grew the event from 500 to 6,000+ participants. Delivered 18.6M video views and reached 8.66M people.',
                'portfolio_2_tag' => 'KIDS RUNNING',
                'portfolio_2_title' => 'YourPace by inDrive',
                'portfolio_2_desc' => 'Pakistan launch of a global kids running movement. Multi-city execution across Islamabad and Karachi — branding, event management, and full documentary production.',
                'portfolio_3_tag' => 'TRAIL RUNNING',
                'portfolio_3_title' => 'Galyat Mountain Trail & Margalla Trail Runners',
                'portfolio_3_desc' => 'Official media partner for MTR since 2024. Covered the Backyard Ultra, Hill Half Marathon, and Trail Running Festival with cinematic productions that reached 476K+ people.',
                'portfolio_1_btn' => 'View Case Study →',
                'portfolio_btn' => 'View Full Portfolio →',
                'stats_bg' => '',
                'stat_1_number' => '18.6M+',
                'stat_1_label' => 'Video Views',
                'stat_2_number' => '8.66M+',
                'stat_2_label' => 'People Reached',
                'stat_3_number' => '6,000+',
                'stat_3_label' => 'Marathon Participants',
                'stat_4_number' => '25+',
                'stat_4_label' => 'Events Delivered',
                'testimonials_title' => 'Trusted by Pakistan\'s Sports Community',
                'testimonial_1_img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=200',
                'testimonial_1_name' => 'Qasim Naz',
                'testimonial_1_title' => 'Founder, Islamabad Run With Us (IRU)',
                'testimonial_1_quote' => 'Optimize Digital has been an integral partner in the journey of the Islamabad Marathon — the pioneer marathon in Pakistan. From the very beginning, their dedication and expertise in digital outreach have played a vital role in the growth and success of this event.',
                'testimonial_2_img' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&q=80&w=200',
                'testimonial_2_name' => 'Brent Weigner',
                'testimonial_2_title' => 'Globally Renowned Running Icon',
                'testimonial_2_quote' => 'I\'ve never seen this level of Facebook and Instagram coverage for any event before. It was brilliant — timely, engaging, and incredibly well done.',
                'contact_title' => 'Ready to Take Your <br><span class="highlight">Sports Brand Further?</span>',
                'contact_subtitle' => 'Whether you\'re organising a city-wide run, launching an athleisure brand, or building a cricket community — OD Sports is the team that gets it done.',
                'contact_check_1' => 'Professional Event Execution',
                'contact_check_2' => 'Digital Visibility & Growth',
                'contact_check_3' => 'Expert Sports Storytelling',
                'contact_form_name' => 'Your Name',
                'contact_form_org' => 'Organization/Brand',
                'contact_form_service_label' => 'Interested Service',
                'contact_form_service_1' => 'Event Management',
                'contact_form_service_2' => 'Media Production',
                'contact_form_service_3' => 'Sports Marketing',
                'contact_form_service_4' => 'Digital Campaign Design',
                'contact_form_service_5' => 'Custom Printing',
                'contact_form_service_6' => 'Influencer Marketing',
                'contact_form_message' => 'Tell us about your sports project...',
                'contact_form_btn' => 'Schedule a Call',
                'team_title' => 'The Team Behind <span class="highlight">The Moments</span>',
                'team_subtitle' => 'A passionate crew of creatives, strategists, and sports enthusiasts driving every project forward.',
                'team_btn' => 'Meet the Full Team →',
                'team_1_img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&q=80&w=300',
                'team_1_name' => 'Imran Ghazali',
                'team_1_title' => 'Founder & CEO',
                'team_2_img' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=300',
                'team_2_name' => 'Aqib Mughal',
                'team_2_title' => 'Director, Client Relations & Ops',
                'team_3_img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&q=80&w=300',
                'team_3_name' => 'Laiba Shakeel',
                'team_3_title' => 'Senior Manager, Digital',
                'team_4_img' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&q=80&w=300',
                'team_4_name' => 'Ansab Naeem',
                'team_4_title' => 'Director, Media Production',
                'blogs_title' => 'BLOGS',
                'gears_title' => 'FEATURED <span class="highlight">GEARS</span>',
                'gears_subtitle' => 'Professional grade equipment and apparel for serious athletes.',
                'gears_add_to_cart' => 'ADD TO CART',
                // YouTube Videos Section
                'videos_label'        => 'OD SPORTS',
                'videos_title'        => 'WATCH OUR WORK',
                'videos_subtitle'     => 'Behind-the-lens footage from Pakistan\'s biggest sports events.',
                'video_1_id'          => 'z3OUvM8NgNU',
                'video_1_title'       => 'YourPace by inDrive',
                'video_1_tag'         => 'KIDS RUNNING',
                'video_2_id'          => 'Xp7ZnFyOseg',
                'video_2_title'       => 'Galyat Mountain Trail',
                'video_2_tag'         => 'TRAIL RUNNING',
                'video_3_id'          => '15CinzcMKgA',
                'video_3_title'       => 'Night Run 2024',
                'video_3_tag'         => 'NIGHT RUN',
                'video_4_id'          => 'p-RvgDnhvQc',
                'video_4_title'       => 'Twin City Half Marathon',
                'video_4_tag'         => 'HALF MARATHON',
                'video_5_id'          => 'meOZ57_pNYU',
                'video_5_title'       => 'Backyard Ultra 2024',
                'video_5_tag'         => 'ULTRA RUNNING',
                'video_6_id'          => '5AN4tLsq30o',
                'video_6_title'       => 'Islamabad Marathon 2024',
                'video_6_tag'         => 'MARATHON',
                'video_7_id'          => 'N4Jo-hZBa-I',
                'video_7_title'       => 'Islamabad Half Marathon 2024',
                'video_7_tag'         => 'HALF MARATHON',
                'video_8_id'          => 'Cc58yMaX9ZM',
                'video_8_title'       => 'Margalla Half Marathon 2024',
                'video_8_tag'         => 'TRAIL RUNNING',
                'video_9_id'          => '-B1M7-wZS-w',
                'video_9_title'       => 'IRU Half Marathon 2025',
                'video_9_tag'         => 'MARATHON',
                'video_10_id'         => 'Ad3owg95AUE',
                'video_10_title'      => 'IRC Race Series 2025 – 10KM',
                'video_10_tag'        => 'RACE SERIES',
                'videos_channel_url'  => 'https://www.youtube.com/@ODSportspk',
                'videos_channel_btn'  => 'View Full YouTube Channel',
                // Latest Blogs Section headings
                'blogs_label'         => 'OD SPORTS',
                'blogs_section_title' => 'LATEST BLOGS',
                'blogs_subtitle'      => 'Insights, stories, and updates from Pakistan\'s sports scene.',
                'blogs_btn'           => 'VIEW ALL BLOGS',
                // Contact Form inner labels
                'contact_form_label'   => 'Free Consultation',
                'contact_form_heading' => 'Book Your Strategy Call',
                'contact_form_trust'   => 'No spam. Free consultation. No commitment.',
            ];
            $fields = array_merge($fields, $homepageFields);
        }

        // Services Index fields
        if ($pageId === 'services_index') {
            $servicesIndexFields = [
                'hero_title' => 'Full-Service Sports Solutions — From Ideation to Execution',
                'hero_subtitle' => 'Every service we offer is built for the sports world. We understand the game, the culture, and what it takes to deliver results on the ground and online.',
                'hero_img' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=2000&q=80',
                'nav_label_1' => 'Event Management',
                'nav_label_2' => 'Media Production',
                'nav_label_3' => 'Sports Marketing',
                'nav_label_4' => 'Campaign Design',
                'nav_label_5' => 'Custom Printing',
                'nav_label_6' => 'Influencer Marketing',
                'section_title' => 'END-TO-END SOLUTIONS',
                'section_subtitle' => 'From event management to influencer marketing — we deliver complete sports solutions across Pakistan.',
                'service1_icon' => '🏃',
                'service2_icon' => '🎬',
                'service3_icon' => '📢',
                'service4_icon' => '🎨',
                'service6_icon' => '⭐',
                'service1_img' => 'https://images.unsplash.com/photo-1551958219-acbc608c6377',
                'service1_title' => 'Sports Event Management',
                'service1_desc' => 'End-to-end planning and execution for marathons, tournaments, and community sports events.',
                'service2_img' => 'https://images.unsplash.com/photo-1533560904424-a0c61dc306fc',
                'service2_title' => 'Sports Media Production',
                'service2_desc' => 'Cinematic videography, professional photography, and live streaming.',
                'service3_img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978',
                'service3_title' => 'Sports Marketing & Strategy',
                'service3_desc' => 'Data-driven digital marketing and community-first strategies.',
                'service4_img' => 'https://images.unsplash.com/photo-1542744173-8e7e53415bb0',
                'service4_title' => 'Digital Campaign Design',
                'service4_desc' => 'Bold visual identities, event branding, and social media kits.',
                'service5_img' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab',
                'service5_title' => 'Custom Printing & Merchandise',
                'service5_desc' => 'Elite jerseys, technical gear, and event merchandise.',
                'service6_img' => 'https://images.unsplash.com/photo-1517841905240-472988babdf9',
                'service6_title' => 'Influencer & Athlete Marketing',
                'service6_desc' => 'Connecting brands with Pakistan\'s most influential athletes.',
            ];
            $fields = array_merge($fields, $servicesIndexFields);
        }

        // Event Management fields — keys match event-management.blade.php
        if ($pageId === 'services_event_management') {
            $f = [
                'hero_bg' => 'https://images.unsplash.com/photo-1530549387789-4c1017266635?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'SERVICE 01 — SPORTS EVENT MANAGEMENT',
                'hero_title_1' => 'End-to-End Sports',
                'hero_title_2' => 'Event Management',
                'statement' => 'At OD Sports, we handle every aspect of sports event management — from strategy and logistics to on-ground execution and post-event analysis. Our goal is simple: every event runs flawlessly, every participant has a great experience, and every organiser can focus on what matters most.',
                'impact_desc' => 'OD Sports has been the official event and digital partner for the Islamabad Marathon since 2022 helping grow it from 500 participants to 6,000+ and establishing it as Pakistan\'s largest marathon. We also led the multi-city execution of YourPace by inDrive across Islamabad and Karachi.',
                'cta_title_1' => 'READY TO',
                'cta_title_2' => 'WORK WITH US?',
                'cta_btn' => 'Book a Strategy Call',
                'cap_section_title_1' => 'WHAT WE',
                'cap_section_title_2' => 'HANDLE',
                'impact_title_1'      => 'PROVEN',
                'impact_title_2'      => 'RESULTS',
                'lc_section_title_1'  => 'WHO IS THIS',
                'lc_section_title_2'  => 'FOR?',
            ];
            for ($i = 1; $i <= 8; $i++) { $f['cap_'.$i.'_title'] = ''; $f['cap_'.$i.'_desc'] = ''; }
            for ($i = 1; $i <= 8; $i++) { $f['lifecycle_'.$i] = ''; }
            $fields = array_merge($fields, $f);
        }

        // Media Production fields — keys match media-production.blade.php
        if ($pageId === 'services_media_production') {
            $f = [
                'hero_bg' => 'https://images.unsplash.com/photo-1533560904424-a0c61dc306fc?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'SERVICE 02 — SPORTS MEDIA PRODUCTION',
                'hero_title_1' => 'Sports Media',
                'hero_title_2' => 'Production',
                'statement' => 'Every moment is turned into content that performs. At OD Sports, we specialize in cinematic storytelling that brings your sports event to life and keeps audiences coming back.',
                'impact_desc' => 'Our live coverage generated 381,000+ live stream views and 18.6 million total video views for the Islamabad Marathon.',
                'cta_title_1' => 'READY FOR',
                'cta_title_2' => 'YOUR CLOSE-UP?',
                'cta_btn' => 'Contact Production Team',
                'cap_section_title_1' => 'WHAT WE',
                'cap_section_title_2' => 'PRODUCE',
                'impact_title_1'      => 'PROVEN',
                'impact_title_2'      => 'RESULTS',
                'lc_section_title_1'  => 'WHO IS THIS',
                'lc_section_title_2'  => 'FOR?',
            ];
            for ($i = 1; $i <= 7; $i++) { $f['cap_'.$i.'_title'] = ''; $f['cap_'.$i.'_desc'] = ''; }
            for ($i = 1; $i <= 5; $i++) { $f['lifecycle_'.$i] = ''; }
            $fields = array_merge($fields, $f);
        }

        // Sports Marketing fields — keys match sports-marketing.blade.php
        if ($pageId === 'services_sports_marketing') {
            $f = [
                'hero_bg' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'SERVICE 03 — SPORTS MARKETING',
                'hero_title_1' => 'Sports Marketing',
                'hero_title_2' => '& Strategy',
                'statement' => 'At OD Sports, we manage complete sports marketing that turns attention into participation, loyalty, and growth.',
                'impact_desc' => 'Our campaigns for the Islamabad Marathon drove a 1,100% participation increase and reached 8.66M people.',
                'cta_title_1' => 'BUILD YOUR',
                'cta_title_2' => 'LEGACY NOW',
                'cta_btn' => 'Talk to a Strategist',
                'cap_section_title_1' => 'WHAT WE',
                'cap_section_title_2' => 'OFFER',
                'impact_title_1'      => 'PROVEN',
                'impact_title_2'      => 'RESULTS',
                'lc_section_title_1'  => 'WHO IS THIS',
                'lc_section_title_2'  => 'FOR?',
            ];
            for ($i = 1; $i <= 7; $i++) { $f['cap_'.$i.'_title'] = ''; $f['cap_'.$i.'_desc'] = ''; }
            for ($i = 1; $i <= 5; $i++) { $f['lifecycle_'.$i] = ''; }
            $fields = array_merge($fields, $f);
        }

        // Custom Printing fields — keys match custom-printing.blade.php
        if ($pageId === 'services_custom_printing') {
            $f = [
                'hero_bg' => 'https://images.unsplash.com/photo-1552674605-46d536a1f509?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'SERVICE 05 — CUSTOM PRINTING',
                'hero_title_1' => 'Custom Printing',
                'hero_title_2' => '& Merchandise',
                'statement' => 'We handle high-quality custom printing and merchandise — designed to look professional and represent your brand with pride.',
                'cta_title_1' => 'READY TO',
                'cta_title_2' => 'GEAR UP?',
                'cta_btn' => 'Request a Quote',
                'cap_section_title_1' => 'WHAT WE',
                'cap_section_title_2' => 'PRODUCE',
                'lc_section_title_1'  => 'WHO IS THIS',
                'lc_section_title_2'  => 'FOR?',
            ];
            for ($i = 1; $i <= 4; $i++) { $f['cap_'.$i.'_title'] = ''; $f['cap_'.$i.'_desc'] = ''; }
            for ($i = 1; $i <= 5; $i++) { $f['lifecycle_'.$i] = ''; }
            $fields = array_merge($fields, $f);
        }

        // Campaign Design fields — keys match campaign-design.blade.php
        if ($pageId === 'services_campaign_design') {
            $f = [
                'hero_bg' => 'https://images.unsplash.com/photo-1552674605-46d536a1f509?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'SERVICE 04 — CAMPAIGN DESIGN',
                'hero_title_1' => 'Digital Campaign',
                'hero_title_2' => 'Design',
                'statement' => 'We create digital content specifically designed for sports — built to stop the scroll and drive real participation.',
                'impact_desc' => 'We helped create a cohesive brand rollout that increased social engagement by 300%.',
                'cta_title_1' => 'READY TO',
                'cta_title_2' => 'MAKE AN IMPACT?',
                'cta_btn' => 'Start Your Campaign',
                'cap_section_title_1'  => 'CAMPAIGN DESIGN —',
                'cap_section_title_2'  => 'WHAT WE CREATE',
                'strat_section_title_1' => 'CREATIVE STRATEGY —',
                'strat_section_title_2' => 'WHAT A FULL CAMPAIGN INCLUDES',
                'impact_title_1'       => 'PROVEN',
                'impact_title_2'       => 'RESULTS',
                'lc_section_title_1'   => 'WHO IS THIS',
                'lc_section_title_2'   => 'FOR?',
            ];
            for ($i = 1; $i <= 7; $i++) { $f['cap_'.$i.'_title'] = ''; $f['cap_'.$i.'_desc'] = ''; }
            for ($i = 1; $i <= 5; $i++) { $f['strat_'.$i.'_title'] = ''; $f['strat_'.$i.'_desc'] = ''; }
            for ($i = 1; $i <= 4; $i++) { $f['lifecycle_'.$i] = ''; }
            $fields = array_merge($fields, $f);
        }

        // Custom Printing fields — keys match custom-printing.blade.php
        if ($pageId === 'services_custom_printing') {
            $f = [
                'hero_bg'       => 'https://images.unsplash.com/photo-1556906781-9a412961c28c?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'SERVICE 05 — CUSTOM PRINTING & SPORTS MERCHANDISE',
                'hero_title_1'  => 'Look the Part.',
                'hero_title_2'  => 'Play the Part.',
                'statement'     => 'OD Sports handles high-quality custom printing and merchandise for sports teams, events, and clubs across Pakistan. From jerseys and training kits to banners, flags, and fan gear — every item is designed and produced to look professional and represent your brand with pride.',
                'cta_title_1'   => 'READY TO',
                'cta_title_2'   => 'GEAR UP?',
                'cta_btn'             => 'Request a Custom Order',
                'cap_section_title_1' => 'WHAT WE',
                'cap_section_title_2' => 'PRODUCE',
                'lc_section_title_1'  => 'WHO IS THIS',
                'lc_section_title_2'  => 'FOR?',
            ];
            for ($i = 1; $i <= 4; $i++) { $f['cap_'.$i.'_title'] = ''; $f['cap_'.$i.'_desc'] = ''; }
            for ($i = 1; $i <= 5; $i++) { $f['lifecycle_'.$i] = ''; }
            $fields = array_merge($fields, $f);
        }

        // Influencer Marketing fields — keys match influencer-marketing.blade.php
        if ($pageId === 'services_influencer_marketing') {
            $f = [
                'hero_bg' => 'https://images.unsplash.com/photo-1547483161-5918641d402b?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'SERVICE 06 — INFLUENCER MARKETING',
                'hero_title_1' => 'Influencer &',
                'hero_title_2' => 'Athlete Marketing',
                'statement' => 'We connect your event with the right fitness influencers — finding people who genuinely care about sport and authenticity.',
                'impact_desc' => 'For the Islamabad Marathon, we managed a 3.5-month influencer campaign across 12+ fitness influencers.',
                'cta_title_1' => 'CONNECT WITH',
                'cta_title_2' => 'INFLUENCERS',
                'cta_btn' => 'Start Your Outreach',
                'cap_section_title_1' => 'WHAT WE',
                'cap_section_title_2' => 'MANAGE',
                'impact_title_1'      => 'PROVEN',
                'impact_title_2'      => 'RESULTS',
                'lc_section_title_1'  => 'WHO IS THIS',
                'lc_section_title_2'  => 'FOR?',
            ];
            for ($i = 1; $i <= 6; $i++) { $f['cap_'.$i.'_title'] = ''; $f['cap_'.$i.'_desc'] = ''; }
            for ($i = 1; $i <= 4; $i++) { $f['lifecycle_'.$i] = ''; }
            $fields = array_merge($fields, $f);
        }

        // Portfolio fields
        if ($pageId === 'portfolio') {
            $portfolioFields = [
                'page_title' => 'Our Portfolio - OD Sports',
                'badge' => 'OUR WORK SPEAKS FOR ITSELF',
                'title' => 'Our Work Speaks for Itself',
                'subtitle' => 'From Pakistan\'s largest marathon to kids running in the hills of Islamabad — every project we take on gets the same commitment. Here\'s what we\'ve built.',
            ];
            // 7 projects
            $badgeDefaults = [1 => 'IRU', 2 => 'MTR', 3 => 'YOURPACE', 4 => 'TCR', 5 => 'IRC', 6 => 'TABARAK', 7 => '14×8000'];
            for ($i = 1; $i <= 7; $i++) {
                $portfolioFields[$i . '_img'] = '';
                $portfolioFields[$i . '_title'] = '';
                $portfolioFields[$i . '_category'] = '';
                $portfolioFields[$i . '_badge'] = $badgeDefaults[$i];
            }
            // 7 galleries
            for ($i = 1; $i <= 7; $i++) {
                $portfolioFields['gallery' . $i . '_title_1'] = '';
                $portfolioFields['gallery' . $i . '_title_2'] = '';
                $portfolioFields['gallery' . $i . '_desc'] = '';
                $portfolioFields['gallery' . $i . '_img1'] = '';
                $portfolioFields['gallery' . $i . '_img2'] = '';
                if ($i <= 3) $portfolioFields['gallery' . $i . '_img3'] = '';
            }
            // Gallery stats (galleries 1,2,4 have stats)
            foreach ([1,2,4] as $g) {
                $max = $g == 1 ? 4 : 3;
                for ($s = 1; $s <= $max; $s++) {
                    $portfolioFields['gallery' . $g . '_stat' . $s . '_num'] = '';
                }
            }
            $fields = array_merge($fields, $portfolioFields);
        }

        // About Us fields — keys match about/index.blade.php theme_option calls
        if ($pageId === 'about') {
            $aboutFields = [
                'page_title' => 'About Us - OD Sports',
                'hero_bg' => 'https://images.unsplash.com/photo-1526676037777-05a232554f77?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'OUR STORY',
                'hero_title_1' => 'PAKISTAN\'S LEADING',
                'hero_title_2' => 'SPORTS AGENCY',
                'hero_desc' => 'OD Sports was built with one purpose: to be the sports agency that Pakistan\'s events, clubs, brands, and athletes can truly rely on.',
                'story_title' => 'From Marathons to Movements',
                'story_p1' => 'OD Sports started as a response to a clear gap in Pakistan\'s sports ecosystem. Events were happening, communities were growing, athletes were achieving — but the storytelling, the strategy, and the execution weren\'t keeping up.',
                'story_p2' => 'We set out to change that.',
                'story_p3' => 'As part of Optimize Digital, we launched OD Sports to bring full agency expertise — digital strategy, creative production, media, and on-ground execution — to Pakistan\'s growing sports world.',
                'story_p4' => 'From the Islamabad Marathon and Margalla Trail Runners to YourPace by inDrive, the Lahore Marathon, the Twin City Run, and Shehroze Kashif\'s historic 14×8000er project — we have delivered for every type of sports initiative, at every scale.',
                'story_p5' => 'Today, OD Sports is Pakistan\'s leading sports agency — and we\'re just getting started.',
                'story_img' => 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=1200',
                'story_img_alt' => 'Marathon Growth',
                'growth_stat' => '1,100%',
                'growth_label' => 'Growth in Participation',
                'different_title' => 'Built for Sports. Not Just Available for It.',
                'different_p1' => 'We have real experience managing Pakistan\'s largest annual running events',
                'different_p2' => 'We understand sports audiences they are communities, not just consumers',
                'different_p3' => 'We handle both the digital side and the on-ground execution, so nothing falls through the cracks',
                'different_p4' => 'We operate nationwide Islamabad, Rawalpindi, Karachi, Lahore, and beyond',
                'different_p5' => 'We are part of Optimize Digital, giving us full agency resources for every sports project',
                'team_title' => 'Meet the People Behind OD Sports',
                'team_subtitle' => 'A diverse team of creatives, strategists, and sports enthusiasts united by a love of sport and a commitment to making every project exceptional.',
            ];
            // Team members (dynamic, up to 15)
            $teamDefaults = [
                1 => ['Imran Ghazali', 'Founder & CEO', 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e'],
                2 => ['Aqib Mughal', 'Director, Client Relations & Ops', 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7'],
                3 => ['Laiba Shakeel', 'Senior Manager, Digital', 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2'],
                4 => ['Ansab Naeem', 'Director, Photography & Videography', 'https://images.unsplash.com/photo-1560250097-0b93528c311a'],
                5 => ['Muneeb Ahmad', 'Senior Graphic Designer', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d'],
                6 => ['Angelina Yousaf', 'Content Writer & Social Media', 'https://images.unsplash.com/photo-1567532939604-b6c5b0ad2e01'],
                7 => ['Irtaza Hussain', 'Manager, PR & Social Media', 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e'],
                8 => ['Ambreen Riaz', 'Influencer Engagement & PR', 'https://images.unsplash.com/photo-1580489944761-15a19d654956'],
            ];
            for ($i = 1; $i <= 15; $i++) {
                $aboutFields['team_' . $i . '_name'] = $teamDefaults[$i][0] ?? '';
                $aboutFields['team_' . $i . '_role'] = $teamDefaults[$i][1] ?? '';
                $aboutFields['team_' . $i . '_img'] = $teamDefaults[$i][2] ?? '';
            }
            $aboutFields['cta_bg'] = 'https://images.unsplash.com/photo-1549421263-5ec9631fcce8?auto=format&fit=crop&q=80&w=2000';
            $aboutFields['cta_title_1'] = 'BASED IN ISLAMABAD';
            $aboutFields['cta_title_2'] = 'WORKING NATIONWIDE';
            $aboutFields['office1_title'] = 'HEAD OFFICE';
            $aboutFields['office1_address'] = '3rd Floor, Manzoor Plaza, G-6/2 Blue Area, Islamabad';
            $aboutFields['office2_title'] = 'BRANCH OFFICE';
            $aboutFields['office2_address'] = 'LG3, Hamza Tower, Street 73, F11/1, Islamabad';
            $aboutFields['cta_btn']      = 'Call Us: +92 320 1223359';
            $aboutFields['cta_btn_link'] = 'tel:+923201223359';
            $fields = array_merge($fields, $aboutFields);
        }

        // Custom Orders fields
        if ($pageId === 'custom_orders') {
            $customOrdersFields = [
                'orders_page_title' => 'Custom Orders & Merchandise - OD Sports',
                'hero_bg' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'PAGE 4 — CUSTOM ORDERS',
                'hero_title_1' => 'Custom Merchandise',
                'hero_title_2' => 'for Your Team or Event',
                'hero_desc' => 'Need jerseys, event t-shirts, banners, or branded fan gear? Tell us what you need — we handle design, printing, and delivery anywhere in Pakistan.',
                // What We Make section
                'whatwemake_title' => 'WHAT WE MAKE',
                'card1_title' => 'Apparel',
                'card1_item1' => 'Team jerseys and training kits',
                'card1_item2' => 'Event t-shirts and race-day gear',
                'card1_item3' => 'Hoodies, tracksuits, and casual wear',
                'card1_item4' => 'Compression gear and running apparel',
                'card2_title' => 'Event Branding',
                'card2_item1' => 'Pull-up banners and perimeter boards',
                'card2_item2' => 'Start/finish arches and race structures',
                'card2_item3' => 'Flags and fan-zone materials',
                'card2_item4' => 'Sponsor backdrops and photo walls',
                'card3_title' => 'Fan Merchandise',
                'card3_item1' => 'Caps, beanies, and headwear',
                'card3_item2' => 'Tote bags and drawstring backpacks',
                'card3_item3' => 'Water bottles and drinkware',
                'card3_item4' => 'Lanyards and accessories',
                'card4_title' => 'Custom Orders',
                'card4_item1' => 'Sponsor co-branding on any merchandise',
                'card4_item2' => 'Club and academy uniform packs',
                'card4_item3' => 'Full event merchandise packages',
                'card4_item4' => 'Packaging design for product launches',
                // How It Works
                'lifecycle_title_1' => 'HOW IT',
                'lifecycle_title_2' => 'WORKS',
                'phase1_num' => '01',
                'phase1_title' => 'Tell Us What You Need',
                'phase1_desc' => 'Fill out the form below with your requirements, event name, quantity, design preferences, and deadline.',
                'phase2_num' => '02',
                'phase2_title' => 'We Design It',
                'phase2_desc' => 'Our design team creates mockups tailored to your team identity, colours, and event branding.',
                'phase3_num' => '03',
                'phase3_title' => 'You Approve It',
                'phase3_desc' => 'Review and approve the designs. We handle all revisions until you\'re happy.',
                'phase4_num' => '04',
                'phase4_title' => 'We Print & Deliver',
                'phase4_desc' => 'We manage production and delivery to your location across Pakistan.',
                // Order Form
                'form_title_1' => 'Ready to',
                'form_title_2' => 'Gear Up?',
                'form_desc' => 'Whether you need 50 jerseys or a full event merchandise package — we\'ll handle everything from first sketch to final delivery.',
                'form_benefit1' => 'Low Minimum Order Quantities',
                'form_benefit2' => 'Nationwide Shipping in Pakistan',
                'form_benefit3' => 'Premium Technical Fabrics',
                'form_mini_label' => 'Custom Printing',
                'form_sub_heading' => 'Tell Us What You Need',
                'form_name' => 'e.g. Ahmed Khan',
                'form_org' => 'e.g. FC Lahore',
                'form_email' => 'you@example.com',
                'form_phone' => '+92 300 0000000',
                'form_select1' => 'Team Jerseys',
                'form_select2' => 'Event Banners',
                'form_select3' => 'Fan Gear',
                'form_select4' => 'Full Event Branding',
                'form_qty' => 'e.g. 50',
                'form_message' => 'Tell us about colours, logos, deadlines...',
                'form_upload' => 'Upload Logos / References',
                'form_btn' => 'Request a Custom Order',
                'form_trust_text' => 'Free quote. No commitment required.',
            ];
            $fields = array_merge($fields, $customOrdersFields);
        }

        // Blog page fields
        if ($pageId === 'blog') {
            $blogFields = [
                'page_title' => 'Blog - OD Sports',
                'hero_bg' => 'https://images.unsplash.com/photo-1504016798967-59a258e9386d?auto=format&fit=crop&w=2000&q=80',
                'hero_subtitle' => 'OD SPORTS BLOG',
                'hero_title' => 'News, Insights & Stories <br>from Pakistan\'s Sports Scene',
                'posts_mini_label' => 'OD SPORTS',
                'posts_title_1' => 'LATEST',
                'posts_title_2' => 'BLOGS',
                // Portfolio Stories Section
                'portfolio_section_subtitle' => 'From Our Portfolio',
                'portfolio_section_title_1' => 'Stories Behind the',
                'portfolio_section_title_2' => 'Projects',
                // Portfolio Card 1
                'portfolio_1_img' => 'https://images.unsplash.com/photo-1452626038306-9aae5e071dd3?auto=format&fit=crop&q=80&w=600',
                'portfolio_1_category' => 'Event Management | Digital Marketing | Sports Media Production',
                'portfolio_1_title' => 'ISLAMABAD MARATHON & IRU (2022–2025)',
                'portfolio_gallery1_desc' => 'OD Sports has been the long-term digital and event partner for Islamabad Run With Us (IRU) since 2022 — supporting the Islamabad Marathon and Margalla Half Marathon through four consecutive editions. From social media management and digital campaigns to race-day coverage, live streaming, and press engagement, we have been involved in every layer of the event\'s growth. Our consistent digital strategies, high-quality visual storytelling, and community-first approach helped transform the Islamabad Marathon from a local run into Pakistan\'s most recognised annual marathon — a nationwide movement that inspires participation and promotes running culture across the country.',
                // Portfolio Card 2
                'portfolio_2_img' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&q=80&w=600',
                'portfolio_2_category' => 'Sports Media Production | Digital Marketing | Event Coverage',
                'portfolio_2_title' => 'MARGALLA TRAIL RUNNERS (MTR) — 2024–PRESENT',
                'portfolio_gallery2_desc' => 'Since 2024, OD Sports has served as the official media and digital partner for Margalla Trail Runners — covering the Galyat Mountain Trail, Backyard Ultra, Hill Half Marathon, and Trail Running Festival. We craft immersive digital narratives that capture the grit, endurance, and spirit of trail athletes competing in Pakistan\'s most demanding terrains. Each campaign combines strategic social media management, creative content production, live amplification, and cinematic race-day coverage — turning every race into a story that resonates with the wider running community and inspires new participants to step onto the trails.',
                // Portfolio Card 3
                'portfolio_3_img' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&q=80&w=600',
                'portfolio_3_category' => 'Event Management | Media Production | Documentary Production',
                'portfolio_3_title' => 'YOURPACE BY INDRIVE',
                'portfolio_gallery3_desc' => 'OD Sports partnered with YourPace, an inDrive initiative, to make running accessible for children from underprivileged backgrounds. The project ran across two chapters, covering 6–7 schools over 3 weeks in Islamabad and Karachi, featuring structured training sessions, school races, and community activities. We managed end-to-end coverage including event documentation, race-day branding, social media content, and the production of the full programme documentary — highlighting participation, inclusivity, and the initiative\'s lasting impact on young runners across Pakistan.',
                // Portfolio Card 4
                'portfolio_4_img' => 'https://images.unsplash.com/photo-1571008887538-b36bb32f4571?auto=format&fit=crop&q=80&w=600',
                'portfolio_4_category' => 'Digital Marketing | Sports Media Production | Event Coverage',
                'portfolio_4_title' => 'TWIN CITY RUN & NIGHT RUN',
                'portfolio_gallery4_desc' => 'OD Sports delivered full digital and media campaigns for two of Islamabad\'s most popular urban races. For the Night Run, we provided live video coverage, real-time reels and stories, and on-ground documentation to amplify the event as it happened. For the Twin City Run, we executed a complete digital campaign — designing graphics, memes, and reels, alongside on-ground coverage and live social updates — ensuring maximum visibility and fan engagement throughout.',
                // Portfolio Card 5
                'portfolio_5_img' => 'https://images.unsplash.com/photo-1552674605-db6ffd4facb5?auto=format&fit=crop&q=80&w=600',
                'portfolio_5_category' => 'Sports Photography | Videography | Content Production',
                'portfolio_5_title' => 'IRC RUNNING SERIES',
                'portfolio_gallery5_desc' => 'OD Sports supported the IRC Running Series across three race editions, delivering end-to-end event coverage including professional photography, drone videography, and participant testimonial production. Our visual storytelling captured the energy, community spirit, and key milestones of each race — strengthening the series\' visibility and documenting its growth for both participants and sponsors.',
                // Portfolio Card 6
                'portfolio_6_img' => 'https://images.unsplash.com/photo-1476480862126-209bfaa8edc8?auto=format&fit=crop&q=80&w=600',
                'portfolio_6_category' => 'Social Media | Content Production | Live Coverage',
                'portfolio_6_title' => 'TABARAK RUNS — CROSS-PAKISTAN 1,600KM RUN',
                'portfolio_gallery6_desc' => 'OD Sports documented the historic start of Tabarak Rehman\'s cross-Pakistan run — the first man in Pakistan to run 1,600 km from Cadet College Hasan Abdal to IBA Karachi in 35 days, raising $1 million USD for The Citizens Foundation. We captured the launch event, key visuals, and on-ground moments while producing real-time social media content to amplify his mission — highlighting the scale, purpose, and national significance of this landmark initiative for education.',
                // Portfolio Card 7
                'portfolio_7_img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&q=80&w=600',
                'portfolio_7_category' => 'Social Media Strategy | Content Creation | PR & Platform Management',
                'portfolio_7_title' => 'SHEHROZE KASHIF — PROJECT 14×8000ER',
                'portfolio_gallery7_desc' => 'OD Sports managed the complete social media strategy and content creation for Shehroze Kashif\'s Project 14×8000er — his historic endeavour to summit all 14 peaks above 8,000 metres. Over 9 months, we curated and produced video content, managed his GoFundMe campaign, and handled full PR and platform management — helping Shehroze connect with a global audience of supporters and amplify his mission throughout one of mountaineering\'s greatest challenges.',
                // Featured Gears Section
                'gears_title_1' => 'FEATURED',
                'gears_title_2' => 'GEARS',
                'gears_subtitle' => 'Professional grade equipment and apparel for serious athletes.',
                'gears_badge_new' => 'NEW',
                'gears_badge_sale' => 'SALE',
                'gears_add_to_cart' => 'ADD TO CART',
                'gears_empty_message' => 'No featured products available yet. Check back soon!',
            ];
            $fields = array_merge($fields, $blogFields);
        }

        // Global Settings fields
        if ($pageId === 'global_settings') {
            $globalFields = [
                'site_title' => 'OD SPORTS - Premium Sports Solutions',
                'site_logo' => 'favicon.jpeg',
                'nav_home' => 'HOME',
                'nav_services' => 'SERVICES',
                'nav_portfolio' => 'PORTFOLIO',
                'nav_about' => 'ABOUT',
                'nav_orders' => 'CUSTOM ORDERS',
                'nav_blog' => 'BLOGS',
                'nav_contact' => 'CONTACT',
                'nav_search_placeholder' => 'Search...',
                'footer_slogan' => 'Sport. Strategy. Story.',
                'company_address' => 'Blue Area, Islamabad',
                'company_phone' => '+92 320 1223359',
                'company_email' => 'hello@odsports.com',
                'social_facebook' => '#',
                'social_instagram' => '#',
                'social_youtube' => '#',
                'social_tiktok' => '#',
                'social_linkedin' => '#',
                'footer_copyright' => '© 2025 OD Sports — Part of Optimize Digital. All rights reserved.',
                'navbar_cta_text' => 'Schedule a Call',
                'navbar_cta_link' => '#contact',
            ];
            $fields = array_merge($fields, $globalFields);
        }

        // Get values from theme options using Botble's key format
        $theme = setting('theme');
        if (! $theme) {
            $theme = 'shopwise';
        }
        $optName = 'theme';

        foreach ($fields as $key => $default) {
            $optionKey = $optName . '-' . $theme . '-' . $prefix . $key;
            $pageData[$key] = setting($optionKey, $default);
        }

        // For blog page, portfolio-related fields read from portfolio_ prefix (shared with portfolio page)
        if ($pageId === 'blog') {
            foreach ($fields as $key => $default) {
                if (str_starts_with($key, 'portfolio_')) {
                    $optionKey = $optName . '-' . $theme . '-' . $key;
                    $pageData[$key] = setting($optionKey, $default);
                }
            }
        }

        // Load featured products for homepage and blog admin
        $featuredProducts = collect();
        if ($pageId === 'homepage' || $pageId === 'blog') {
            try {
                $featuredProducts = app(\Botble\Ecommerce\Repositories\Interfaces\ProductInterface::class)->advancedGet([
                    'condition' => ['status' => 'published', 'is_featured' => 1],
                    'take' => 8,
                    'order_by' => ['created_at' => 'desc'],
                    'with' => ['categories'],
                ]);
            } catch (\Exception $e) {
                $featuredProducts = collect();
            }
        }

        // Load existing blog posts for the blog post management section
        $blogPosts = collect();
        if ($pageId === 'blog') {
            try {
                $blogPosts = \Botble\Blog\Models\Post::orderBy('created_at', 'desc')->get();
            } catch (\Exception $e) {
                $blogPosts = collect();
            }
        }

        return view('admin.website-content.edit', [
            'pageId'          => $pageId,
            'pageTitle'       => $this->pages[$pageId],
            'pageData'        => $pageData,
            'featuredProducts'=> $featuredProducts,
            'blogPosts'       => $blogPosts,
        ]);
    }

    public function update(Request $request, string $pageId): RedirectResponse
    {
        $data = $request->except(['_token', '_method']);

        // Define prefix mapping per page
        $prefixMap = [
            'homepage' => 'homepage',
            'services_index' => 'services_index',
            'services_event_management' => 'event',
            'services_media_production' => 'media',
            'services_sports_marketing' => 'sportsmarketing',
            'services_campaign_design' => 'campaign',
            'services_influencer_marketing' => 'influencer',
            'services_custom_printing' => 'printing',
            'portfolio' => 'portfolio',
            'about' => 'about',
            'custom_orders' => 'orders',
            'blog' => 'blog',
            'global_settings' => 'global',
        ];

        $prefix = $prefixMap[$pageId] ?? 'homepage';

        // Build the setting key prefix to match how edit() reads: setting('theme-{theme}-{prefix}_{key}')
        $theme = setting('theme') ?: 'shopwise';
        $settingPrefix = 'theme-' . $theme . '-' . $prefix . '_';

        foreach ($data as $key => $value) {
            // Skip _file meta-keys
            if (str_ends_with($key, '_file')) {
                continue;
            }

            // Handle _delete flag — explicitly clear the setting to ''
            if (str_ends_with($key, '_delete')) {
                if ($value === '1') {
                    $actualKey   = substr($key, 0, -7); // strip '_delete'
                    $delSettingKey = $settingPrefix . $actualKey;
                    if ($pageId === 'blog' && str_starts_with($actualKey, 'portfolio_')) {
                        $delSettingKey = 'theme-' . $theme . '-' . $actualKey;
                    }
                    setting()->set($delSettingKey, '');
                }
                continue;
            }

            // Skip gear product fields (handled separately)
            if (str_starts_with($key, 'gear_product_id_') || str_starts_with($key, 'gear_') && str_ends_with($key, '_img')) {
                continue;
            }

            // Skip blog product fields (handled separately below)
            if (str_starts_with($key, 'product_id_') || str_starts_with($key, 'product_name_') || str_starts_with($key, 'product_price_') || str_starts_with($key, 'product_img_')) {
                continue;
            }

            // Build the setting key
            $settingKey = $settingPrefix . $key;
            if ($pageId === 'blog' && str_starts_with($key, 'portfolio_')) {
                $settingKey = 'theme-' . $theme . '-' . $key;
            }

            $fileKey = $key . '_file';

            // If a new file was uploaded for this field, store it and use the new path
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $destDir = public_path('storage/website-content');
                if (!is_dir($destDir)) {
                    mkdir($destDir, 0755, true);
                }
                $file->move($destDir, $filename);
                setting()->set($settingKey, 'website-content/' . $filename);
                continue;
            }

            // (Delete functionality removed — view + replace only)

            // Normal text field
            if ($value !== null) {
                setting()->set($settingKey, $value);
            }
        }

        setting()->save();

        // Handle gear/product image uploads for homepage
        if ($pageId === 'homepage') {
            for ($i = 0; $i < 8; $i++) {
                $productId = $request->input('gear_product_id_' . $i);
                if (!$productId) continue;

                $fileKey = 'gear_' . $i . '_img_file';
                if ($request->hasFile($fileKey)) {
                    $product = \Botble\Ecommerce\Models\Product::find($productId);
                    if (!$product) continue;

                    $file = $request->file($fileKey);
                    $filename = time() . '_gear_' . $i . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                    $destDir = public_path('storage/products');
                    if (!is_dir($destDir)) {
                        mkdir($destDir, 0755, true);
                    }
                    $file->move($destDir, $filename);
                    $newPath = 'products/' . $filename;

                    // Update product images array - replace first image
                    $images = $product->images;
                    if (!is_array($images)) $images = [];
                    if (count($images) > 0) {
                        $images[0] = $newPath;
                    } else {
                        $images[] = $newPath;
                    }
                    $product->forceFill([
                        'image'  => $newPath,
                        'images' => json_encode(array_values($images)),
                    ])->save();
                }
            }
        }

        // Handle featured product updates for blog page
        if ($pageId === 'blog') {
            for ($i = 0; $i < 10; $i++) {
                $productId = $request->input('product_id_' . $i);
                if (!$productId) continue;

                $product = \Botble\Ecommerce\Models\Product::find($productId);
                if (!$product) continue;

                $updates = [];
                $name  = $request->input('product_name_' . $i);
                $price = $request->input('product_price_' . $i);
                if ($name  !== null && $name  !== '') $updates['name']       = $name;
                if ($price !== null && $price !== '') $updates['sale_price'] = (float)$price;

                // Handle product image upload
                $imgFileKey = 'product_img_' . $i . '_file';
                if ($request->hasFile($imgFileKey)) {
                    $file     = $request->file($imgFileKey);
                    $filename = time() . '_product_' . $i . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                    $destDir  = public_path('storage/products');
                    if (!is_dir($destDir)) mkdir($destDir, 0755, true);
                    $file->move($destDir, $filename);
                    $newPath = 'products/' . $filename;
                    $images  = $product->images;
                    if (!is_array($images)) $images = [];
                    if (count($images) > 0) { $images[0] = $newPath; } else { $images[] = $newPath; }
                    $updates['image']  = $newPath;
                    $updates['images'] = json_encode(array_values($images));
                }

                if (!empty($updates)) {
                    $product->forceFill($updates)->save();
                }
            }
        }

        return redirect()->back()->with('success', 'Content updated successfully!');
    }

    public function deleteBlogPost($postId): \Illuminate\Http\JsonResponse
    {
        try {
            $post = \Botble\Blog\Models\Post::findOrFail($postId);
            $post->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function storeBlogPost(Request $request): \Illuminate\Http\JsonResponse
    {
        try {
            $post = new \Botble\Blog\Models\Post();
            $post->name        = $request->input('post_title', '');
            $post->description = $request->input('post_description', '');
            $post->content     = $request->input('post_content', '');
            $post->format_type = 'normal';
            $post->status      = $request->input('post_status', 'published');
            $post->author_id   = auth()->id();
            $post->author_type = get_class(auth()->user());

            if ($request->filled('post_publish_date')) {
                $post->created_at = \Carbon\Carbon::parse($request->input('post_publish_date'));
            }

            $post->save();

            if ($request->hasFile('post_image_file')) {
                $file     = $request->file('post_image_file');
                $filename = time() . '_blog_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $destDir  = public_path('storage/blog');
                if (!is_dir($destDir)) mkdir($destDir, 0755, true);
                $file->move($destDir, $filename);
                $post->forceFill(['image' => 'blog/' . $filename])->save();
            }

            $imgUrl = '';
            if ($post->image) {
                if (str_starts_with($post->image, 'http')) { $imgUrl = $post->image; }
                elseif (file_exists(public_path($post->image))) { $imgUrl = asset($post->image); }
                else { $imgUrl = \RvMedia::getImageUrl($post->image); }
            }

            return response()->json(['success' => true, 'post' => [
                'id'         => $post->id,
                'name'       => $post->getAttributes()['name'] ?? $post->name,
                'status'     => (string) $post->status,
                'created_at' => $post->created_at->format('M d, Y'),
                'image_url'  => $imgUrl,
            ]]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function updateBlogPost(Request $request, $postId): \Illuminate\Http\JsonResponse
    {
        try {
            $post    = \Botble\Blog\Models\Post::findOrFail($postId);
            $updates = [];

            if ($request->filled('post_title'))       $updates['name']        = $request->input('post_title');
            if ($request->input('post_description') !== null) $updates['description'] = $request->input('post_description');
            if ($request->input('post_content')     !== null) $updates['content']     = $request->input('post_content');
            if ($request->filled('post_status'))      $updates['status']      = $request->input('post_status');
            if ($request->filled('post_publish_date')) {
                $updates['created_at'] = \Carbon\Carbon::parse($request->input('post_publish_date'));
            }

            if (!empty($updates)) $post->forceFill($updates)->save();

            if ($request->hasFile('post_image_file')) {
                $file     = $request->file('post_image_file');
                $filename = time() . '_blog_' . preg_replace('/[^a-zA-Z0-9._-]/', '_', $file->getClientOriginalName());
                $destDir  = public_path('storage/blog');
                if (!is_dir($destDir)) mkdir($destDir, 0755, true);
                $file->move($destDir, $filename);
                $post->forceFill(['image' => 'blog/' . $filename])->save();
            }

            $imgUrl = '';
            if ($post->image) {
                if (str_starts_with($post->image, 'http')) { $imgUrl = $post->image; }
                elseif (file_exists(public_path($post->image))) { $imgUrl = asset($post->image); }
                else { $imgUrl = \RvMedia::getImageUrl($post->image); }
            }

            return response()->json(['success' => true, 'post' => [
                'id'         => $post->id,
                'name'       => $post->getAttributes()['name'] ?? $post->name,
                'status'     => (string) $post->status,
                'created_at' => $post->updated_at->format('M d, Y'),
                'image_url'  => $imgUrl,
            ]]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}
