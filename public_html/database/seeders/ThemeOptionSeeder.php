<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Setting\Models\Setting;
use Theme;

class ThemeOptionSeeder extends BaseSeeder
{
    public function run(): void
    {
        $this->uploadFiles('general');

        $theme = Theme::getThemeName();
        Setting::where('key', 'LIKE', 'theme-' . $theme . '-%')->delete();

        Setting::insertOrIgnore([
            [
                'key' => 'admin_logo',
                'value' => 'general/logo-light.png',
            ],
            [
                'key' => 'admin_favicon',
                'value' => 'general/favicon.png',
            ],
            [
                'key' => 'theme',
                'value' => $theme,
            ],
            [
                'key' => 'theme-' . $theme . '-site_title',
                'value' => 'Shopwise - Laravel Ecommerce system',
            ],
            [
                'key' => 'theme-' . $theme . '-seo_description',
                'value' => 'Shopwise is designed for the eCommerce site. His design is suitable for small and big projects. It was built for your Shopping store, fashion store, clothing store, digital store, watch store, men store, women store, kids store, accessories store, Shoe store and etc.',
            ],
            [
                'key' => 'theme-' . $theme . '-copyright',
                'value' => '© ' . now()->format('Y') . ' Botble Technologies. All Rights Reserved.',
            ],
            [
                'key' => 'theme-' . $theme . '-favicon',
                'value' => 'general/favicon.png',
            ],
            [
                'key' => 'theme-' . $theme . '-logo',
                'value' => 'general/logo.png',
            ],
            [
                'key' => 'theme-' . $theme . '-logo_footer',
                'value' => 'general/logo-light.png',
            ],
            [
                'key' => 'theme-' . $theme . '-address',
                'value' => '123 Street, Old Trafford, NewYork, USA',
            ],
            [
                'key' => 'theme-' . $theme . '-hotline',
                'value' => '123-456-7890',
            ],
            [
                'key' => 'theme-' . $theme . '-email',
                'value' => 'info@sitename.com',
            ],
            [
                'key' => 'theme-' . $theme . '-payment_methods',
                'value' => json_encode([
                    'general/visa.png',
                    'general/paypal.png',
                    'general/master-card.png',
                    'general/discover.png',
                    'general/american-express.png',
                ]),
            ],
            [
                'key' => 'theme-' . $theme . '-newsletter_image',
                'value' => 'general/newsletter.jpg',
            ],
            [
                'key' => 'theme-' . $theme . '-homepage_id',
                'value' => '1',
            ],
            [
                'key' => 'theme-' . $theme . '-blog_page_id',
                'value' => '3',
            ],
            [
                'key' => 'theme-' . $theme . '-cookie_consent_message',
                'value' => 'Your experience on this site will be improved by allowing cookies ',
            ],
            [
                'key' => 'theme-' . $theme . '-cookie_consent_learn_more_url',
                'value' => url('cookie-policy'),
            ],
            [
                'key' => 'theme-' . $theme . '-cookie_consent_learn_more_text',
                'value' => 'Cookie Policy',
            ],
            [
                'key' => 'theme-' . $theme . '-about-us',
                'value' => 'If you are going to use of Lorem Ipsum need to be sure there isn\'t hidden of text',
            ],
        ]);

        Setting::insertOrIgnore([
            [
                'key' => 'theme-' . $theme . '-vi-primary_font',
                'value' => 'Roboto Condensed',
            ],
            [
                'key' => 'theme-' . $theme . '-vi-copyright',
                'value' => '© 2021 Botble Technologies. Tất cả quyền đã được bảo hộ.',
            ],
            [
                'key' => 'theme-' . $theme . '-vi-cookie_consent_message',
                'value' => 'Trải nghiệm của bạn trên trang web này sẽ được cải thiện bằng cách cho phép cookie ',
            ],
            [
                'key' => 'theme-' . $theme . '-vi-cookie_consent_learn_more_url',
                'value' => url('cookie-policy'),
            ],
            [
                'key' => 'theme-' . $theme . '-vi-cookie_consent_learn_more_text',
                'value' => 'Chính sách cookie',
            ],
            [
                'key' => 'theme-' . $theme . '-vi-homepage_id',
                'value' => '1',
            ],
            [
                'key' => 'theme-' . $theme . '-vi-blog_page_id',
                'value' => '3',
            ],
        ]);

        $socialLinks = [
            [
                [
                    'key' => 'social-name',
                    'value' => 'Facebook',
                ],
                [
                    'key' => 'social-icon',
                    'value' => 'ion-social-facebook',
                ],
                [
                    'key' => 'social-url',
                    'value' => theme_option('facebook'),
                ],
                [
                    'key' => 'social-color',
                    'value' => '#3b5998',
                ],
            ],
            [
                [
                    'key' => 'social-name',
                    'value' => 'Twitter',
                ],
                [
                    'key' => 'social-icon',
                    'value' => 'ion-social-twitter',
                ],
                [
                    'key' => 'social-url',
                    'value' => theme_option('twitter'),
                ],
                [
                    'key' => 'social-color',
                    'value' => '#00acee',
                ],
            ],
            [
                [
                    'key' => 'social-name',
                    'value' => 'Youtube',
                ],
                [
                    'key' => 'social-icon',
                    'value' => 'ion-social-youtube',
                ],
                [
                    'key' => 'social-url',
                    'value' => theme_option('youtube'),
                ],
                [
                    'key' => 'social-color',
                    'value' => '#c4302b',
                ],
            ],
            [
                [
                    'key' => 'social-name',
                    'value' => 'Instagram',
                ],
                [
                    'key' => 'social-icon',
                    'value' => 'ion-social-instagram',
                ],
                [
                    'key' => 'social-url',
                    'value' => theme_option('instagram'),
                ],
                [
                    'key' => 'social-color',
                    'value' => '#3f729b',
                ],
            ],
        ];

        Setting::insertOrIgnore([
            'key' => 'theme-' . $theme . '-social_links',
            'value' => json_encode($socialLinks),
        ]);

        // Website Content Fields - Homepage
        $homepageFields = [
            'homepage_published' => 'yes',
            'homepage_seo_title' => 'OD Sports - Pakistan\'s Most Trusted Sports Agency',
            'homepage_seo_description' => 'OD Sports is Pakistan\'s most trusted sports agency, delivering complete solutions for sports events, teams, and brands across the country.',
            'homepage_hero_bg' => 'https://images.unsplash.com/photo-1552674605-46d536a1f509?auto=format&fit=crop&w=2000&q=80',
            'homepage_heading' => '',
            'homepage_description' => '',
            'homepage_content' => '',
            'homepage_badge' => 'ESTABLISHED 2022',
            'homepage_btn_primary' => 'Book your meeting',
            'homepage_btn_secondary' => 'See Our Work',
            'homepage_ticker_text' => '18.6M+ Video Views | 8.66M+ People Reached | 6,000+ Athletes Participated | 25+ Events Delivered | 3+ Years as Pakistan\'s Most Trusted Sports Agency',
            'homepage_expertise_title' => '<h2>Where Sport Meets <span class="highlight">Strategy</span></h2>',
            'homepage_expertise_subtitle' => 'From Islamabad to Galiyat, Lahore to Karachi — OD Sports brings sports events, clubs, federations, and fitness brands to life across Pakistan. We combine on-ground execution with powerful digital storytelling to grow audiences, engage communities, and turn sporting moments into lasting impact.',
            'homepage_expertise_img_1' => '',
            'homepage_expertise_main_title' => 'Pakistan\'s Most Trusted <br><span class="highlight">Sports Agency</span>',
            'homepage_expertise_main_desc_1' => 'OD Sports is a full-service sports agency operating at the intersection of sport, media, and experience design. We work with running communities, sports federations, event organisers, fitness brands, and corporate partners to deliver world-class sports experiences from planning to execution to amplification.',
            'homepage_expertise_main_desc_2' => 'From marathons and trail races to cycling, triathlons, and multi-sport events, we don\'t just organise events — we build sporting culture across Pakistan. Every detail is designed to elevate performance, participation and visibility.',
            'homepage_expertise_btn' => 'Learn Our Story →',
            'homepage_expertise_img_2' => '',
            'homepage_services_title' => 'Full-Service Sports Solutions for Every Game',
            'homepage_services_subtitle' => 'OD Sports is Pakistan\'s Most Trusted Sports Agency — delivering complete solutions for sports events, teams, and brands across the country.',
            'homepage_service_1_title' => 'Sports Event Management',
            'homepage_service_1_desc' => 'End-to-end planning, logistics, on-ground execution, and post-event reporting for every type of sports event in Pakistan.',
            'homepage_service_1_btn' => 'Learn More',
            'homepage_service_2_title' => 'Sports Media Production',
            'homepage_service_2_desc' => 'Professional photography, cinematic videography, live streaming, and short-form content that captures every moment and drives real reach.',
            'homepage_service_2_btn' => 'Learn More',
            'homepage_service_3_title' => 'Sports Marketing & Strategy',
            'homepage_service_3_desc' => 'Full-cycle digital campaigns, social media management, PR outreach, and community building for sports events and brands.',
            'homepage_service_3_btn' => 'Learn More',
            'homepage_service_4_title' => 'Digital Campaign Design',
            'homepage_service_4_desc' => 'Bold, sport-first creative — social templates, motion graphics, countdown content, event posters, and branded digital kits.',
            'homepage_service_4_btn' => 'Learn More',
            'homepage_service_5_title' => 'Custom Printing & Merchandise',
            'homepage_service_5_desc' => 'Jerseys, kits, banners, caps, and fan gear — all designed and printed to professional quality for your team or event.',
            'homepage_service_5_btn' => 'Learn More',
            'homepage_service_6_title' => 'Influencer & Athlete Marketing',
            'homepage_service_6_desc' => 'Authentic partnerships with Pakistan\'s top fitness influencers, athletes, and community leaders to amplify your campaign.',
            'homepage_service_6_btn' => 'Learn More',
            'homepage_gears_title' => 'FEATURED <span class="highlight">GEARS</span>',
            'homepage_gears_subtitle' => 'Professional grade equipment and apparel for serious athletes.',
            'homepage_portfolio_title' => 'From the Field <span class="outline-text">to the Feed</span>',
            'homepage_portfolio_subtitle' => 'We\'ve been behind some of Pakistan\'s biggest sports moments. Here\'s a taste of what we\'ve built.',
            'homepage_portfolio_1' => '',
            'homepage_portfolio_1_tag' => 'MARATHON 2022-2025',
            'homepage_portfolio_1_title' => 'Islamabad Marathon 2022–2025',
            'homepage_portfolio_1_desc' => '3-year ongoing digital and event partner. Grew the event from 500 to 6,000+ participants. Delivered 18.6M video views and reached 8.66M people.',
            'homepage_portfolio_1_btn' => 'VIEW CASE STUDY',
            'homepage_portfolio_2' => '',
            'homepage_portfolio_2_tag' => 'KIDS RUNNING',
            'homepage_portfolio_2_title' => 'YourPace by inDrive',
            'homepage_portfolio_2_desc' => 'Pakistan launch of a global kids running movement. Multi-city execution across Islamabad and Karachi — branding, event management, and full documentary production.',
            'homepage_portfolio_3' => '',
            'homepage_portfolio_3_tag' => 'TRAIL RUNNING',
            'homepage_portfolio_3_title' => 'Galyat Mountain Trail & Margalla Trail Runners',
            'homepage_portfolio_3_desc' => 'Official media partner for MTR since 2024. Covered the Backyard Ultra, Hill Half Marathon, and Trail Running Festival with cinematic productions that reached 476K+ people.',
            'homepage_portfolio_btn' => 'View Full Portfolio →',
            'homepage_stats_bg' => '',
            'homepage_testimonials_title' => 'Trusted by Pakistan\'s Sports Community',
            'homepage_testimonial_1' => '',
            'homepage_testimonial_1_name' => 'Qasim Naz',
            'homepage_testimonial_1_title' => 'Founder, Islamabad Run With Us (IRU)',
            'homepage_testimonial_1_quote' => 'Optimize Digital has been an integral partner in the journey of the Islamabad Marathon — the pioneer marathon in Pakistan. From the very beginning, their dedication and expertise in digital outreach have played a vital role in the growth and success of this event.',
            'homepage_testimonial_2' => '',
            'homepage_testimonial_2_name' => 'Brent Weigner',
            'homepage_testimonial_2_title' => 'Globally Renowned Running Icon',
            'homepage_testimonial_2_quote' => 'I\'ve never seen this level of Facebook and Instagram coverage for any event before. It was brilliant — timely, engaging, and incredibly well done.',
            'homepage_contact_title' => 'Ready to Take Your <br><span class="highlight">Sports Brand Further?</span>',
            'homepage_contact_subtitle' => 'Whether you\'re organising a city-wide run, launching an athleisure brand, or building a cricket community — OD Sports is the team that gets it done.',
            'homepage_contact_check_1' => 'Professional Event Execution',
            'homepage_contact_check_2' => 'Digital Visibility & Growth',
            'homepage_contact_check_3' => 'Expert Sports Storytelling',
            'homepage_contact_form_name' => 'Your Name',
            'homepage_contact_form_org' => 'Organization/Brand',
            'homepage_contact_form_service_label' => 'Interested Service',
            'homepage_contact_form_service_1' => 'Event Management',
            'homepage_contact_form_service_2' => 'Media Production',
            'homepage_contact_form_service_3' => 'Sports Marketing',
            'homepage_contact_form_service_4' => 'Digital Campaign Design',
            'homepage_contact_form_service_5' => 'Custom Printing',
            'homepage_contact_form_service_6' => 'Influencer Marketing',
            'homepage_contact_form_message' => 'Tell us about your sports project...',
            'homepage_contact_form_btn' => 'Schedule a Call',
            'homepage_team_title' => 'The Team Behind <span class="highlight">The Moments</span>',
            'homepage_team_subtitle' => 'A passionate crew of creatives, strategists, and sports enthusiasts driving every project forward.',
            'homepage_team_btn' => 'Meet the Full Team →',
            'homepage_stats' => json_encode([]),
            'homepage_team' => json_encode([]),
        ];

        // Event Management Fields
        $eventManagementFields = [
            'services_event_management_hero_bg' => 'https://images.unsplash.com/photo-1551958219-acbc608c6377?auto=format&fit=crop&w=2000&q=80',
            'services_event_management_hero_subtitle' => 'SERVICE 01',
            'services_event_management_hero_title_1' => 'END-TO-END SPORTS',
            'services_event_management_hero_title_2' => 'EVENT MANAGEMENT',
            'services_event_management_statement' => 'At OD Sports, we handle every aspect of sports event management — from strategy and logistics to on-ground execution and post-event analysis. Our goal is simple: every event runs flawlessly, every participant has a great experience, and every organiser can focus on what matters most.',
            'services_event_management_cap_1_img' => 'https://images.unsplash.com/photo-1552626038306-9aae5e071dd3?auto=format&fit=crop&w=1200&q=80',
            'services_event_management_cap_1_tag' => 'What We Handle',
            'services_event_management_cap_1_title' => '<span class="em-text-blue">PRE-EVENT STRATEGY,</span> <span class="em-text-neon">TIMELINE & LOGISTICS</span>',
            'services_event_management_cap_1_desc' => 'We build structured timelines and detailed logistics plans for every phase of your event — so nothing is left to chance.',
            'services_event_management_cap_2_img' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=1200&q=80',
            'services_event_management_cap_2_tag' => 'What We Handle',
            'services_event_management_cap_2_title' => '<span class="em-text-neon">VENUE COORDINATION</span> <span class="em-text-blue">& ON-GROUND SETUP</span>',
            'services_event_management_cap_2_desc' => 'From site visits to final setup, we coordinate everything to ensure your venue is event-ready and professionally presented.',
            'services_event_management_cap_3_img' => 'https://images.unsplash.com/photo-1511632765486-a01980e01a18?auto=format&fit=crop&w=1200&q=80',
            'services_event_management_cap_3_tag' => 'What We Handle',
            'services_event_management_cap_3_title' => '<span class="em-text-blue">VOLUNTEER</span> <span class="em-text-neon">& STAFF COORDINATION</span>',
            'services_event_management_cap_3_desc' => 'We manage volunteer briefings, role assignments, and real-time coordination to keep operations running smoothly on the day.',
            'services_event_management_cap_4_img' => 'https://images.unsplash.com/photo-1556761175-5973dc0f32e7?auto=format&fit=crop&w=1200&q=80',
            'services_event_management_cap_4_tag' => 'What We Handle',
            'services_event_management_cap_4_title' => '<span class="em-text-neon">REGISTRATION MANAGEMENT</span> <span class="em-text-blue">& PARTICIPANT COMMUNICATION</span>',
            'services_event_management_cap_4_desc' => 'We handle the full registration process and participant communications — confirmations, reminders, race packs, and FAQs.',
            'services_event_management_cap_5_img' => 'https://images.unsplash.com/photo-1461896836934-ffe607ba8211?auto=format&fit=crop&w=1200&q=80',
            'services_event_management_cap_5_tag' => 'What We Handle',
            'services_event_management_cap_5_title' => '<span class="em-text-blue">RACE / EVENT-DAY</span> <span class="em-text-neon">EXECUTION & CROWD MANAGEMENT</span>',
            'services_event_management_cap_5_desc' => 'Our on-ground team leads the execution, managing crowd flow, start/finish operations, timing coordination, and emergency response.',
            'services_event_management_cap_6_img' => 'https://images.unsplash.com/photo-1551958219-acbc608c6377?auto=format&fit=crop&w=1200&q=80',
            'services_event_management_cap_6_tag' => 'What We Handle',
            'services_event_management_cap_6_title' => '<span class="em-text-neon">ON-GROUND</span> <span class="em-text-blue">BRANDING</span>',
            'services_event_management_cap_6_desc' => 'From start arches to perimeter banners, we design and install event branding that looks professional and creates a strong visual identity on the day.',
            'services_event_management_cap_7_img' => 'https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=1200&q=80',
            'services_event_management_cap_7_tag' => 'What We Handle',
            'services_event_management_cap_7_title' => '<span class="em-text-blue">AV, SOUND SYSTEMS</span> <span class="em-text-neon">& SMD LIGHTING</span>',
            'services_event_management_cap_7_desc' => 'We provide complete audio-visual production including PA systems, LED screens, SMD lighting, and MC/DJ coordination for maximum event atmosphere.',
            'services_event_management_cap_8_img' => 'https://images.unsplash.com/photo-1553877522-43269d4ea984?auto=format&fit=crop&w=1200&q=80',
            'services_event_management_cap_8_tag' => 'What We Handle',
            'services_event_management_cap_8_title' => '<span class="em-text-neon">POST-EVENT REPORTING</span> <span class="em-text-blue">& AUDIENCE DATA</span>',
            'services_event_management_cap_8_desc' => 'After the event, we deliver comprehensive performance reports — attendance data, digital reach, media coverage, and recommendations for next time.',
            'services_event_management_impact_title' => '<span class="em-text-blue">PROVEN</span> <span class="em-text-neon">RESULTS</span>',
            'services_event_management_impact_desc' => 'OD Sports has been the official event and digital partner for the Islamabad Marathon since 2022 — helping grow it from 500 participants to 6,000+ and establishing it as Pakistan\'s largest marathon. We also led the multi-city execution of YourPace by inDrive across Islamabad and Karachi.',
            'services_event_management_metric_1_value' => '6,000+',
            'services_event_management_metric_1_label' => 'Participants',
            'services_event_management_metric_2_value' => '1,100%',
            'services_event_management_metric_2_label' => 'Growth',
            'services_event_management_metric_3_value' => '25+',
            'services_event_management_metric_3_label' => 'Events Delivered',
            'services_event_management_metric_4_value' => 'Multi-City',
            'services_event_management_metric_4_label' => 'Execution',
            'services_event_management_lifecycle_title' => '<span class="em-text-neon">WHO IS THIS</span> <span class="em-text-blue">FOR?</span>',
            'services_event_management_lifecycle_1' => 'Running Clubs, Marathons, and Endurance Events',
            'services_event_management_lifecycle_2' => 'Sports Federations and Governing Bodies',
            'services_event_management_lifecycle_3' => 'Fitness Brands Hosting Community Events',
            'services_event_management_lifecycle_4' => 'Schools and Universities Organising Sports Days and Tournaments',
            'services_event_management_lifecycle_5' => 'Corporate Wellness Events with a Sports Focus',
            'services_event_management_lifecycle_6' => 'Football, Cricket, and Other Team Sports Tournaments',
            'services_event_management_lifecycle_7' => 'Gyms, Training Facilities, and Sports Academies',
            'services_event_management_lifecycle_8' => 'Multi-Sport Events and Leagues',
            'services_event_management_cta_title' => '<span class="em-text-blue">READY TO</span> <br><span class="em-text-neon">WORK WITH US?</span>',
            'services_event_management_cta_btn' => 'Book a Strategy Call',
        ];

        // Media Production Fields
        $mediaProductionFields = [
            'services_media_production_hero_bg' => 'https://images.unsplash.com/photo-1533560904424-a0c61dc306fc?auto=format&fit=crop&w=2000&q=80',
            'services_media_production_hero_subtitle' => 'SERVICE 02',
            'services_media_production_hero_title_1' => 'SPORTS MEDIA',
            'services_media_production_hero_title_2' => 'PRODUCTION',
            'services_media_production_statement' => 'At OD Sports, every moment is turned into content that performs. From large-scale race-day coverage to brand-led activations, we deliver professional sports media production — photography, video, live streaming, and short-form content — that brings your event to life and keeps audiences coming back.',
            'services_media_production_cap_1_img' => 'https://images.unsplash.com/photo-1542038784456-1ea8e935640e?auto=format&fit=crop&w=1200&q=80',
            'services_media_production_cap_1_tag' => 'What We Produce',
            'services_media_production_cap_1_title' => '<span class="em-text-blue">SPORTS</span> <span class="em-text-neon">PHOTOGRAPHY</span>',
            'services_media_production_cap_1_desc' => 'Action shots, athlete portraits, crowd moments, and event coverage — delivered in a timely, high-quality format for media and social use.',
            'services_media_production_cap_2_img' => 'https://images.unsplash.com/photo-1492691523567-62736149f5a1?auto=format&fit=crop&w=1200&q=80',
            'services_media_production_cap_2_tag' => 'What We Produce',
            'services_media_production_cap_2_title' => '<span class="em-text-neon">CINEMATIC</span> <span class="em-text-blue">VIDEOGRAPHY</span>',
            'services_media_production_cap_2_desc' => 'High-impact event films, brand stories, and race-day documentaries that showcase the energy and emotion of sport.',
            'services_media_production_cap_3_img' => 'https://images.unsplash.com/photo-1516450360452-9312f5e86fc7?auto=format&fit=crop&w=1200&q=80',
            'services_media_production_cap_3_tag' => 'What We Produce',
            'services_media_production_cap_3_title' => '<span class="em-text-blue">LIVE</span> <span class="em-text-neon">STREAMING</span>',
            'services_media_production_cap_3_desc' => 'Real-time event coverage broadcast across Facebook, YouTube, and Instagram — keeping remote audiences engaged as it happens.',
            'services_media_production_cap_4_img' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&w=1200&q=80',
            'services_media_production_cap_4_tag' => 'What We Produce',
            'services_media_production_cap_4_title' => '<span class="em-text-neon">SHORT-FORM</span> <span class="em-text-blue">CONTENT</span>',
            'services_media_production_cap_4_desc' => 'Reels, highlights, and social-first edits that are crafted for maximum engagement and reach on every platform.',
            'services_media_production_cap_5_img' => 'https://images.unsplash.com/photo-1574717024653-61fd2cf4d44c?auto=format&fit=crop&w=1200&q=80',
            'services_media_production_cap_5_tag' => 'What We Produce',
            'services_media_production_cap_5_title' => '<span class="em-text-blue">BRAND FILMS</span> <span class="em-text-neon">& CAMPAIGN VISUALS</span>',
            'services_media_production_cap_5_desc' => 'Storytelling-led video content produced for sports brands, sponsors, and marketing campaigns.',
            'services_media_production_cap_6_img' => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=1200&q=80',
            'services_media_production_cap_6_tag' => 'What We Produce',
            'services_media_production_cap_6_title' => '<span class="em-text-neon">POST-EVENT CONTENT</span> <span class="em-text-blue">PACKAGES</span>',
            'services_media_production_cap_6_desc' => 'Recap visuals, highlight reels, and media-ready content for PR distribution and sponsor reporting.',
            'services_media_production_cap_7_img' => 'https://images.unsplash.com/photo-1551836022-d5d88e9218df?auto=format&fit=crop&w=1200&q=80',
            'services_media_production_cap_7_tag' => 'What We Produce',
            'services_media_production_cap_7_title' => '<span class="em-text-blue">ATHLETE & ORGANISER</span> <span class="em-text-neon">INTERVIEWS</span>',
            'services_media_production_cap_7_desc' => 'Professional on-ground interview setups capturing authentic voices from athletes, organisers, and partners.',
            'services_media_production_lifecycle_title' => '<span class="em-text-neon">WHO IS THIS</span> <span class="em-text-blue">FOR?</span>',
            'services_media_production_lifecycle_1_num' => '01',
            'services_media_production_lifecycle_1_title' => 'Sports Events',
            'services_media_production_lifecycle_1_desc' => 'Professional race-day coverage and real-time social media updates.',
            'services_media_production_lifecycle_2_num' => '02',
            'services_media_production_lifecycle_2_title' => 'Sponsors',
            'services_media_production_lifecycle_2_desc' => 'High-impact activation support and ROI reporting content.',
            'services_media_production_lifecycle_3_num' => '03',
            'services_media_production_lifecycle_3_title' => 'Federations',
            'services_media_production_lifecycle_3_desc' => 'Clubs and governing bodies building a digital media presence.',
            'services_media_production_lifecycle_4_num' => '04',
            'services_media_production_lifecycle_4_title' => 'Athletes',
            'services_media_production_lifecycle_4_desc' => 'Creating professional cinematic content for personal branding.',
            'services_media_production_impact_title' => '<span class="em-text-blue">PROVEN</span> <span class="em-text-neon">RESULTS</span>',
            'services_media_production_impact_desc' => 'Our live coverage of the Islamabad Marathon generated 381,000+ live stream views and 18.6 million total video views. We produced the full documentary for the YourPace by inDrive initiative. For the Twin City Run, we delivered 700K+ video views through a coordinated content campaign.',
            'services_media_production_metric_1_value' => '18.6M',
            'services_media_production_metric_1_label' => 'Total Video Views',
            'services_media_production_metric_2_value' => '381K+',
            'services_media_production_metric_2_label' => 'Live Stream Views',
            'services_media_production_metric_3_value' => '700K+',
            'services_media_production_metric_3_label' => 'Twin City Views',
            'services_media_production_metric_4_value' => 'Documentary',
            'services_media_production_metric_4_label' => 'Production',
            'services_media_production_cta_title' => '<span class="em-text-blue">READY FOR</span> <br><span class="em-text-neon">YOUR CLOSE-UP?</span>',
            'services_media_production_cta_btn' => 'Contact Production Team',
        ];

        // Sports Marketing Fields
        $sportsMarketingFields = [
            'services_sports_marketing_hero_bg' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=2000&q=80',
            'services_sports_marketing_hero_subtitle' => 'SERVICE 03',
            'services_sports_marketing_hero_title_1' => 'SPORTS',
            'services_sports_marketing_hero_title_2' => 'MARKETING',
            'services_sports_marketing_statement' => 'At OD Sports, we manage complete sports marketing for events and brands across Pakistan. From pre-event campaigns and digital strategy to event-day promotion and post-event follow-up, we make sure your sports initiative reaches the right audience and turns attention into participation, loyalty, and growth.',
            'services_sports_marketing_cap_1_img' => 'https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&w=1200&q=80',
            'services_sports_marketing_cap_1_tag' => 'What We Offer',
            'services_sports_marketing_cap_1_title' => '<span class="em-text-blue">END-TO-END DIGITAL</span> <span class="em-text-neon">CAMPAIGN STRATEGY</span>',
            'services_sports_marketing_cap_1_desc' => 'We build full campaign plans — from awareness to conversion — tailored to your event timeline, audience, and goals.',
            'services_sports_marketing_cap_2_img' => 'https://images.unsplash.com/photo-1611162617474-5b21e879e113?auto=format&fit=crop&w=1200&q=80',
            'services_sports_marketing_cap_2_tag' => 'What We Offer',
            'services_sports_marketing_cap_2_title' => '<span class="em-text-neon">SOCIAL MEDIA</span> <span class="em-text-blue">MANAGEMENT</span>',
            'services_sports_marketing_cap_2_desc' => 'Expert management of Instagram, Facebook, TikTok, and YouTube — content calendars, posting, community engagement, and growth.',
            'services_sports_marketing_cap_3_img' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=1200&q=80',
            'services_sports_marketing_cap_3_tag' => 'What We Offer',
            'services_sports_marketing_cap_3_title' => '<span class="em-text-blue">COMMUNITY BUILDING</span> <span class="em-text-neon">& AUDIENCE GROWTH</span>',
            'services_sports_marketing_cap_3_desc' => 'We grow your sports page organically by tapping into Pakistan\'s fitness communities, running clubs, and sports networks.',
            'services_sports_marketing_cap_4_img' => 'https://images.unsplash.com/photo-1611162616475-46b635cb6868?auto=format&fit=crop&w=1200&q=80',
            'services_sports_marketing_cap_4_tag' => 'What We Offer',
            'services_sports_marketing_cap_4_title' => '<span class="em-text-neon">HASHTAG STRATEGY</span> <span class="em-text-blue">& REAL-TIME ENGAGEMENT</span>',
            'services_sports_marketing_cap_4_desc' => 'We create and manage hashtag campaigns and run real-time social engagement during live events to amplify reach as it happens.',
            'services_sports_marketing_cap_5_img' => 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1200&q=80',
            'services_sports_marketing_cap_5_tag' => 'What We Offer',
            'services_sports_marketing_cap_5_title' => '<span class="em-text-blue">PR OUTREACH</span> <span class="em-text-neon">& MEDIA COORDINATION</span>',
            'services_sports_marketing_cap_5_desc' => 'We secure national and local media coverage for your sports initiative — press releases, journalist coordination, and post-event PR.',
            'services_sports_marketing_cap_6_img' => 'https://images.unsplash.com/photo-1526676037777-05a232554f77?auto=format&fit=crop&w=1200&q=80',
            'services_sports_marketing_cap_6_tag' => 'What We Offer',
            'services_sports_marketing_cap_6_title' => '<span class="em-text-neon">UGC CAMPAIGNS</span> <span class="em-text-blue">(USER-GENERATED CONTENT)</span>',
            'services_sports_marketing_cap_6_desc' => 'We design campaigns that encourage your audience to create and share content, generating authentic buzz and organic reach.',
            'services_sports_marketing_cap_7_img' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
            'services_sports_marketing_cap_7_tag' => 'What We Offer',
            'services_sports_marketing_cap_7_title' => '<span class="em-text-blue">PAID AD</span> <span class="em-text-neon">MANAGEMENT</span>',
            'services_sports_marketing_cap_7_desc' => 'Targeted Meta, TikTok, and Google ad campaigns to maximise visibility, registrations, and sponsor exposure.',
            'services_sports_marketing_lifecycle_title' => '<span class="em-text-neon">WHO IS THIS</span> <span class="em-text-blue">FOR?</span>',
            'services_sports_marketing_impact_title' => '<span class="em-text-blue">PROVEN</span> <span class="em-text-neon">RESULTS</span>',
            'services_sports_marketing_impact_desc' => 'Our digital campaigns for the Islamabad Marathon drove a 1,100% increase in participation from 2020 to 2025. Across all campaigns, we\'ve reached 8.66 million people and generated 191K+ engagements for our event partners.',
            'services_sports_marketing_metric_1_value' => '1,100%',
            'services_sports_marketing_metric_1_label' => 'Participation Increase',
            'services_sports_marketing_metric_2_value' => '8.66M',
            'services_sports_marketing_metric_2_label' => 'People Reached',
            'services_sports_marketing_metric_3_value' => '191K+',
            'services_sports_marketing_metric_3_label' => 'Engagements',
            'services_sports_marketing_metric_4_value' => 'Multi-Year',
            'services_sports_marketing_metric_4_label' => 'Campaigns',
            'services_sports_marketing_cta_title' => '<span class="em-text-blue">BUILD YOUR</span> <br><span class="em-text-neon">LEGACY NOW</span>',
            'services_sports_marketing_cta_btn' => 'Talk to a Strategist',
        ];

        // Custom Printing Fields
        $customPrintingFields = [
            'services_custom_printing_hero_bg' => 'https://images.unsplash.com/photo-1552674605-46d536a1f509?auto=format&fit=crop&w=2000&q=80',
            'services_custom_printing_hero_subtitle' => 'SERVICE 05',
            'services_custom_printing_hero_title_1' => 'CUSTOM',
            'services_custom_printing_hero_title_2' => 'MERCHANDISE',
            'services_custom_printing_statement' => 'OD Sports handles high-quality custom printing and merchandise for sports teams, events, and clubs across Pakistan. From jerseys and training kits to banners, flags, and fan gear — every item is designed and produced to look professional and represent your brand with pride.',
            'services_custom_printing_cap_1_img' => 'https://images.unsplash.com/photo-1542513217-0b0eea37c60e?auto=format&fit=crop&w=1200&q=80',
            'services_custom_printing_cap_1_tag' => 'What We Produce',
            'services_custom_printing_cap_1_title' => '<span class="em-text-blue">TECHNICAL</span> <span class="em-text-neon">APPAREL</span>',
            'services_custom_printing_cap_1_desc' => 'Team jerseys and training kits printed with your team\'s colours, logo, and squad numbers — so players take the field looking unified and professional.',
            'services_custom_printing_cap_2_img' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?auto=format&fit=crop&w=1200&q=80',
            'services_custom_printing_cap_2_tag' => 'What We Produce',
            'services_custom_printing_cap_2_title' => '<span class="em-text-neon">VENUE</span> <span class="em-text-blue">BRANDING</span>',
            'services_custom_printing_cap_2_desc' => 'Banners, perimeter boards, flags, and start/finish structures for sports events — giving every venue a tournament-ready look and strong brand presence.',
            'services_custom_printing_cap_3_img' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=1200&q=80',
            'services_custom_printing_cap_3_tag' => 'What We Produce',
            'services_custom_printing_cap_3_title' => '<span class="em-text-blue">FAN</span> <span class="em-text-neon">MERCHANDISE</span>',
            'services_custom_printing_cap_3_desc' => 'Caps, hoodies, and accessories that let supporters wear their passion. Printed to quality standards they\'ll actually want to wear — at matches and in everyday life.',
            'services_custom_printing_cap_4_img' => 'https://images.unsplash.com/photo-1557804506-669a67965ba0?auto=format&fit=crop&w=1200&q=80',
            'services_custom_printing_cap_4_tag' => 'What We Produce',
            'services_custom_printing_cap_4_title' => '<span class="em-text-neon">DESIGN</span> <span class="em-text-blue">CONSULTANCY</span>',
            'services_custom_printing_cap_4_desc' => 'We work with your team to create visuals that look great both on and off the field — ensuring your branding is consistent, professional, and built to last.',
            'services_custom_printing_lifecycle_title' => '<span class="em-text-neon">WHO IS THIS</span> <span class="em-text-blue">FOR?</span>',
            'services_custom_printing_cta_title' => '<span class="em-text-blue">READY TO</span> <br><span class="em-text-neon">GEAR UP?</span>',
            'services_custom_printing_cta_btn' => 'Request a Custom Order',
        ];

        // Campaign Design Fields
        $campaignDesignFields = [
            'services_campaign_design_hero_bg' => 'https://images.unsplash.com/photo-1552674605-46d536a1f509?auto=format&fit=crop&w=2000&q=80',
            'services_campaign_design_hero_subtitle' => 'SERVICE 04',
            'services_campaign_design_hero_title_1' => 'CREATIVE',
            'services_campaign_design_hero_title_2' => 'STRATEGY',
            'services_campaign_design_statement' => 'At OD Sports, we create digital content and campaign strategies that are specifically designed for sports audiences. Bold, high-energy, and platform-native — our designs stop the scroll and drive real engagement. From visual identities to animated posts, we make your sports brand look as serious as your game.',
            'services_campaign_design_cta_title' => '<span class="em-text-blue">START YOUR</span> <br><span class="em-text-neon">CAMPAIGN</span>',
            'services_campaign_design_cta_btn' => 'Talk to a Creative Lead',
        ];

        // Influencer Marketing Fields
        $influencerMarketingFields = [
            'services_influencer_marketing_hero_bg' => 'https://images.unsplash.com/photo-1547483161-5918641d402b?auto=format&fit=crop&w=2000&q=80',
            'services_influencer_marketing_hero_subtitle' => 'SERVICE 06',
            'services_influencer_marketing_hero_title_1' => 'INFLUENCER',
            'services_influencer_marketing_hero_title_2' => 'MARKETING',
            'services_influencer_marketing_statement' => 'At OD Sports, we connect your event or brand with the right fitness influencers, athletes, and community leaders across Pakistan. Our influencer marketing is built on authenticity — finding people who genuinely care about sport and whose audiences are already primed to engage.',
            'services_influencer_marketing_cta_title' => '<span class="em-text-blue">CONNECT WITH</span> <br><span class="em-text-neon">INFLUENCERS</span>',
            'services_influencer_marketing_cta_btn' => 'Talk to an Outreach Expert',
        ];

        // Portfolio Fields
        $portfolioFields = [
            'portfolio_badge' => 'OUR WORK SPEAKS FOR ITSELF',
            'portfolio_title' => 'PORTFOLIO',
            'portfolio_subtitle' => 'From Pakistan\'s largest marathon to kids running in the hills of Islamabad — every project we take on gets the same commitment. Here\'s what we\'ve built.',
        ];

        // About Us Fields
        $aboutFields = [
            'about_hero_bg' => 'https://images.unsplash.com/photo-1540747913346-19e32dc3e97e?auto=format&fit=crop&w=2000&q=80',
            'about_hero_subtitle' => 'OUR STORY',
            'about_hero_title_1' => 'PAKISTAN\'S MOST TRUSTED',
            'about_hero_title_2' => 'SPORTS AGENCY',
            'about_hero_desc' => 'OD Sports was built with one purpose to be the sports agency that Pakistan\'s events, clubs, brands and athletes can truly rely on.',
            'about_story_title' => '<span class="em-text-neon">FROM MARATHONS</span> <br><span class="em-text-blue">TO MOVEMENTS</span>',
            'about_story_p1' => 'OD Sports started as a response to a clear gap in Pakistan\'s sports ecosystem. Events were happening, communities were growing, athletes were achieving but the storytelling, the strategy, and the execution weren\'t keeping up.',
            'about_story_p2' => 'We set out to change that.',
            'about_story_p3' => 'As part of Optimize Digital, we launched OD Sports to bring full agency expertise — digital strategy, creative production, media, and on-ground execution — to Pakistan\'s growing sports world. We started with running events in Islamabad and quickly became the trusted partner behind some of Pakistan\'s biggest sporting moments.',
            'about_different_title' => '<span class="em-text-neon">WHAT MAKES US</span> <span class="em-text-blue">DIFFERENT?</span>',
            'about_different_subtitle' => 'Built for Sports. Not Just Available for It',
            'about_team_label' => 'THE TEAM',
            'about_team_title' => 'MEET THE PEOPLE <span class="highlight-text">BEHIND OD SPORTS</span>',
            'about_team_subtitle' => 'A diverse team of creatives, strategists, and sports enthusiasts — united by a love of sport.',
            'about_contact_title' => '<span class="em-text-blue">Based in Islamabad.</span> <br><span class="em-text-neon">Working Across Pakistan.</span>',
            'about_head_office_label' => 'HEAD OFFICE',
            'about_head_office_address' => '3rd Floor, Manzoor Plaza, G-6/2 Blue Area, Islamabad',
            'about_branch_office_label' => 'BRANCH OFFICE',
            'about_branch_office_address' => 'LG3, Hamza Tower, Street 73, F11/1, Islamabad',
            'about_contact_btn' => 'Get in Touch →',
        ];

        // Custom Orders Fields
        $customOrdersFields = [
            'custom_orders_hero_bg' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=2000&q=80',
            'custom_orders_hero_subtitle' => 'GEAR UP',
            'custom_orders_hero_title_1' => 'CUSTOM MERCHANDISE',
            'custom_orders_hero_title_2' => 'FOR YOUR TEAM OR EVENT',
            'custom_orders_hero_desc' => 'Need jerseys, event t-shirts, banners, or branded fan gear? Tell us what you need — we handle design, printing, and delivery anywhere in Pakistan.',
            'custom_orders_what_we_make_title' => 'WHAT WE <span class="highlight-text">MAKE</span>',
            'custom_orders_how_it_works_title' => '<span class="em-text-neon">HOW IT</span> <span class="em-text-blue">WORKS</span>',
            'custom_orders_form_title' => 'READY TO <br><span class="highlight">GEAR UP?</span>',
            'custom_orders_form_desc' => 'Whether you need 50 jerseys or a full event merchandise package — we\'ll handle everything from first sketch to final delivery.',
            'custom_orders_form_btn' => 'Request a Custom Order',
        ];

        // Merge all fields
        $allFields = array_merge(
            $homepageFields,
            $eventManagementFields,
            $mediaProductionFields,
            $sportsMarketingFields,
            $customPrintingFields,
            $campaignDesignFields,
            $influencerMarketingFields,
            $portfolioFields,
            $aboutFields,
            $customOrdersFields
        );

        // Insert all website content fields with theme prefix (Theme::getOption expects this format)
        foreach ($allFields as $key => $value) {
            Setting::insertOrIgnore([
                'key' => 'theme-' . $theme . '-' . $key,
                'value' => $value,
            ]);
        }
    }
}
