<?php
class IndianPost_API {
    private string $api_url = "https://api.cept.gov.in";
    private string $api_key;

    public function __construct() {
        $this->api_key = get_option('indianpost_api_key', '');
        add_action('woocommerce_thankyou', [$this, 'send_order_to_indianpost']);
    }

    // Send WooCommerce order details to India Post
    public function send_order_to_indianpost(int $order_id) {
        $order = wc_get_order($order_id);
        if (!$order) return;

        $data = [
            'Cust_Id' => get_option('indianpost_customer_id'),
            'Order_ID' => $order->get_id(),
            'Pincode' => $order->get_shipping_postcode(),
            'Weight' => $order->get_meta('weight'),
            'Destination' => $order->get_shipping_address_1(),
        ];

        $response = wp_remote_post("{$this->api_url}/customer/api/BulkCustomer/upload", [
            'body'    => json_encode($data),
            'headers' => [
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer ' . $this->api_key
            ]
        ]);

        if (!is_wp_error($response)) {
            $response_body = json_decode(wp_remote_retrieve_body($response), true);
            if (isset($response_body['success']) && $response_body['success']) {
                $order->update_meta_data('_indianpost_tracking_id', $response_body['tracking_id']);
                $order->save();
            }
        }
    }
}
