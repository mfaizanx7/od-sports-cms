<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $value = "From grassroots tournaments to national championships, OD Sports is Pakistan’s most trusted sports agency delivering end-to-end planning, production, and promotion for every sport, every scale and every stage.";
    
    // Attempt to update the theme option directly using Botble's theme_option helper if available,
    // or manually updating the settings table.
    
    if (function_exists('theme_option')) {
        theme_option()->setOption('homepage_description', $value);
        theme_option()->saveOptions();
        echo "Successfully updated homepage_description via theme_option helper.\n";
    } else {
        echo "theme_option helper not found. You may need to update it in the Admin Panel.\n";
    }

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
