<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $options = [
            'media_hero_subtitle' => 'SERVICE 02 — SPORTS MEDIA PRODUCTION',
            'media_hero_title_1' => 'Sports Media Production',
            'media_hero_title_2' => 'That Drives Real Reach',
            'media_statement' => 'At OD Sports, every moment is turned into content that performs. From large-scale race-day coverage to brand-led activations, we deliver professional sports media production — photography, video, live streaming, and short-form content — that brings your event to life and keeps audiences coming back.',
            
            'media_cap_1_title' => 'Sports Photography',
            'media_cap_1_desc' => 'Action shots, athlete portraits, crowd moments, and event coverage — delivered in a timely, high-quality format for media and social use.',
            
            'media_cap_2_title' => 'Cinematic Videography',
            'media_cap_2_desc' => 'High-impact event films, brand stories, and race-day documentaries that showcase the energy and emotion of sport.',
            
            'media_cap_3_title' => 'Live Streaming',
            'media_cap_3_desc' => 'Real-time event coverage broadcast across Facebook, YouTube, and Instagram — keeping remote audiences engaged as it happens.',
            
            'media_cap_4_title' => 'Short-Form Content',
            'media_cap_4_desc' => 'Reels, highlights, and social-first edits that are crafted for maximum engagement and reach on every platform.',
            
            'media_cap_5_title' => 'Brand Films & Campaign Visuals',
            'media_cap_5_desc' => 'Storytelling-led video content produced for sports brands, sponsors, and marketing campaigns.',
            
            'media_cap_6_title' => 'Post-Event Content Packages',
            'media_cap_6_desc' => 'Recap visuals, highlight reels, and media-ready content for PR distribution and sponsor reporting.',
            
            'media_cap_7_title' => 'Athlete & Organiser Interviews',
            'media_cap_7_desc' => 'Professional on-ground interview setups capturing authentic voices from athletes, organisers, and partners.',
            
            'media_impact_desc' => "Our live coverage of the Islamabad Marathon generated 381,000+ live stream views and 18.6 million total video views. We produced the full documentary for the YourPace by inDrive initiative. For the Twin City Run, we delivered 700K+ video views through a coordinated content campaign.",
            
            'media_lifecycle_1' => 'Sports events needing professional race-day coverage',
            'media_lifecycle_2' => 'Brands running sports sponsorship activations',
            'media_lifecycle_3' => 'Federations and clubs building an online media presence',
            'media_lifecycle_4' => 'Athletes and coaches building personal brand content',
            'media_lifecycle_5' => 'Organisations requiring post-event content for sponsors or press',
        ];

        foreach ($options as $key => $value) {
            theme_option()->setOption($key, $value);
        }
        theme_option()->saveOptions();
        
        // Manual DB forced sync for those keys
        foreach ($options as $key => $value) {
             \DB::table('settings')->where('key', 'like', '%' . $key)->update(['value' => $value]);
        }

        echo "Successfully performed full definitive update of Media Production page.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
