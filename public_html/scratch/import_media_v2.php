<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Force GD driver for image processing
config(['image.driver' => 'gd']);
config(['core.media.media.driver' => 'gd']);

// Create folder in DB if it doesn't exist
$folder = \Botble\Media\Models\MediaFolder::firstOrCreate([
    'name' => 'Portfolio',
    'slug' => 'portfolio',
    'parent_id' => 0,
]);

$imagesToImport = [
    'marathon_race_day.png' => 'homepage_portfolio_1_img',
    'kids_running.png' => 'homepage_portfolio_2_img',
    'trail_runner.png' => 'homepage_portfolio_3_img',
];

$sourceDir = 'e:/public_html/public/landing-assets/images/';

foreach ($imagesToImport as $filename => $themeKey) {
    $path = $sourceDir . $filename;
    if (file_exists($path)) {
        // Upload the file through RvMedia to generate thumbnails and DB records
        $result = \RvMedia::uploadFromPath($path, $folder->id);
        
        if (!$result['error']) {
            $mediaFile = $result['data'];
            // Update the theme option with the new media file path
            \DB::table('settings')->where('key', 'theme-shopwise-' . $themeKey)->update(['value' => $mediaFile->url]);
            echo "Successfully imported $filename and updated $themeKey.\n";
        } else {
            echo "Failed to import $filename: " . $result['message'] . "\n";
        }
    } else {
        echo "File not found: $path\n";
    }
}

// Clear config cache
\Artisan::call('config:cache');
