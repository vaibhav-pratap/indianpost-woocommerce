<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
?>

<div class="wrap">
    <h1><?php esc_html_e('India Post WooCommerce Settings', 'indianpost-woocommerce'); ?></h1>
    <form method="post" action="options.php">
        <?php settings_fields('indianpost_settings_group'); ?>
        <?php do_settings_sections('indianpost-settings'); ?>
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
