<?php
/**
 * Plugin Name: N2Clic Client
 * Plugin URI:  https://github.com/N2Clic/n2clic-client
 * Description: Tiny WordPress plugin to customize the user experience for our clients.
 * Version:     1.0.1
 * Author:      N2Clic Ltd.
 * Author URI:  http://n2clic.com/
 * License:     GPL2
 */

/**
 * Define plugin constants.
 *
 * @since  1.0.0
 */
define( 'N2CC_URL',     trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'N2CC_PATH',    trailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'N2CC_VERSION', '1.0.1' );

/**
 * Load branding customization files.
 */
require_once( N2CC_PATH . 'includes/branding.php' );

/**
 * Load editor customization files.
 */
require_once( N2CC_PATH . 'includes/editor.php' );

add_action( 'wp_print_styles', 'n2cc_load_custom_style' );
/**
 * Load custom style.
 *
 * Loads a custom stylesheet on the front-end.
 * This stylesheet is used to style all the elements
 * that are added to the "Style" section of
 * the visual editor in the back-end.
 * 
 * @since  1.0.0
 * @return void
 */
function n2cc_load_custom_style() {
	if ( ! defined( 'N2_CUSTOM_STYLES' ) || false !== N2_CUSTOM_STYLES ) {
		wp_enqueue_style( 'n2c-custom', N2CC_URL . 'css/n2-custom.min.css', array(), N2CC_VERSION, 'screen' );
	}
}

add_action( 'init', 'n2cc_custom_updater_init' );
/**
 * Instanciate the updater.
 *
 * Load and instanciate the updater class.
 * This is used for plugin auto-update in order
 * to keep the plugin up to date on all our sites
 * using this plugin.
 *
 * @since  1.0.0
 */
function n2cc_custom_updater_init() {

    /* Load Plugin Updater */
    require_once( N2CC_PATH . 'includes/plugin-updater.php' );

    /* Updater Config */
    $config = array(
        'base'      => plugin_basename( __FILE__ ),
        'dashboard' => false,
        'username'  => false,
        'key'       => '',
        'repo_uri'  => 'https://api.themeavenue.net',
        'repo_slug' => 'n2clic-client',
    );

    /* Instanciate Updater Class */
    new N2Clic_Custom_Updater( $config );
}
