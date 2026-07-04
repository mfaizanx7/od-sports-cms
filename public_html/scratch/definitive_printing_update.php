<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $options = [
            'printing_hero_subtitle' => 'SERVICE 05 — CUSTOM PRINTING & SPORTS MERCHANDISE',
            'printing_hero_title_1' => 'Look the Part.',
            'printing_hero_title_2' => 'Play the Part.',
            'printing_statement' => 'OD Sports handles high-quality custom printing and merchandise for sports teams, events, and clubs across Pakistan. From jerseys and training kits to banners, flags, and fan gear — every item is designed and produced to look professional and represent your brand with pride.',
            
            'printing_cap_1_title' => 'Technical Apparel',
            'printing_cap_1_desc' => 'Team jerseys and training kits printed with your team\'s colours, logo, and squad numbers — so players take the field looking unified and professional.',
            
            'printing_cap_2_title' => 'Venue Branding',
            'printing_cap_2_desc' => 'Banners, perimeter boards, flags, and start/finish structures for sports events — giving every venue a tournament-ready look and strong brand presence.',
            
            'printing_cap_3_title' => 'Fan Merchandise',
            'printing_cap_3_desc' => 'Caps, hoodies, and accessories that let supporters wear their passion. Printed to quality standards they\'ll actually want to wear — at matches and in everyday life.',
            
            'printing_cap_4_title' => 'Design Consultancy',
            'printing_cap_4_desc' => 'We work with your team to create visuals that look great both on and off the field — ensuring your branding is consistent, professional, and built to last.',
            
            'printing_lifecycle_1' => 'Sports teams and clubs needing kits and training gear',
            'printing_lifecycle_2' => 'Events requiring professional venue branding',
            'printing_lifecycle_3' => 'Brands launching co-branded merchandise',
            'printing_lifecycle_4' => 'Fan communities and supporters\' groups',
            'printing_lifecycle_5' => 'Schools, academies, and universities',
        ];

        foreach ($options as $key => $value) {
            theme_option()->setOption($key, $value);
        }
        theme_option()->saveOptions();
        
        // Manual DB forced sync for those keys
        foreach ($options as $key => $value) {
             \DB::table('settings')->where('key', 'like', '%' . $key)->update(['value' => $value]);
        }

        echo "Successfully performed full definitive update of Custom Printing page.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
