<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        theme_option()->setOption('event_hero_title_1', 'TEST VALUE');
        theme_option()->setOption('event_hero_title_2', 'SPORTS EVENT MANAGEMENT');
        theme_option()->setOption('event_statement', 'At OD Sports, we handle every aspect of sports event management — from strategy and logistics to on-ground execution and post-event analysis. Our goal is simple: from logistics to legacy');
        theme_option()->saveOptions();
        echo "Successfully updated event management content.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
