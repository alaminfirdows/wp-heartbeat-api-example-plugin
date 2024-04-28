<?php

/*
Plugin Name: Heartbeat API
Description: A simple example plugin using the Heartbeat API
Version: 1.0
Author: WP Admin
*/

add_action('init', function () {
    wp_enqueue_script('heartbeat');

    wp_enqueue_script(
        'heartbeat-api-js',
        plugin_dir_url(__FILE__) . 'heartbeat-api.js',
        ['jquery', 'heartbeat'], // Dependencies
        time(), // Version
        true // Load in footer
    );
});

// Create an admin menu page for the chat
add_action('admin_menu', function () {
    add_menu_page(
        'Heartbeat API',
        'Heartbeat API',
        'manage_options',
        'heartbeat-api',
        function () {
            include __DIR__ . '/views/index.php';
        }
    );
});

function hapi_heartbeat_received($response, $data)
{
    if ($data['message'] ?? false) {
        $response['message'] = $data['message'];
        $response['status'] = 'success';
    }

    return $response;
}
add_filter('heartbeat_received', 'hapi_heartbeat_received', 10, 2); // For logged in users
add_filter('heartbeat_nopriv_received', 'hapi_heartbeat_received', 10, 2); // For non-logged in users
