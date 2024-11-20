<?php

use STG\controllers\blocks\banners\STG_BannerJapan;
use STG\models\STG_Blade;
use STG\models\STG_BladeDirectives;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Define Blade views path
$blade = STG_Blade::getInstance();
define('BLADE', $blade);

// Define Blade directives
$directive = new STG_BladeDirectives();
define('BLADE_DIRECTIVE', $directive);

/**
 * Recursively load PHP files from a directory and initialize classes
 *
 * @param string $directory
 * @return void
 */
function load_blocks_from_directory($directory) {
    $files = glob($directory . '/*.php');
    $subDirectories = glob($directory . '/*', GLOB_ONLYDIR);

    // Load PHP files and initialize classes
    foreach ($files as $file) {
        require_once $file;

        // Get the class name from the file path
        $className = get_class_name_from_file($file);
        if (class_exists($className)) {
            new $className();
        }
    }

    // Recursively process subdirectories
    foreach ($subDirectories as $subDir) {
        load_blocks_from_directory($subDir);
    }
}

/**
 * Get class name from a file path
 *
 * @param string $filePath
 * @return string|null
 */
function get_class_name_from_file($filePath) {
    $content = file_get_contents($filePath);
    if (preg_match('/namespace\s+([^;]+);/', $content, $namespaceMatch) &&
        preg_match('/class\s+(\w+)/', $content, $classMatch)) {
        return $namespaceMatch[1] . '\\' . $classMatch[1];
    }
    return null;
}

// Automatically load blocks from the specified directory
add_action('acf/init', function () {
    load_blocks_from_directory(__DIR__ . '/src/controllers/blocks');
});