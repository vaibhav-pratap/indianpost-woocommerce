<?php
class IndianPost_Pincode_Validation {
    private string $api_url = "https://api.cept.gov.in/CommonFacilityMaster/api/values/Fetch_Facility";

    public function validate_pincode($pincode) {
        $body = json_encode(['Input_Pincode' => $pincode]);

        $response = wp_remote_post($this->api_url, [
            'body'    => $body,
            'headers' => ['Content-Type' => 'application/json']
        ]);

        $data = json_decode(wp_remote_retrieve_body($response), true);
        return $data[0]['Validation Status'] === "Valid Pincode" ? true : false;
    }
}
