<?php

/**
 * Plugin Name: WP-Stateless for LearnDash LMS
 * Plugin URI: https://stateless.udx.io/addons/learndash/
 * Description: Provides compatibility between the LearnDash® LMS Plugin and the WP-Stateless plugins.
 * Author: UDX
 * Version: 0.0.1
 * Text Domain: wp-stateless-for-learndash-lms
 * Author URI: https://udx.io
 * License: GPLv2 or later
 * 
 * Copyright 2026 UDX (email: info@udx.io)
 */

namespace SLCA\LearnDash;

defined( 'ABSPATH' ) || exit;

add_action('plugins_loaded', function () {
  if (class_exists('wpCloud\StatelessMedia\Compatibility')) {
    require_once ( dirname( __FILE__ ) . '/vendor/autoload.php' );
    // Load 
    return new LearnDash();
  }

  add_filter('plugin_row_meta', function ($plugin_meta, $plugin_file, $_, $__) {
    if ( $plugin_file !== \plugin_basename(__FILE__) ) return $plugin_meta;
    $plugin_meta[] = sprintf(
      '<span style="color:red;">%s</span>',
      __('This plugin requires WP-Stateless plugin version 3.4.0 or greater to be installed and active.', 'wp-stateless-for-learndash-lms'),
    );
    return $plugin_meta;
  }, 10, 4);
});
