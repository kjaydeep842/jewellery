<?php
$files = glob('public/js/*.js');
foreach ($files as $file) {
    if (basename($file) !== 'app.js' && basename($file) !== 'bootstrap.js') { // Keep bootstrap.js if it exists
        unlink($file);
        echo "Deleted: " . $file . "\n";
    }
}
