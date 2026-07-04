<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$updates = [
    'theme-shopwise-homepage_portfolio_1_tag' => 'MARATHON 2022-2025',
    'theme-shopwise-homepage_portfolio_1_title' => 'Islamabad Marathon 2022–2025',
    'theme-shopwise-homepage_portfolio_1_desc' => '3-year ongoing digital and event partner. Grew the event from 500 to 6,000+ participants. Delivered 18.6M video views and reached 8.66M people.',
    'theme-shopwise-homepage_portfolio_1_img' => 'landing-assets/images/marathon_race_day.png',
    
    'theme-shopwise-homepage_portfolio_2_tag' => 'KIDS RUNNING',
    'theme-shopwise-homepage_portfolio_2_title' => 'YourPace by inDrive',
    'theme-shopwise-homepage_portfolio_2_desc' => 'Pakistan launch of a global kids running movement. Multi-city execution across Islamabad and Karachi — branding, event management, and full documentary production.',
    'theme-shopwise-homepage_portfolio_2_img' => 'landing-assets/images/kids_running.png',
    
    'theme-shopwise-homepage_portfolio_3_tag' => 'TRAIL RUNNING',
    'theme-shopwise-homepage_portfolio_3_title' => 'Galyat Mountain Trail & Margalla Trail Runners',
    'theme-shopwise-homepage_portfolio_3_desc' => 'Official media partner for MTR since 2024. Covered the Backyard Ultra, Hill Half Marathon, and Trail Running Festival with cinematic productions that reached 476K+ people.',
    'theme-shopwise-homepage_portfolio_3_img' => 'landing-assets/images/trail_runner.png',
];

foreach ($updates as $key => $value) {
    $existing = \DB::table('settings')->where('key', $key)->first();
    if ($existing) {
        \DB::table('settings')->where('key', $key)->update(['value' => $value]);
        echo "Updated $key\n";
    } else {
        \DB::table('settings')->insert(['key' => $key, 'value' => $value]);
        echo "Inserted $key\n";
    }
}
echo "Done!\n";
