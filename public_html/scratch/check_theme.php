<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
echo "Theme Setting: " . setting('theme') . "\n";
$settings = \DB::table('settings')->where('key', 'theme')->get();
foreach($settings as $s) {
    echo $s->key . " => " . $s->value . "\n";
}
