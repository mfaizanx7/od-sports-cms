<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

try {
    $settings = \DB::table('settings')->where('value', 'like', '%Test Value%')->get();
    foreach ($settings as $setting) {
        echo "Key: " . $setting->key . " | Value: " . $setting->value . "\n";
    }
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
