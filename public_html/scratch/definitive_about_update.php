<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $options = [
            'about_hero_subtitle' => 'PAGE 5 — ABOUT',
            'about_hero_title_1' => "PAKISTAN'S MOST TRUSTED",
            'about_hero_title_2' => "SPORTS AGENCY",
            'about_hero_desc' => "OD Sports was built with one purpose to be the sports agency that Pakistan's events, clubs, brands and athletes can truly rely on.",
            
            'about_story_title' => 'From Marathons to Movements',
            'about_story_p1' => "OD Sports started as a response to a clear gap in Pakistan's sports ecosystem. Events were happening, communities were growing, athletes were achieving  but the storytelling, the strategy, and the execution weren't keeping up.",
            'about_story_p2' => "We set out to change that.",
            'about_story_p3' => "As part of Optimize Digital, we launched OD Sports to bring full agency expertise — digital strategy, creative production, media, and on-ground execution  to Pakistan's growing sports world. We started with running events in Islamabad and quickly became the trusted partner behind some of Pakistan's biggest sporting moments.",
            'about_story_p4' => "From the Islamabad Marathon and Margalla Trail Runners to YourPace by inDrive, the Lahore Marathon, the Twin City Run, and Shehroze Kashif's historic 14×8000er project — we have delivered for every type of sports initiative, at every scale.",
            'about_story_p5' => "Today, OD Sports is Pakistan's leading sports agency — and we're just getting started.",
            
            'about_different_title' => 'Built for Sports. Not Just Available for It.',
            'about_different_p1' => "We have real experience managing Pakistan's largest annual running events",
            'about_different_p2' => "We understand sports audiences they are communities, not just consumers",
            'about_different_p3' => "We handle both the digital side and the on-ground execution, so nothing falls through the cracks",
            'about_different_p4' => "We operate nationwide  Islamabad, Rawalpindi, Karachi, Lahore, and beyond",
            'about_different_p5' => "We are part of Optimize Digital, giving us full agency resources for every sports project",
            
            'about_team_title' => 'Meet the People Behind OD Sports',
            'about_team_subtitle' => 'A diverse team of creatives, strategists, and sports enthusiasts united by a love of sport and a commitment to making every project exceptional.',
            
            'about_team_1_name' => 'Imran Ghazali', 'about_team_1_role' => 'Founder & CEO',
            'about_team_2_name' => 'Aqib Mughal', 'about_team_2_role' => 'Director, Client Relations & Operations',
            'about_team_3_name' => 'Laiba Shakeel', 'about_team_3_role' => 'Senior Manager, Digital',
            'about_team_4_name' => 'Ansab Naeem', 'about_team_4_role' => 'Director, Photography & Videography',
            'about_team_5_name' => 'Muneeb Ahmad', 'about_team_5_role' => 'Senior Graphic Designer',
            'about_team_6_name' => 'Angelina Yousaf', 'about_team_6_role' => 'Content Writer & Social Media Executive',
            'about_team_7_name' => 'Irtaza Hussain', 'about_team_7_role' => 'Manager, PR & Social Media',
            'about_team_8_name' => 'Ambreen Riaz', 'about_team_8_role' => 'Influencer Engagement & PR Associate',
            'about_team_9_name' => 'Usman Yaqub', 'about_team_9_role' => 'SEO Specialist',
            'about_team_10_name' => 'Muhammad Mutahir', 'about_team_10_role' => 'Graphic Designer',
            'about_team_11_name' => 'Sheraz Hussain', 'about_team_11_role' => 'Senior Video Editor',
            'about_team_12_name' => 'Saddam Korai', 'about_team_12_role' => 'Video Editor',
            'about_team_13_name' => 'Muhammad Faizan', 'about_team_13_role' => 'Videographer & Drone Operator',
            'about_team_14_name' => 'Sameer', 'about_team_14_role' => 'Photographer & Videographer',
            'about_team_15_name' => 'Faisal', 'about_team_15_role' => 'Photographer',
            
            'about_office1_title' => 'HEAD OFFICE',
            'about_office1_address' => '3rd Floor, Manzoor Plaza, G-6/2 Blue Area, Islamabad',
            'about_office2_title' => 'BRANCH OFFICE',
            'about_office2_address' => 'LG3, Hamza Tower, Street 73, F11/1, Islamabad',
            'about_cta_btn' => 'Call Us: +92 320 1223359',
        ];

        foreach ($options as $key => $value) {
            theme_option()->setOption($key, $value);
        }
        theme_option()->saveOptions();
        
        // Manual DB forced sync for those keys
        foreach ($options as $key => $value) {
             \DB::table('settings')->where('key', 'like', '%' . $key)->update(['value' => $value]);
        }

        echo "Successfully performed full definitive update of About page.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
