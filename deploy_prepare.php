<?php
/**
 * Laravel POS Deployment Preparation Script
 * Run this script locally before uploading to server
 */

echo "🚀 Preparing Laravel POS for Production Deployment\n";
echo "===============================================\n\n";

// Step 1: Check Laravel version and requirements
echo "1️⃣ Checking Laravel Configuration...\n";
system('php artisan --version');
echo "\n";

// Step 2: Clear and optimize caches
echo "2️⃣ Clearing Development Caches...\n";
$commands = [
    'php artisan config:clear',
    'php artisan route:clear', 
    'php artisan view:clear',
    'php artisan cache:clear',
    'php artisan queue:clear',
];

foreach ($commands as $command) {
    echo "   Running: $command\n";
    system($command);
}
echo "\n";

// Step 3: Optimize for production
echo "3️⃣ Optimizing for Production...\n";
$optimizeCommands = [
    'php artisan config:cache',
    'php artisan route:cache',
    'php artisan view:cache',
];

foreach ($optimizeCommands as $command) {
    echo "   Running: $command\n";
    system($command);
}
echo "\n";

// Step 4: Check database connection
echo "4️⃣ Testing Database Connection...\n";
try {
    system('php artisan migrate:status');
    echo "   ✅ Database connection OK\n";
} catch (Exception $e) {
    echo "   ❌ Database connection failed: " . $e->getMessage() . "\n";
}
echo "\n";

// Step 5: Generate production files list
echo "5️⃣ Files to Upload to Server:\n";
$filesToUpload = [
    '✅ app/ (entire folder)',
    '✅ bootstrap/ (entire folder)', 
    '✅ config/ (entire folder)',
    '✅ database/ (entire folder)',
    '✅ public/ (entire folder)',
    '✅ resources/ (entire folder)',
    '✅ routes/ (entire folder)',
    '✅ storage/app/ (create empty)',
    '✅ storage/framework/ (create empty)',
    '✅ storage/logs/ (create empty)',
    '✅ vendor/ (entire folder)',
    '✅ .env (rename from .env.production)',
    '✅ artisan',
    '✅ composer.json',
    '✅ composer.lock',
];

foreach ($filesToUpload as $file) {
    echo "   $file\n";
}
echo "\n";

// Step 6: Files NOT to upload
echo "6️⃣ Files NOT to Upload:\n";
$filesToSkip = [
    '❌ .env (your local environment file)',
    '❌ .git/ (git repository)',
    '❌ node_modules/ (if exists)',
    '❌ storage/logs/*.log (log files)',
    '❌ tests/ (testing files)',
    '❌ .phpunit.result.cache',
    '❌ Homestead.json, Homestead.yaml',
];

foreach ($filesToSkip as $file) {
    echo "   $file\n";
}
echo "\n";

echo "✅ Preparation Complete!\n";
echo "📋 Next Steps:\n";
echo "   1. Copy .env.production to your server as .env\n";
echo "   2. Update database credentials in server .env\n";
echo "   3. Upload files to server\n";
echo "   4. Set proper file permissions\n";
echo "   5. Run: php artisan migrate\n";
echo "   6. Run: php artisan db:seed (if needed)\n\n";

?>