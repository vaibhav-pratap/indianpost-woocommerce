<?php
class IndianPost_Order_Handler {
    public function __construct() {
        add_action('woocommerce_order_status_completed', [$this, 'send_order_to_indianpost']);
    }

    public function send_order_to_indianpost($order_id) {
        $indianpost_api = new IndianPost_API();
        $indianpost_api->send_order_to_indianpost($order_id);
    }
}
