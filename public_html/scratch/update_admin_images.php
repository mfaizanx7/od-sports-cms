<?php

$file = 'e:/public_html/resources/views/admin/website-content/edit.blade.php';
$content = file_get_contents($file);

// Replace any input type="text" for image URLs with Form::mediaImage
$content = preg_replace_callback(
    '/<input type="text" name="([^"]+)" (?:placeholder="[^"]*" )?class="form-control" value="\{\{ old\(\'\1\', theme_option\(\'([^\']+)\', \'([^\']+)\'\)\) \}\}">/i',
    function($matches) {
        $name = $matches[1];
        $theme_key = $matches[2];
        $default = $matches[3];
        
        // Only replace if name contains img, bg, logo, favicon
        if (preg_match('/(img|bg|logo|favicon)/i', $name)) {
            // Also need to make sure single quotes in default are escaped or handled, but since it's just URLs mostly it's fine.
            return '{!! Form::mediaImage(\'' . $name . '\', old(\'' . $name . '\', theme_option(\'' . $theme_key . '\', \'' . $default . '\'))) !!}';
        }
        return $matches[0];
    },
    $content
);

file_put_contents($file, $content);
echo "Replaced image inputs!\n";

