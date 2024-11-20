<?php
/**
 * @package Studio STG Gutenberg Blocks
 * @author Studio STG
 * @version 1.0.0
 *
 * Plugin Name: Studio STG Gutenberg Blocks
 * Plugin URI: https://studiostg.com.br/studio-stg-gutenberg-blocks
 * Description: Plugin de blocos personalizados para o editor de bloco do WordPress.
 * Version: 1.0.0
 * Requires at least: 6.0
 * Requires PHP: 8.2
 * Author: Studio STG
 * Author URI: https://studiostg.com.br/
 * Text Domain: studio-stg-gutenberg-blocks
 * Domain Path: /languages
 *
 */

 use Jenssegers\Blade\Blade;

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Check if Composer dependencies are available
if (!file_exists($composer = __DIR__ . '/vendor/autoload.php')) {
    error_log('STG Error: Composer dependencies not found. Please run `composer install` in plugin.');

    add_action('admin_notices', function() {
        echo wp_kses_post(sprintf(
            '<div class="notice notice-error"><p>%s</p><p>%s</p></div>',
            'O plugin Studio STG Gutenberg Blocks não pôde ser iniciado porque as dependências do Composer não foram encontradas.',
            'Por favor, execute <code>composer install</code> na pasta do plugin ou entre em contato com o desenvolvedor.'
        ));
    });

    add_action('admin_init', function() {
        deactivate_plugins(plugin_basename(__FILE__));

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
    });

    return;
}

// Check if ACF PRO plugin is active
if (!class_exists('ACF') || !function_exists('acf_get_field_groups')) {
    error_log('STG Error: ACF PRO plugin is required but not activated.');

    add_action('admin_notices', function() {
        echo wp_kses_post(sprintf(
            '<div class="notice notice-error"><p>%s</p><p>%s</p></div>',
            'O plugin Studio STG Gutenberg Blocks requer o plugin Advanced Custom Fields PRO ativo.',
            'Por favor, ative o plugin ACF PRO ou entre em contato com o desenvolvedor.'
        ));
    });

    add_action('admin_init', function() {
        deactivate_plugins(plugin_basename(__FILE__));

        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
    });

    return;
}

// load Composer dependencies
require_once $composer;

// Define constants
define('STG_VERSION', '1.0.0');
define('STG_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('STG_PLUGIN_URL', plugin_dir_url(__FILE__));
define('STG_PLUGIN_BASE', plugin_basename(__FILE__));

// Initialize Setup Plugin
require_once STG_PLUGIN_DIR . 'setup.php';
