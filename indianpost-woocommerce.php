<?php
/**
 * Plugin Name:       IndianPost WooCommerce Integration
 * Plugin URI:        https://exiverlabs.co.in
 * Description:       Integrates India Post with WooCommerce for shipping, tracking, and tariff calculation.
 * Version:           1.0.1
 * Requires PHP:      8.0
 * Requires at least: 6.0
 * Tested up to:      6.5
 * Author:            Vaibhav Singh
 * Author URI:        https://exiverlabs.co.in
 * License:           GPL2
 * Text Domain:       indianpost-woocommerce
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Check if WooCommerce is installed and activated
function indianpost_check_woocommerce() {
    if (!class_exists('WooCommerce')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die(
            __('This plugin requires WooCommerce to be installed and activated.', 'indianpost-woocommerce'),
            __('Plugin Activation Error', 'indianpost-woocommerce'),
            ['back_link' => true]
        );
    }
}
register_activation_hook(__FILE__, 'indianpost_check_woocommerce');

// Define plugin constants
define('INDIANPOST_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('INDIANPOST_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
$includes = [
    'class-indianpost-api.php',
    'class-webhook-handler.php',
    'class-settings.php',
    'class-order-handler.php',
    'class-tariff-api.php',
    'class-pincode-validation.php',
    'class-tracking-page.php',
    'class-logger.php',
    'class-shipping-rules.php'
];

foreach ($includes as $file) {
    $path = INDIANPOST_PLUGIN_DIR . 'includes/' . $file;
    if (file_exists($path)) {
        require_once $path;
    } else {
        error_log("Missing file: $path");
    }
}

// Initialize Plugin
function indianpost_woocommerce_init() {
    try {
        new IndianPost_API();
        new IndianPost_Webhook_Handler();
        new IndianPost_Settings();
        new IndianPost_Order_Handler();
        new IndianPost_Tariff_API();
        new IndianPost_Pincode_Validation();
        new IndianPost_Tracking_Page();
        new IndianPost_Shipping_Rules();
    } catch (Exception $e) {
        IndianPost_Logger::log("Plugin Initialization Error: " . $e->getMessage());
    }
}
add_action('plugins_loaded', 'indianpost_woocommerce_init');