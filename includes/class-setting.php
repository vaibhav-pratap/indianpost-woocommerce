<?php
class IndianPost_Settings {
    public function __construct() {
        add_action('admin_menu', [$this, 'add_settings_page']);
        add_action('admin_init', [$this, 'register_settings']);
    }

    public function add_settings_page() {
        add_menu_page(
            'India Post Settings', 
            'India Post', 
            'manage_options', 
            'indianpost-settings', 
            [$this, 'settings_page_html']
        );
    }

    public function register_settings() {
        register_setting('indianpost_settings_group', 'indianpost_customer_id');
        register_setting('indianpost_settings_group', 'indianpost_api_key');
    }

    public function settings_page_html() {
        ?>
        <div class="wrap">
            <h1>India Post WooCommerce Integration</h1>
            <form method="post" action="options.php">
                <?php settings_fields('indianpost_settings_group'); ?>
                <table class="form-table">
                    <tr>
                        <th scope="row">Customer ID</th>
                        <td><input type="text" name="indianpost_customer_id" value="<?php echo get_option('indianpost_customer_id'); ?>" /></td>
                    </tr>
                    <tr>
                        <th scope="row">API Key</th>
                        <td><input type="text" name="indianpost_api_key" value="<?php echo get_option('indianpost_api_key'); ?>" /></td>
                    </tr>
                </table>
                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }
}
