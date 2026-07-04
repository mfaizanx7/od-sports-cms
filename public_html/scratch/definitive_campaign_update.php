<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $options = [
            'campaign_hero_subtitle' => 'SERVICE 04 — DIGITAL CAMPAIGN DESIGN & CREATIVE STRATEGY',
            'campaign_hero_title_1' => 'Creative That\'s Built for Sports',
            'campaign_hero_title_2' => '— Not Just Adapted for It',
            'campaign_statement' => 'At OD Sports, we create digital content and campaign strategies that are specifically designed for sports audiences. Bold, high-energy, and platform-native — our designs stop the scroll and drive real engagement. From visual identities to animated posts, we make your sports brand look as serious as your game.',
            
            // Campaign Design
            'campaign_cap_1_title' => 'Social Media Templates & Campaign Graphics',
            'campaign_cap_1_desc' => 'Consistent, professional post templates and campaign graphics for your team\'s Instagram, Facebook, and TikTok — designed for quick publishing and brand cohesion.',
            'campaign_cap_2_title' => 'Event Countdown & Teaser Series',
            'campaign_cap_2_desc' => 'Structured teaser and countdown content that builds momentum and excitement before every match or event.',
            'campaign_cap_3_title' => 'Registration & Awareness Posters',
            'campaign_cap_3_desc' => 'Clear, eye-catching posters that communicate event details and drive sign-ups — for both print and digital use.',
            'campaign_cap_4_title' => 'Story Templates for Instagram & Facebook',
            'campaign_cap_4_desc' => 'Branded story templates that make sharing event updates, results, and announcements quick and professional.',
            'campaign_cap_5_title' => 'Email Headers & Newsletter Design',
            'campaign_cap_5_desc' => 'Professional email visuals that represent your sports brand consistently in every inbox.',
            'campaign_cap_6_title' => 'Branded Digital Kits for Events & Sponsors',
            'campaign_cap_6_desc' => 'Complete digital asset packages for events and sponsors, ensuring all branding stays consistent across platforms and materials.',
            'campaign_cap_7_title' => 'Motion Graphics & Animated Posts',
            'campaign_cap_7_desc' => 'Dynamic animated content that brings campaigns to life and significantly increases post engagement and shareability.',
            
            // Creative Strategy
            'campaign_strat_1_title' => 'Campaign Concept & Big Idea',
            'campaign_strat_1_desc' => 'A single, clear creative idea that anchors the entire campaign and gives it direction.',
            'campaign_strat_2_title' => 'Brand Voice Definition',
            'campaign_strat_2_desc' => 'Consistent messaging guidelines so your sports brand communicates authentically across every channel.',
            'campaign_strat_3_title' => 'Content Calendar & Phased Rollout Plan',
            'campaign_strat_3_desc' => 'A structured content plan covering pre-event, event-day, and post-event phases to maintain audience engagement throughout.',
            'campaign_strat_4_title' => 'Cross-Platform Storytelling',
            'campaign_strat_4_desc' => 'Content adapted for Instagram, Facebook, YouTube, and TikTok — reaching your audience wherever they are.',
            'campaign_strat_5_title' => 'Athlete & Community Story Arcs',
            'campaign_strat_5_desc' => 'Stories built around real athletes and communities that deepen audience connection and build loyalty.',
            
            'campaign_impact_desc' => 'We\'ve developed visual identities and full campaign strategies for the Islamabad Marathon, YourPace by inDrive, Margalla Trail Runners, and more. Our structured campaign approach drove a 1,100% participation increase for the Islamabad Marathon since 2020.',
            
            'campaign_lifecycle_1' => 'Events needing a complete visual identity and content plan',
            'campaign_lifecycle_2' => 'Sports brands launching campaigns or new products',
            'campaign_lifecycle_3' => 'Clubs and teams building a consistent digital presence',
            'campaign_lifecycle_4' => 'Federations and governing bodies running awareness campaigns',
        ];

        foreach ($options as $key => $value) {
            theme_option()->setOption($key, $value);
        }
        theme_option()->saveOptions();
        
        // Manual DB forced sync for those keys
        foreach ($options as $key => $value) {
             \DB::table('settings')->where('key', 'like', '%' . $key)->update(['value' => $value]);
        }

        echo "Successfully performed full definitive update of Campaign Design page.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
