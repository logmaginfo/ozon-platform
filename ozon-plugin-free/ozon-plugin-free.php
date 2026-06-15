<?php
/*
Plugin Name: Ozon for WooCommerce
Plugin URI: https://example.com
Description: A plugin to connect WooCommerce to Ozon Seller API.
Version: 1.0.0
Author: Your Name
Author URI: https://example.com
License: GPL2
*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Include dependencies
require_once plugin_dir_path( __FILE__ ) . 'includes/ozon-settings.php';
require_once plugin_dir_path( __FILE__ ) . 'includes/ozon-client.php';

// Activation hook
function ozon_plugin_activate() {
    // Code to run on plugin activation
}
register_activation_hook( __FILE__, 'ozon_plugin_activate' );

// Initialization
function ozon_plugin_init() {
    // Initialization code
}
add_action( 'plugins_loaded', 'ozon_plugin_init' );
