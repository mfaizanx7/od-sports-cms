<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo RvMedia::getImageUrl('portfolio/kids_running.png', 'thumb', false, RvMedia::getDefaultImage()) . "\n";
echo "Theme Option: " . theme_option('homepage_portfolio_2_img', 'default') . "\n";

// Let's render the component!
echo \Form::mediaImage('portfolio_2_img', theme_option('homepage_portfolio_2_img', 'portfolio/kids_running.png'));
