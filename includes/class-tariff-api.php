<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class IndianPost_Tariff_API {
    private string $api_url = "https://api.cept.gov.in/tariff/api/values/gettariff";

    public function get_shipping_tariff($service, $source_pincode, $destination_pincode, $weight) {
        $body = json_encode([
            'service' => $service,
            'sourcepin' => $source_pincode,
            'destinationpin' => $destination_pincode,
            'weight' => $weight,
            'length' => 10,
            'breadth' => 10,
            'height' => 10
        ]);

        $response = wp_remote_post($this->api_url, [
            'body'    => $body,
            'headers' => ['Content-Type' => 'application/json']
        ]);

        if (is_wp_error($response)) {
            error_log("Tariff API Error: " . $response->get_error_message());
            return false;
        }
        
        $data = json_decode(wp_remote_retrieve_body($response), true);
        return $data[0] ?? false;
    }
}

// Ensure the class is available before instantiating
if (class_exists('IndianPost_Tariff_API')) {
    new IndianPost_Tariff_API();
} else {
    error_log("IndianPost_Tariff_API class is missing.");
}
