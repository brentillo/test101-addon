<?php
/**
 * @package TEST101
 */
/*
Plugin Name: TEST101 Addons
Plugin URI: http://robinsonrentillo.com/
Description: Shortcodes plugin for Rohnvenson WordPress Themes Framework
Version: 1.0
Author: Robinson Rentillo
Author URI: http://robinsonrentillo.com/
License:
*/


/** Make sure we don't expose any info if called directly */
if ( ! function_exists( 'add_action' ) ) {
	exit;
}


define('TEST101_ADDONS_VERSION', '1.0');
define('TEST101_ADDONS_PLUGIN_URL', plugin_dir_url( __FILE__ ));
define('TEST101_ADDONS_PLUGIN_DIR', dirname( __FILE__ ) );
define('TEST101_ADDONS_PLUGIN_NAME', 'TEST101 Addons');
define('TEST101_ADDONS_SLUG', 'test101-addons');

/** include */
include_once TEST101_ADDONS_PLUGIN_DIR . '/test101-addons-functions.php';

/** Init */
function test101_addons_enqueue_scripts() {
	wp_enqueue_script( 'test101-addons', TEST101_ADDONS_PLUGIN_URL . 'js/test101-addons.js', '', '', true );
	
	wp_enqueue_style( 'test101-addons', TEST101_ADDONS_PLUGIN_URL . 'css/styles.css' );

}
function test101_addons_init(){
	add_action( 'wp_enqueue_scripts', 'test101_addons_enqueue_scripts' );
}
add_action('init', 'test101_addons_init');

?>