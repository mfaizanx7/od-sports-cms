<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
try {
    \DB::connection()->getPdo();
    echo "DB OK\n";
} catch (\Exception $e) {
    echo "DB Error: " . $e->getMessage() . "\n";
}
