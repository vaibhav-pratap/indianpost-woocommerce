<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class IndianPost_Settings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    // Adds the settings page to the WordPress Admin Menu
    public function add_settings_page() {
        add_menu_page(
            __('India Post Settings', 'indianpost-woocommerce'), 
            __('India Post', 'indianpost-woocommerce'), 
            'manage_options', 
            'indianpost-settings', 
            [$this, 'load_settings_page'],
            'dashicons-admin-generic', 
            75
        );
    }

    // Registers settings in the WordPress database
    public function register_settings() {
        register_setting('indianpost_settings_group', 'indianpost_customer_id');
        register_setting('indianpost_settings_group', 'indianpost_api_key');
    }

    // Load the settings page template
    public function load_settings_page() {
        require_once INDIANPOST_PLUGIN_DIR . 'admin/settings-page.php';
    }
}

// Ensure the class is available before initializing
if (class_exists('IndianPost_Settings')) {
    new IndianPost_Settings();
} else {
    error_log("IndianPost_Settings class is missing.");
}
