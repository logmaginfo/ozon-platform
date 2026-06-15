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
        // Проверка соединения с Ozon API
        $response = wp_remote_get('https://api.ozon.ru/v1/check_connection', array(
            'headers' => array(
                'Client-ID' => $this->client_id,
                'API-Key' => $this->api_key,
            )
        ));
        if (is_wp_error($response)) {
            error_log('Ozon API connection error: ' . $response->get_error_message());
            return false;
        }
        return true;
    }
}