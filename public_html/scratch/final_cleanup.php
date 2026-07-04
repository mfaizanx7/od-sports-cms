<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        // 1. Remove 'TEST VALUE' from badge and subtitle
        theme_option()->setOption('homepage_badge', 'ESTABLISHED 2022');
        theme_option()->setOption('event_hero_subtitle', 'SERVICE 01');
        
        // 2. Clean up event statement
        $statement = "At OD Sports, we handle every aspect of sports event management — from strategy and logistics to on-ground execution and post-event analysis. Our goal is simple: every event runs flawlessly, every participant has a great experience, and every organiser can focus on what matters most.";
        theme_option()->setOption('event_statement', $statement);
        
        theme_option()->saveOptions();
        echo "Successfully cleaned up all test values and trailing text.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
