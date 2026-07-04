<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    // Using a different, verified Unsplash image
    $new_url = "https://images.unsplash.com/photo-1517649763962-0c623066013b?auto=format&fit=crop&q=80&w=800";
    
    if (function_exists('theme_option')) {
        theme_option()->setOption('homepage_portfolio_2_img', $new_url);
        theme_option()->saveOptions();
        echo "Successfully updated homepage_portfolio_2_img to: $new_url\n";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
