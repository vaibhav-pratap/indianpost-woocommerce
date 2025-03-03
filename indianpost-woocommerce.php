<?php
/**
 * Plugin Name:       IndianPost WooCommerce Integration
 * Plugin URI:        https://exiverlabs.co.in
 * Description:       Integrates India Post services with WooCommerce for order booking, tracking, and tariff calculation.
 * Version:           1.0.0
 * Requires PHP:      8.0
 * Requires at least: 6.0
 * Author:            Vaibhav Singh
 * Author URI:        https://exiverlabs.co.in
 * License:           GPL2
 * Text Domain:       indianpost-woocommerce
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Define constants
define('INDIANPOST_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('INDIANPOST_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include required files
require_once INDIANPOST_PLUGIN_DIR . 'includes/class-indianpost-api.php';
require_once INDIANPOST_PLUGIN_DIR . 'includes/class-webhook-handler.php';
require_once INDIANPOST_PLUGIN_DIR . 'includes/class-settings.php';
require_once INDIANPOST_PLUGIN_DIR . 'includes/class-order-handler.php';
require_once INDIANPOST_PLUGIN_DIR . 'includes/class-tariff-api.php';
require_once INDIANPOST_PLUGIN_DIR . 'includes/class-pincode-validation.php';
require_once INDIANPOST_PLUGIN_DIR . 'includes/class-tracking-page.php';
require_once INDIANPOST_PLUGIN_DIR . 'includes/class-logger.php';
require_once INDIANPOST_PLUGIN_DIR . 'includes/class-shipping-rules.php';

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
