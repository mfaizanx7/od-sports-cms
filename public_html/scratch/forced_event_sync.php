<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $options = [
            'event_hero_subtitle' => 'SERVICE 01 — SPORTS EVENT MANAGEMENT',
            'event_hero_title_1' => 'End-to-End Sports',
            'event_hero_title_2' => 'Event Management',
            'event_statement' => 'At OD Sports, we handle every aspect of sports event management — from strategy and logistics to on-ground execution and post-event analysis. Our goal is simple: every event runs flawlessly, every participant has a great experience, and every organiser can focus on what matters most.',
            
            'event_cap_1_title' => 'Pre-Event Strategy, Timeline & Logistics',
            'event_cap_1_desc' => 'We build structured timelines and detailed logistics plans for every phase of your event — so nothing is left to chance.',
            
            'event_cap_2_title' => 'Venue Coordination & On-Ground Setup',
            'event_cap_2_desc' => 'From site visits to final setup, we coordinate everything to ensure your venue is event-ready and professionally presented.',
            
            'event_cap_3_title' => 'Volunteer & Staff Coordination',
            'event_cap_3_desc' => 'We manage volunteer briefings, role assignments, and real-time coordination to keep operations running smoothly on the day.',
            
            'event_cap_4_title' => 'Registration Management & Participant Communication',
            'event_cap_4_desc' => 'We handle the full registration process and participant communications — confirmations, reminders, race packs, and FAQs.',
            
            'event_cap_5_title' => 'Race / Event-Day Execution & Crowd Management',
            'event_cap_5_desc' => 'Our on-ground team leads the execution, managing crowd flow, start/finish operations, timing coordination, and emergency response.',
            
            'event_cap_6_title' => 'On-Ground Branding',
            'event_cap_6_desc' => 'From start arches to perimeter banners, we design and install event branding that looks professional and creates a strong visual identity on the day.',
            
            'event_cap_7_title' => 'AV, Sound Systems & SMD Lighting',
            'event_cap_7_desc' => 'We provide complete audio-visual production including PA systems, LED screens, SMD lighting, and MC/DJ coordination for maximum event atmosphere.',
            
            'event_cap_8_title' => 'Post-Event Reporting & Audience Data',
            'event_cap_8_desc' => 'After the event, we deliver comprehensive performance reports — attendance data, digital reach, media coverage, and recommendations for next time.',
            
            'event_impact_desc' => "OD Sports has been the official event and digital partner for the Islamabad Marathon since 2022 giúp grow it from 500 participants to 6,000+ and establishing it as Pakistan's largest marathon. We also led the multi-city execution of YourPace by inDrive across Islamabad and Karachi.",
            
            'event_lifecycle_1' => 'Running clubs, marathons, and endurance events',
            'event_lifecycle_2' => 'Sports federations and governing bodies',
            'event_lifecycle_3' => 'Fitness brands hosting community events',
            'event_lifecycle_4' => 'Schools and universities organising sports days and tournaments',
            'event_lifecycle_5' => 'Corporate wellness events with a sports focus',
            'event_lifecycle_6' => 'Football, cricket, and other team sports tournaments',
            'event_lifecycle_7' => 'Gyms, training facilities, and sports academies',
            'event_lifecycle_8' => 'Multi-sport events and leagues',
        ];

        foreach ($options as $key => $value) {
            theme_option()->setOption($key, $value);
        }
        theme_option()->saveOptions();
        
        // Manual sync for all possible theme prefixes
        foreach ($options as $key => $value) {
             \DB::table('settings')->where('key', 'like', '%' . $key)->update(['value' => $value]);
        }

        echo "Successfully performed forced sync of ALL event management fields.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
