<?php
$sourceUrl = 'https://images.unsplash.com/photo-1541534741688-6078c6bfb5c5?auto=format&fit=crop&q=80&w=2000';
$destinationPath = __DIR__ . '/storage/app/public/general/final-ummatti-logo-06.webp';

if (file_exists(dirname($destinationPath))) {
    $imgData = file_get_contents($sourceUrl);
    if ($imgData !== false) {
        file_put_contents($destinationPath, $imgData);
        echo "Image overwritten successfully!";
    } else {
        echo "Failed to fetch image.";
    }
} else {
    echo "Directory does not exist.";
}
