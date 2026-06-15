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
    // Checking and outputting messages
    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error( 'ozon_messages', 'ozon_message', 'Настройки сохранены', 'updated' );
    }
    settings_errors('ozon_messages');
    
    echo '<form action="options.php" method="POST">';
    // Register the settings
    settings_fields('ozon_options_group');
    
    // Client ID field
    echo '<label for="ozon_client_id">Client ID</label>';
    echo '<input type="text" id="ozon_client_id" name="ozon_client_id" value="' . esc_attr( get_option('ozon_client_id') ) . '" />';
    
    // API Key field
    echo '<label for="ozon_api_key">API Key</label>';
    echo '<input type="text" id="ozon_api_key" name="ozon_api_key" value="' . esc_attr( get_option('ozon_api_key') ) . '" />';
    
    submit_button('Сохранить изменения');
    echo '</form>';}