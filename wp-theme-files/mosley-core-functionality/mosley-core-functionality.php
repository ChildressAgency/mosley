<?php
/**
 * Plugin Name: mosleyenvironmental.com Core functionality
 * Description: This contains all your site's core functionality so that it is theme independent. <strong>It should always be activated.</strong>
 * Author: Childress Agency
 * Author URI: https://childressagency.com
 * Version: 1.0
 * Text Domain: mosley
 */
if(!defined('ABSPATH')){ exit; }

define('MOSLEY_PLUGIN_DIR', dirname(__FILE__));
define('MOSLEY_PLUGIN_URL', plugin_dir_url(__FILE__));

/**
 * Load ACF if not already loaded
 */
if(!class_exists('acf')){
  require_once MOSLEY_PLUGIN_DIR . '/vendors/advanced-custom-fields-pro/acf.php';
  add_filter('acf/settings/path', 'mosley_acf_settings_path');
  add_filter('acf/settings/dir', 'mosley_acf_settings_dir');
}

function mosley_acf_settings_path($path){
  $path = plugin_dir_path(__FILE__) . 'vendors/advanced-custom-fields-pro/';
  return $path;
}

function mosley_acf_settings_dir($dir){
  $dir = plugin_dir_url(__FILE__) . 'vendors/advanced-custom-fields-pro/';
  return $dir;
}

add_action('plugins_loaded', 'mosley_load_textdomain');
function mosley_load_textdomain(){
  load_plugin_textdomain('mosley', false, basename(MOSLEY_PLUGIN_DIR) . '/languages');
}

