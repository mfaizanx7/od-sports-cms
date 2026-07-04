<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $options = [
            'influencer_hero_subtitle' => 'SERVICE 06 — INFLUENCER & ATHLETE MARKETING',
            'influencer_hero_title_1' => 'Real People. Real Reach.',
            'influencer_hero_title_2' => 'Real Results.',
            'influencer_statement' => 'At OD Sports, we connect your event or brand with the right fitness influencers, athletes, and community leaders across Pakistan. Our influencer marketing is built on authenticity — finding people who genuinely care about sport and whose audiences are already primed to engage.',
            
            'influencer_cap_1_title' => 'Influencer Identification & Vetting',
            'influencer_cap_1_desc' => 'We research and qualify influencers based on sports relevance, audience quality, engagement rates, and alignment with your campaign goals.',
            
            'influencer_cap_2_title' => 'Outreach, Negotiation & Partnership Management',
            'influencer_cap_2_desc' => 'We handle all communications, agreements, and relationship management — so you get quality partnerships without the admin.',
            
            'influencer_cap_3_title' => 'Campaign Briefing & Content Approval',
            'influencer_cap_3_desc' => 'We brief influencers with clear creative direction and review all content before it goes live to ensure quality and brand alignment.',
            
            'influencer_cap_4_title' => 'Performance Tracking & ROI Reporting',
            'influencer_cap_4_desc' => 'After the campaign, we deliver detailed performance reports covering reach, engagement, conversions, and overall ROI.',
            
            'influencer_cap_5_title' => 'Athlete Ambassador Programs',
            'influencer_cap_5_desc' => 'Long-term athlete partnerships that build sustained brand visibility and authentic community connection.',
            
            'influencer_cap_6_title' => 'Running Club & Community Leader Collaborations',
            'influencer_cap_6_desc' => "We tap into Pakistan's growing network of running clubs and fitness communities for targeted, highly relevant audience reach.",
            
            'influencer_impact_desc' => "For the Islamabad Marathon, we managed a 3.5-month influencer campaign using carefully selected fitness influencers — bringing thousands of new runners into Pakistan's fitness community and significantly amplifying the event's digital reach.",
            
            'influencer_lifecycle_1' => 'Events looking to grow registrations through community influence',
            'influencer_lifecycle_2' => 'Fitness brands launching products to active audiences',
            'influencer_lifecycle_3' => 'Sports organisations building ambassador programs',
            'influencer_lifecycle_4' => 'Campaigns targeting Pakistan\'s growing running and fitness communities',
        ];

        foreach ($options as $key => $value) {
            theme_option()->setOption($key, $value);
        }
        theme_option()->saveOptions();
        
        // Manual DB forced sync for those keys
        foreach ($options as $key => $value) {
             \DB::table('settings')->where('key', 'like', '%' . $key)->update(['value' => $value]);
        }

        echo "Successfully performed full definitive update of Influencer Marketing page.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
