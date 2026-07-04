<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();
$settings = \DB::table('settings')->where('key', 'like', '%orders%')->get();
foreach($settings as $s) {
    echo $s->key . " => " . substr($s->value, 0, 100) . "\n";
}
