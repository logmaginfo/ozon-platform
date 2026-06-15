<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add a menu item for settings
add_action('admin_menu', 'ozon_add_admin_menu');

function ozon_add_admin_menu() {
    add_options_page('Ozon Plugin Settings', 'Ozon', 'manage_options', 'ozon-plugin', 'ozon_options_page');
}

function ozon_options_page() {
    // Output the settings page
    echo '<h1>Ozon Plugin Settings</h1>';
    // Add form inputs for Client ID and API Key
    echo '<form action="options.php" method="POST">';
    settings_fields('ozon_options_group');
    do_settings_sections('ozon-plugin');
    submit_button();
    echo '</form>';
}