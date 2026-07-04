<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        theme_option()->setOption('event_hero_title_1', 'SPORTS EVENT');
        theme_option()->setOption('event_hero_title_2', 'MANAGEMENT');
        theme_option()->saveOptions();
        echo "Successfully removed TEST VALUE and updated titles.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
