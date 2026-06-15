<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Ozon_Client {
    private $client_id;
    private $api_key;

    public function __construct($client_id, $api_key) {
        $this->client_id = $client_id;
        $this->api_key = $api_key;
    }

    public function check_connection() {
        // Implement logic to check connection with Ozon API
        return true; // Return true if connection is successful
    }
}