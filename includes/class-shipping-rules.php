<?php
class IndianPost_Shipping_Rules {
    public function __construct() {
        add_filter('woocommerce_package_rates', [$this, 'calculate_custom_shipping_rates'], 10, 2);
    }

    public function calculate_custom_shipping_rates($rates, $package) {
        $destination_pincode = $package['destination']['postcode'];
        $cart_weight = WC()->cart->get_cart_contents_weight();
        $category_shipping_fee = $this->get_category_shipping_fee();

        // Apply weight-based rule
        $weight_fee = 0;
        if ($cart_weight > 10) {
            $weight_fee = 100;
        } elseif ($cart_weight > 5) {
            $weight_fee = 50;
        }

        // Apply Pincode-based rule
        $pincode_fee = ($this->is_remote_pincode($destination_pincode)) ? 75 : 0;

        // Calculate total shipping cost
        $total_shipping_cost = 50 + $weight_fee + $pincode_fee + $category_shipping_fee;

        // Add custom shipping method
        $rates['indianpost_shipping'] = [
            'label' => "India Post Custom Shipping",
            'cost'  => $total_shipping_cost
        ];

        return $rates;
    }

    private function is_remote_pincode($pincode) {
        $remote_pincodes = ['123456', '987654']; // Example remote pincodes
        return in_array($pincode, $remote_pincodes);
    }

    private function get_category_shipping_fee() {
        $fee = 0;
        foreach (WC()->cart->get_cart() as $cart_item) {
            $product = $cart_item['data'];
            $categories = wp_get_post_terms($product->get_id(), 'product_cat', ['fields' => 'names']);
            if (in_array('Fragile', $categories)) {
                $fee += 30;
            }
        }
        return $fee;
    }
}
