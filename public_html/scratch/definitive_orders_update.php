<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $options = [
            'orders_hero_subtitle' => 'PAGE 4 — CUSTOM ORDERS',
            'orders_hero_title_1' => 'Custom Merchandise',
            'orders_hero_title_2' => 'for Your Team or Event',
            'orders_hero_desc' => 'Need jerseys, event t-shirts, banners, or branded fan gear? Tell us what you need — we handle design, printing, and delivery anywhere in Pakistan.',
            
            'orders_what_we_make_title' => 'WHAT WE <span class="em-text-neon">MAKE</span>',
            'orders_how_it_works_title' => '<span class="em-text-neon">HOW IT</span> <span class="em-text-blue">WORKS</span>',
            
            'orders_form_title' => 'Ready to <br><span class="highlight">Gear Up?</span>',
            'orders_form_desc' => "Whether you need 50 jerseys or a full event merchandise package — we'll handle everything from first sketch to final delivery.",
            'orders_form_btn' => 'Request a Custom Order',
        ];

        foreach ($options as $key => $value) {
            theme_option()->setOption($key, $value);
        }
        theme_option()->saveOptions();
        
        // Manual DB forced sync for those keys
        foreach ($options as $key => $value) {
             \DB::table('settings')->where('key', 'like', '%' . $key)->update(['value' => $value]);
        }

        echo "Successfully performed full definitive update of Custom Orders page.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
