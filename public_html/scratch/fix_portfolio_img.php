<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $value = "https://images.unsplash.com/photo-1513594247994-1e563a365ef1?auto=format&fit=crop&q=80&w=600";
    
    if (function_exists('theme_option')) {
        theme_option()->setOption('homepage_portfolio_2_img', $value);
        theme_option()->saveOptions();
        echo "Successfully updated homepage_portfolio_2_img via theme_option helper.\n";
    } else {
        echo "theme_option helper not found.\n";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
