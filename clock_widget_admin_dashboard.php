<?php

/*
Plugin Name: India Time Clock Widget for Dashboard
Plugin URI: thehimalayanyogi.buzz
Description: Displays the current time in India in the top menu of the WordPress dashboard.
Version: 1.0
Author: Shivendra Kumar
*/

function india_time_display() {
  date_default_timezone_set('Asia/Kolkata');
  $current_time = date('h:i A');
  echo '<div id="india-time">India Time: ' . $current_time . '</div>';
}
add_action('wp_before_admin_bar_render', 'india_time_display');


// CSS to add styling in showing time area
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

// Register the custom plugin menu
function custom_plugin_menu() {
  add_menu_page(
    'Custom Plugin', // Page Title
    'Custom Plugin', // Menu Title
    'manage_options', // Capability
    'custom-plugin', // Menu Slug
    'custom_plugin_settings_page', // Function
    'dashicons-clock', // Icon URL
    10 // Position
  );
}
add_action( 'admin_menu', 'custom_plugin_menu' );

// Display the welcome page
function custom_plugin_welcome_page() {
  ?>
  <h1>Welcome to the Custom Plugin</h1>
  <p>Thank you for installing our plugin! We hope it will be useful for you.</p>
  <p>To get started, you can visit the <a href="<?php echo admin_url( 'options-general.php?page=custom-plugin' ); ?>">settings page</a> and configure the plugin's options.</p>
  <?php
}

// Display the plugin's settings page
function custom_plugin_settings_page() {
  // Display the settings page header
  echo '<h1>Plugin Settings</h1>';
  ?>
  <form method="post" action="options.php">
  <?php
    // Output the settings fields and sections
    settings_fields( 'custom_plugin_options' );
    do_settings_sections( 'custom-plugin' );

    // Display the time zone select field
    ?>
    <table class="form-table">
      <tr>
        <th scope="row">Time Zone</th>
        <td>
          <select name="custom_plugin_time_zone" id="custom_plugin_time_zone">
            <?php
              $current_time_zone = get_option( 'custom_plugin_time_zone', 'UTC' );
              $time_zones = timezone_identifiers_list();
              foreach ( $time_zones as $time_zone ) {
                $selected = ( $time_zone == $current_time_zone ) ? 'selected' : '';
                echo '<option value="' . $time_zone . '" ' . $selected . '>' . $time_zone . '</option>';
              }
            ?>
          </select>
        </td>
      </tr>
    </table>
    <?php
    // Display the "Save Changes" button
    submit_button();
  ?>
  </form>
  <?php
}

// Register the plugin's settings

function custom_plugin_register_settings() {
  register_setting( 'custom_plugin_options', 'custom_plugin_time_zone', 'sanitize_text_field' );
  add_settings_field( 'custom_plugin_time_zone', 'Time Zone', 'custom_plugin_time_zone_field', 'custom-plugin', 'custom_plugin_settings_section' );
}
add_action( 'admin_init', 'custom_plugin_register_settings' );

function custom_plugin_time_zone_field() {
  $current_time_zone = get_option( 'custom_plugin_time_zone', 'UTC' );
  ?>
  <select name="custom_plugin_time_zone" id="custom_plugin_time_zone">
    <?php
      $time_zones = timezone_identifiers_list();
      foreach ( $time_zones as $time_zone ) {
        $selected = ( $time_zone == $current_time_zone ) ? 'selected' : '';
        echo '<option value="' . $time_zone . '" ' . $selected . '>' . $time_zone . '</option>';
      }
    ?>
  </select>
  <?php
}





?>