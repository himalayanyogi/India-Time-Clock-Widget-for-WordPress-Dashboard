<?php

/*
Plugin Name: India Time Clock Widget for Dashboard
Plugin URI: thehimalayanyogi.buzz
Description: Displays the current time in India in the top menu of the WordPress dashboard.
Version: 1.0
Author: Shivendra Kumar
*/

// Pin plugin to the left menu bar in wordpress admin panel
function custom_plugin_menu() {
  add_menu_page(
    'India Time Clock', // Page Title
    'India Time Clock', // Menu Title
    'manage_options', // Capability
    'custom-plugin', // Menu Slug
    'custom_plugin_settings_page', // Function
    'dashicons-clock', // Icon URL
    10 // Position
  );
}
add_action( 'admin_menu', 'custom_plugin_menu' );


function india_time_display() {
  date_default_timezone_set('Asia/Kolkata');
  $current_time = date('h:i A');
  echo '<div id="india-time">India Time: ' . $current_time . '</div>';
}
add_action('wp_before_admin_bar_render', 'india_time_display');

function india_time_css() {
  echo '<style>
  #india-time {
    color: #fff;
    background-color: #0073aa;
    padding: 6px 10px;
    font-size: 12px;
    position: absolute;
    left: 50%;
    margin-left: -50px;
    top: 8px;
  }
  </style>';
}
add_action('admin_head', 'india_time_css');





?>
<p>this is a test for github</p>