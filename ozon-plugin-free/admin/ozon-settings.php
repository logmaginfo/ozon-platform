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

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Add a menu item for settings
add_action('admin_menu', 'ozon_add_admin_menu');

function ozon_add_admin_menu() {
    add_options_page('Ozon Plugin Settings', 'Ozon', 'manage_options', 'ozon-plugin', 'ozon_options_page');
}

// Регистрация настроек
add_action('admin_init', 'ozon_register_settings');

function ozon_register_settings() {
    register_setting('ozon_options_group', 'ozon_client_id');
    register_setting('ozon_options_group', 'ozon_api_key');

    add_settings_section(
        'ozon_settings_section',
        'Настройки Ozon',
        'ozon_settings_section_callback',
        'ozon-plugin'
    );

    add_settings_field(
        'ozon_client_id',
        'Client ID',
        'ozon_client_id_callback',
        'ozon-plugin',
        'ozon_settings_section'
    );

    add_settings_field(
        'ozon_api_key',
        'API Key',
        'ozon_api_key_callback',
        'ozon-plugin',
        'ozon_settings_section'
    );
}

function ozon_settings_section_callback() {
    echo 'Введите ваши настройки для подключения к Ozon.';
}

function ozon_client_id_callback() {
    $client_id = get_option('ozon_client_id');
    echo '<input type="text" id="ozon_client_id" name="ozon_client_id" value="' . esc_attr($client_id) . '" />';
}

function ozon_api_key_callback() {
    $api_key = get_option('ozon_api_key');
    echo '<input type="text" id="ozon_api_key" name="ozon_api_key" value="' . esc_attr($api_key) . '" />';
}

function ozon_options_page() {
    echo '<h1>Ozon Plugin Settings</h1>';
    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error('ozon_messages', 'ozon_message', 'Настройки сохранены', 'updated');
    }
    settings_errors('ozon_messages');
    
    echo '<form action="options.php" method="POST">';
    settings_fields('ozon_options_group');
    echo '<label for="ozon_client_id">Client ID</label>';
    echo '<input type="text" id="ozon_client_id" name="ozon_client_id" value="' . esc_attr(get_option('ozon_client_id')) . '" />';
    echo '<label for="ozon_api_key">API Key</label>';
    echo '<input type="text" id="ozon_api_key" name="ozon_api_key" value="' . esc_attr(get_option('ozon_api_key')) . '" />';
    submit_button('Сохранить изменения');
    echo '</form>';
}
// Регистрация настроек плагина
add_action('admin_init', 'ozon_register_settings');

function ozon_register_settings() {
// Validation function
function ozon_validate_settings($input) {
    $validated_input = [];

    if (empty($input['ozon_client_id'])) {
        add_settings_error('ozon_messages', 'empty_client_id', 'Client ID не может быть пустым!', 'error');
    } else {
        $validated_input['ozon_client_id'] = sanitize_text_field($input['ozon_client_id']);
    }

    if (empty($input['ozon_api_key'])) {
        add_settings_error('ozon_messages', 'empty_api_key', 'API Key не может быть пустым!', 'error');
    } else {
        $validated_input['ozon_api_key'] = sanitize_text_field($input['ozon_api_key']);
    }

    return $validated_input;
}
function ozon_validate_settings($input) {
    $validated_input = [];

    // Проверка Client ID
    if (empty($input['ozon_client_id'])) {
        add_settings_error('ozon_messages', 'empty_client_id', 'Client ID не может быть пустым!', 'error');
    } else {
        $validated_input['ozon_client_id'] = sanitize_text_field($input['ozon_client_id']);
    }

    // Проверка API Key
    if (empty($input['ozon_api_key'])) {
        add_settings_error('ozon_messages', 'empty_api_key', 'API Key не может быть пустым!', 'error');
    } else {
        $validated_input['ozon_api_key'] = sanitize_text_field($input['ozon_api_key']);
    }

    return $validated_input;
}
    register_setting('ozon_options_group', 'ozon_client_id');
    register_setting('ozon_options_group', 'ozon_api_key');

    add_settings_section(
        'ozon_settings_section',
        'Настройки Ozon',
        'ozon_settings_section_callback',
        'ozon-plugin'
    );

    add_settings_field(
        'ozon_client_id',
        'Client ID',
        'ozon_client_id_callback',
        'ozon-plugin',
        'ozon_settings_section'
    );

    add_settings_field(
        'ozon_api_key',
        'API Key',
        'ozon_api_key_callback',
        'ozon-plugin',
        'ozon_settings_section'
    );
}

function ozon_settings_section_callback() {
    echo 'Введите ваши настройки для подключения к Ozon.';
}

function ozon_client_id_callback() {
    $client_id = get_option('ozon_client_id');
    echo '<input type="text" id="ozon_client_id" name="ozon_client_id" value="' . esc_attr($client_id) . '" />';
}

function ozon_api_key_callback() {
    $api_key = get_option('ozon_api_key');
    echo '<input type="text" id="ozon_api_key" name="ozon_api_key" value="' . esc_attr($api_key) . '" />';
}
    // Вывод заголовка страницы
    echo '<h1>Ozon Plugin Settings</h1>';
    // Проверка и вывод ошибок
    if ( isset( $_GET['settings-updated'] ) ) {
        add_settings_error( 'ozon_messages', 'ozon_message', 'Настройки сохранены', 'updated' );
    }
    settings_errors('ozon_messages');
    
    echo '<form action="options.php" method="POST">';
    // Регистрация настроек
    settings_fields('ozon_options_group');
    
    // Вывод поля Client ID
    echo '<label for="ozon_client_id">Client ID</label>';
    echo '<input type="text" id="ozon_client_id" name="ozon_client_id" value="' . esc_attr( get_option('ozon_client_id') ) . '" />';
    
    // Вывод поля API Key
    echo '<label for="ozon_api_key">API Key</label>';
    echo '<input type="text" id="ozon_api_key" name="ozon_api_key" value="' . esc_attr( get_option('ozon_api_key') ) . '" />';
    
    submit_button('Сохранить изменения');
    echo '</form>';
    
    // Регистрация настроек
    ozon_register_settings();
function ozon_register_settings() {
    register_setting('ozon_options_group', 'ozon_client_id');
    register_setting('ozon_options_group', 'ozon_api_key');

    add_settings_section(
        'ozon_settings_section',
        'Настройки Ozon',
        'ozon_settings_section_callback',
        'ozon-plugin'
    );

    add_settings_field(
        'ozon_client_id',
        'Client ID',
        'ozon_client_id_callback',
        'ozon-plugin',
        'ozon_settings_section'
    );

    add_settings_field(
        'ozon_api_key',
        'API Key',
        'ozon_api_key_callback',
        'ozon-plugin',
        'ozon_settings_section'
    );
}

function ozon_settings_section_callback() {
    echo 'Введите ваши настройки для подключения к Ozon.';
}

function ozon_client_id_callback() {
    $client_id = get_option('ozon_client_id');
    echo '<input type="text" id="ozon_client_id" name="ozon_client_id" value="' . esc_attr($client_id) . '" />';
}

function ozon_api_key_callback() {
    $api_key = get_option('ozon_api_key');
    echo '<input type="text" id="ozon_api_key" name="ozon_api_key" value="' . esc_attr($api_key) . '" />';
}

// Регистрация функции
add_action('admin_init', 'ozon_register_settings');
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