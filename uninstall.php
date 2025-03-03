<?php
if (!defined('WP_UNINSTALL_PLUGIN')) {
    exit;
}

// Delete options
delete_option('indianpost_customer_id');
delete_option('indianpost_api_key');

// Remove logs if exist
$log_file = plugin_dir_path(__FILE__) . 'logs/indianpost.log';
if (file_exists($log_file)) {
    unlink($log_file);
}
