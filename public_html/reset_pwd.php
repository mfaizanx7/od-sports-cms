<?php
require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$user = Botble\ACL\Models\User::first();
if($user) {
    echo "Found user: " . $user->email . "\n";
    $user->password = bcrypt('159357');
    $user->save();
    echo "Password reset to: 159357\n";
} else {
    echo "No users found in the database. You might need to run migrations/seeders.\n";
}
