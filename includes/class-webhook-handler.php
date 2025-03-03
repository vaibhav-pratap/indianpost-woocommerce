<?php
class IndianPost_Webhook_Handler {
    public function __construct() {
        add_action('rest_api_init', [$this, 'register_webhook_endpoint']);
    }

    public function register_webhook_endpoint() {
        register_rest_route('indianpost/v1', '/tracking', [
            'methods'  => 'POST',
            'callback' => [$this, 'handle_webhook'],
            'permission_callback' => '__return_true',
        ]);
    }

    public function handle_webhook(WP_REST_Request $request) {
        $data = $request->get_json_params();

        if (empty($data['tracking_id']) || empty($data['status'])) {
            return new WP_REST_Response(['error' => 'Invalid Data'], 400);
        }

        $orders = wc_get_orders(['meta_key' => '_indianpost_tracking_id', 'meta_value' => $data['tracking_id']]);
        if ($orders) {
            $order = reset($orders);
            $order->update_status($this->map_status($data['status']));
            $order->save();
        }

        return new WP_REST_Response(['message' => 'Tracking Updated'], 200);
    }

    private function map_status(string $status): string {
        $status_map = [
            'ITEM_BOOK' => 'processing',
            'ITEM_DELIVERY' => 'completed',
            'ITEM_NONDELIVER' => 'failed',
            'ITEM_RETURN' => 'refunded'
        ];
        return $status_map[$status] ?? 'on-hold';
    }
}
