<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

?>
<div class="wrap">
    <h1>India Post WooCommerce Settings</h1>
    <form method="post" action="options.php">
        <?php settings_fields('indianpost_settings_group'); ?>
        <table class="form-table">
            <tr>
                <th scope="row">Customer ID</th>
                <td><input type="text" name="indianpost_customer_id" value="<?php echo esc_attr(get_option('indianpost_customer_id')); ?>" /></td>
            </tr>
            <tr>
                <th scope="row">API Key</th>
                <td><input type="password" name="indianpost_api_key" value="<?php echo esc_attr(get_option('indianpost_api_key')); ?>" /></td>
            </tr>
        </table>
        <?php submit_button('Save Settings'); ?>
    </form>
</div>
