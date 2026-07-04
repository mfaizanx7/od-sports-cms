<?php
include 'vendor/autoload.php';
$app = include_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// 1. Update settings table
$updates = [
    'theme-shopwise-homepage_portfolio_1_img' => 'portfolio/marathon_race_day.png',
    'theme-shopwise-homepage_portfolio_2_img' => 'portfolio/kids_running.png',
    'theme-shopwise-homepage_portfolio_3_img' => 'portfolio/trail_runner.png',
];

foreach ($updates as $key => $value) {
    \DB::table('settings')->where('key', $key)->update(['value' => $value]);
}

// 2. Update edit.blade.php
$editFile = 'e:/public_html/resources/views/admin/website-content/edit.blade.php';
$content = file_get_contents($editFile);
$content = str_replace('landing-assets/images/marathon_race_day.png', 'portfolio/marathon_race_day.png', $content);
$content = str_replace('landing-assets/images/kids_running.png', 'portfolio/kids_running.png', $content);
$content = str_replace('landing-assets/images/trail_runner.png', 'portfolio/trail_runner.png', $content);
file_put_contents($editFile, $content);

// 3. Update WebsiteContentController.php
$controllerFile = 'e:/public_html/app/Http/Controllers/Admin/WebsiteContentController.php';
$content = file_get_contents($controllerFile);
$content = str_replace('landing-assets/images/marathon_race_day.png', 'portfolio/marathon_race_day.png', $content);
$content = str_replace('landing-assets/images/kids_running.png', 'portfolio/kids_running.png', $content);
$content = str_replace('landing-assets/images/trail_runner.png', 'portfolio/trail_runner.png', $content);
file_put_contents($controllerFile, $content);

// 4. Update index.blade.php to use RvMedia::getImageUrl()
$indexFile = 'e:/public_html/resources/views/home/index.blade.php';
$content = file_get_contents($indexFile);

// For portfolio images which I incorrectly wrapped with asset()
$content = preg_replace('/asset\(theme_option\(\'([^\']+)\', \'([^\']+)\'\)\)/', 'RvMedia::getImageUrl(theme_option(\'$1\', \'$2\'))', $content);

// For all other image tags that just have theme_option
$content = preg_replace_callback('/<img src="\{!! theme_option\(\'([^\']+)\', \'([^\']+)\'\) !!\}"/i', function($matches) {
    return '<img src="{!! RvMedia::getImageUrl(theme_option(\'' . $matches[1] . '\', \'' . $matches[2] . '\')) !!}"';
}, $content);

// For background images in inline styles
$content = preg_replace_callback('/background-image: url\(\'\{!! theme_option\(\'([^\']+)\', \'([^\']+)\'\) !!\}\'\)/i', function($matches) {
    return 'background-image: url(\'{!! RvMedia::getImageUrl(theme_option(\'' . $matches[1] . '\', \'' . $matches[2] . '\')) !!}\')';
}, $content);

file_put_contents($indexFile, $content);

echo "Done fixing image URLs!\n";
