<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class IndianPost_Settings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    // Adds the settings page to the WordPress admin menu
    public function add_settings_page() {
        add_menu_page(
            __('India Post Settings', 'indianpost-woocommerce'), 
            __('India Post', 'indianpost-woocommerce'), 
            'manage_options', 
            'indianpost-settings', 
            [$this, 'settings_page_html'],
            'dashicons-admin-generic', 
            75
        );
    }

    // Registers settings in the WordPress database
    public function register_settings() {
        register_setting('indianpost_settings_group', 'indianpost_customer_id');
        register_setting('indianpost_settings_group', 'indianpost_api_key');
    }

    // Settings page HTML content
    public function settings_page_html() {
        ?>
        <div class="wrap">
            <h1><?php esc_html_e('India Post WooCommerce Settings', 'indianpost-woocommerce'); ?></h1>
            <form method="post" action="options.php">
                <?php settings_fields('indianpost_settings_group'); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row"><?php esc_html_e('Customer ID', 'indianpost-woocommerce'); ?></th>
                        <td><input type="text" name="indianpost_customer_id" value="<?php echo esc_attr(get_option('indianpost_customer_id')); ?>" /></td>
                    </tr>
                    <tr>
                        <th scope="row"><?php esc_html_e('API Key', 'indianpost-woocommerce'); ?></th>
                        <td><input type="password" name="indianpost_api_key" value="<?php echo esc_attr(get_option('indianpost_api_key')); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(__('Save Settings', 'indianpost-woocommerce')); ?>
            </form>
        </div>
        <?php
    }
}

// Initialize settings class
new IndianPost_Settings();
