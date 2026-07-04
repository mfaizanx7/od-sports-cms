<?php

use Botble\Setting\Supports\SettingStore;

$teamMembers = [
    1  => ['name' => 'Imran Ghazali',    'title' => 'Founder & CEO',                         'img' => 'landing-assets/updated pics/Photos for website od sports/Imran Ghazali.png'],
    2  => ['name' => 'Aqib Mughal',      'title' => 'Director, Client Relations & Operations','img' => 'landing-assets/updated pics/Photos for website od sports/Aqib Mughal.png'],
    3  => ['name' => 'Laiba Shakeel',    'title' => 'Senior Manager, Digital',                'img' => 'landing-assets/updated pics/Photos for website od sports/Laiba Shakeel.png'],
    4  => ['name' => 'Ansab Naeem',      'title' => 'Director, Photography & Videography',   'img' => 'landing-assets/updated pics/Photos for website od sports/Ansab Ali Final.png'],
    5  => ['name' => 'Muneeb Ahmad',     'title' => 'Senior Graphic Designer',                'img' => 'landing-assets/updated pics/Photos for website od sports/Muneeb Ahmad.png'],
    6  => ['name' => 'Angelina Yousaf',  'title' => 'Social Media & Content Manager',         'img' => 'landing-assets/updated pics/Photos for website od sports/Angelina Yousaf.png'],
    7  => ['name' => 'Irtaza Hussain',   'title' => 'Manager, PR & Social Media',             'img' => 'landing-assets/updated pics/Photos for website od sports/Irtaza Hussain.png'],
    8  => ['name' => 'Faris Khan',       'title' => 'Fellowship',                             'img' => 'landing-assets/updated pics/Photos for website od sports/Faris Khan.png'],
    9  => ['name' => 'Muhammad Faizan',  'title' => 'Team Member',                            'img' => 'landing-assets/updated pics/Photos for website od sports/Muhammad Faizan.png'],
    10 => ['name' => 'Muhammad Mutahir', 'title' => 'Team Member',                            'img' => 'landing-assets/updated pics/Photos for website od sports/Muhammad Mutahir.png'],
    11 => ['name' => 'Nida Imtiaz',      'title' => 'Team Member',                            'img' => 'landing-assets/updated pics/Photos for website od sports/Nida Imtiaz (2).png'],
    12 => ['name' => 'Shaheer Ahmad',    'title' => 'Team Member',                            'img' => 'landing-assets/updated pics/Photos for website od sports/Shaheer Ahmad.png'],
    13 => ['name' => 'Sheeraz Hussain',  'title' => 'Team Member',                            'img' => 'landing-assets/updated pics/Photos for website od sports/Sheeraz Hussain.png'],
];

$theme = \Theme::getThemeName(); // shopwise
if (!$theme) {
    $theme = 'shopwise';
}

if (!function_exists('setOption')) {
    function setOption($theme, $key, $value) {
        $fullKey = 'theme-' . $theme . '-' . $key;
        setting()->set($fullKey, $value);
    }
}

// Update Homepage top 4
for ($i = 1; $i <= 4; $i++) {
    setOption($theme, 'homepage_team_'.$i.'_img', $teamMembers[$i]['img']);
    setOption($theme, 'homepage_team_'.$i.'_name', $teamMembers[$i]['name']);
    setOption($theme, 'homepage_team_'.$i.'_title', $teamMembers[$i]['title']);
}

// Update About page 15 members
for ($i = 1; $i <= 15; $i++) {
    if (isset($teamMembers[$i])) {
        setOption($theme, 'about_team_'.$i.'_img', $teamMembers[$i]['img']);
        setOption($theme, 'about_team_'.$i.'_name', $teamMembers[$i]['name']);
        setOption($theme, 'about_team_'.$i.'_role', $teamMembers[$i]['title']);
    } else {
        // clear old remaining entries if any
        setOption($theme, 'about_team_'.$i.'_img', '');
        setOption($theme, 'about_team_'.$i.'_name', '');
        setOption($theme, 'about_team_'.$i.'_role', '');
    }
}

// Update Testimonials (since they are in the folder)
setOption($theme, 'homepage_testimonial_1_img', 'landing-assets/updated pics/Photos for website od sports/Qasim Naz.jpeg');
setOption($theme, 'homepage_testimonial_1_name', 'Qasim Naz');

setOption($theme, 'homepage_testimonial_2_img', 'landing-assets/updated pics/Photos for website od sports/Brent weigner.jpeg');
setOption($theme, 'homepage_testimonial_2_name', 'Brent Weigner');

setting()->save();

echo "Team & Testimonial options updated successfully for theme $theme!\n";

