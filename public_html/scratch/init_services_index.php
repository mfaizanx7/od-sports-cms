<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $options = [
        'services_index_hero_title' => 'Full-Service Sports Solutions — From Ideation to Execution',
        'services_index_hero_subtitle' => 'Every service we offer is built for the sports world. We understand the game, the culture, and what it takes to deliver results on the ground and online.',
        'services_index_hero_img' => 'https://images.unsplash.com/photo-1540575467063-178a50c2df87?auto=format&fit=crop&w=2000&q=80',
        'services_index_nav_label_1' => 'Event Management',
        'services_index_nav_label_2' => 'Media Production',
        'services_index_nav_label_3' => 'Sports Marketing',
        'services_index_nav_label_4' => 'Campaign Design & Creative Strategy',
        'services_index_nav_label_5' => 'Custom Printing & Merchandise',
        'services_index_nav_label_6' => 'Influencer & Athlete Marketing',
    ];
    
    if (function_exists('theme_option')) {
        foreach ($options as $key => $value) {
            theme_option()->setOption($key, $value);
        }
        theme_option()->saveOptions();
        echo "Successfully updated services_index options with long labels.\n";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
