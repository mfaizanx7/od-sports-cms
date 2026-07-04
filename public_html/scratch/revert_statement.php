<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $value = "At OD Sports, we handle every aspect of sports event management — from strategy and logistics to on-ground execution and post-event analysis. Our goal is simple: every event runs flawlessly, every participant has a great experience, and every organiser can focus on what matters most.";
        theme_option()->setOption('event_statement', $value);
        theme_option()->saveOptions();
        echo "Successfully reverted event management statement.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
