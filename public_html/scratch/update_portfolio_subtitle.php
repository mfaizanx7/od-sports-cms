<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$key = 'theme-shopwise-homepage_portfolio_subtitle';
$text = "We've been behind some of Pakistan's biggest sports moments. Here's a taste of what we've built.";

\DB::table('settings')->where('key', $key)->update(['value' => $text]);
echo "Reverted: " . $text . "\n";
