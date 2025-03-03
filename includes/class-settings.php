<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class IndianPost_Settings {
    public function __construct() {
        // Add settings to WooCommerce > Settings > Shipping
        add_filter('woocommerce_get_sections_shipping', [$this, 'add_shipping_section']);
        add_filter('woocommerce_get_settings_shipping', [$this, 'add_shipping_settings'], 10, 2);

        // Add separate admin page
        add_action('admin_menu', [$this, 'add_settings_page']);
    }

    // Adds a new section under WooCommerce > Settings > Shipping
    public function add_shipping_section($sections) {
        $sections['indianpost'] = __('India Post API', 'indianpost-woocommerce');
        return $sections;
    }

    // Adds settings fields under the new India Post API section
    public function add_shipping_settings($settings, $current_section) {
        if ($current_section === 'indianpost') {
            $settings = [
                [
                    'title' => __('India Post WooCommerce Settings', 'indianpost-woocommerce'),
                    'type'  => 'title',
                    'desc'  => __('Configure India Post API settings.', 'indianpost-woocommerce'),
                    'id'    => 'indianpost_settings_title',
                ],
                [
                    'title'    => __('Customer ID', 'indianpost-woocommerce'),
                    'type'     => 'text',
                    'desc'     => __('Enter your India Post Customer ID.', 'indianpost-woocommerce'),
                    'id'       => 'indianpost_customer_id',
                    'default'  => '',
                    'desc_tip' => true,
                ],
                [
                    'title'    => __('API Key', 'indianpost-woocommerce'),
                    'type'     => 'password',
                    'desc'     => __('Enter your India Post API Key.', 'indianpost-woocommerce'),
                    'id'       => 'indianpost_api_key',
                    'default'  => '',
                    'desc_tip' => true,
                ],
                [
                    'type' => 'sectionend',
                    'id'   => 'indianpost_settings_end',
                ],
            ];
        }
        return $settings;
    }
}

// Initialize class
if (class_exists('IndianPost_Settings')) {
    new IndianPost_Settings();
} else {
    error_log("IndianPost_Settings class is missing.");
}
