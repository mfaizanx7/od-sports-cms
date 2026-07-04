<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    if (function_exists('theme_option')) {
        $statement = "At OD Sports, we handle every aspect of sports event management — from strategy and logistics to on-ground execution and post-event analysis. Our goal is simple: every event runs flawlessly, every participant has a great experience, and every organiser can focus on what matters most.";
        
        // Update via theme_option helper
        theme_option()->setOption('event_statement', $statement);
        theme_option()->saveOptions();
        
        // Manually update in DB for all possible theme prefixes
        \DB::table('settings')
            ->where('key', 'like', '%event_statement')
            ->update(['value' => $statement]);

        echo "Successfully performed deep cleanup of event statement.\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
