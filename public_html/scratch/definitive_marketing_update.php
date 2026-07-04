<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $options = [
            'sportsmarketing_hero_subtitle' => 'SERVICE 03 — SPORTS MARKETING & STRATEGY',
            'sportsmarketing_hero_title_1' => 'Sports Marketing That Builds',
            'sportsmarketing_hero_title_2' => 'Audiences — Not Just Followers',
            'sportsmarketing_statement' => 'At OD Sports, we manage complete sports marketing for events and brands across Pakistan. From pre-event campaigns and digital strategy to event-day promotion and post-event follow-up, we make sure your sports initiative reaches the right audience and turns attention into participation, loyalty, and growth.',
            
            'sportsmarketing_cap_1_title' => 'End-to-End Digital Campaign Strategy',
            'sportsmarketing_cap_1_desc' => 'We build full campaign plans — from awareness to conversion — tailored to your event timeline, audience, and goals.',
            
            'sportsmarketing_cap_2_title' => 'Social Media Management',
            'sportsmarketing_cap_2_desc' => 'Expert management of Instagram, Facebook, TikTok, and YouTube — content calendars, posting, community engagement, and growth.',
            
            'sportsmarketing_cap_3_title' => 'Community Building & Audience Growth',
            'sportsmarketing_cap_3_desc' => "We grow your sports page organically by tapping into Pakistan's fitness communities, running clubs, and sports networks.",
            
            'sportsmarketing_cap_4_title' => 'Hashtag Strategy & Real-Time Engagement',
            'sportsmarketing_cap_4_desc' => 'We create and manage hashtag campaigns and run real-time social engagement during live events to amplify reach as it happens.',
            
            'sportsmarketing_cap_5_title' => 'PR Outreach & Media Coordination',
            'sportsmarketing_cap_5_desc' => 'We secure national and local media coverage for your sports initiative — press releases, journalist coordination, and post-event PR.',
            
            'sportsmarketing_cap_6_title' => 'UGC (User-Generated Content) Campaigns',
            'sportsmarketing_cap_6_desc' => 'We design campaigns that encourage your audience to create and share content, generating authentic buzz and organic reach.',
            
            'sportsmarketing_cap_7_title' => 'Paid Ad Management',
            'sportsmarketing_cap_7_desc' => 'Targeted Meta, TikTok, and Google ad campaigns to maximise visibility, registrations, and sponsor exposure.',
            
            'sportsmarketing_impact_desc' => "Our digital campaigns for the Islamabad Marathon drove a 1,100% increase in participation from 2020 to 2025. Across all campaigns, we've reached 8.66 million people and generated 191K+ engagements for our event partners.",
            
            'sportsmarketing_lifecycle_1' => 'Marathon and running event organisers',
            'sportsmarketing_lifecycle_2' => 'Sports federations building national awareness',
            'sportsmarketing_lifecycle_3' => 'Fitness brands launching community-first campaigns',
            'sportsmarketing_lifecycle_4' => 'Clubs and academies growing their digital presence',
            'sportsmarketing_lifecycle_5' => 'Sponsors looking for activation support',
        ];

        foreach ($options as $key => $value) {
            theme_option()->setOption($key, $value);
        }
        theme_option()->saveOptions();
        
        // Manual DB forced sync for those keys
        foreach ($options as $key => $value) {
             \DB::table('settings')->where('key', 'like', '%' . $key)->update(['value' => $value]);
        }

        echo "Successfully performed full definitive update of Sports Marketing page.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
