<?php
/**
 * Plugin Name: Cyan Plugin
 * Plugin URI:  https://example.com/cyan-plugin
 * Description: A plugin to manage cyan custom theme
 * Version:     1.0
 * Author:      Amir Tanazzoh
 * Author URI:  https://cyandm.com
 * License:     GPL2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load Composer autoload
require_once plugin_dir_path( __FILE__ ) . 'vendor/autoload.php';

// Define constant paths
define( 'CYAN_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'CYAN_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CYAN_PLUGIN_ASSETS', CYAN_PLUGIN_URL . 'assets/' );
define( 'CYAN_PLUGIN_TEMPLATES', CYAN_PLUGIN_PATH . 'templates/' );

// Define constant deploy
define( 'CYAN_PLUGIN_VERSION', '1.0' );
define( 'CYAN_PLUGIN_DEPLOY', false );

// Use the Init class to start the plugin
if ( class_exists( 'CyanPlugin\Core\Init' ) ) {
	CyanPlugin\Core\Init::register_services();
}