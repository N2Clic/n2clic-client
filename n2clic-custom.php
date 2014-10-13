<?php
/*
Plugin Name: N2Clic Custom
Plugin URI: http://themeavenue.net/awesome-support/
Description: This WordPress plugin adds new formats/styles to the WordPress Editor.
Version: 1.0.0
Author: N2Clic
Author URI: http://n2clic.com/
License: GPL2
*/

define( 'N2CC_URL', trailingslashit( plugin_dir_url( __FILE__ ) ) );
define( 'N2CC_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );

add_action( 'wp_print_styles', 'n2cc_load_custom_style' );
/* Custom style */
function n2cc_load_custom_style() {
	wp_enqueue_style( 'n2c-custom', N2CC_URL . 'css/n2-custom.css', array(), NULL, 'screen' );
}

/**
 * Add "Styles" drop-down
 */ 
add_filter( 'mce_buttons_2', 'tav_mce_editor_buttons' );

function tav_mce_editor_buttons( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

add_filter( 'tiny_mce_before_init', 'tav_add_code_style' );
/**
 * Add styles/classes to the "Styles" drop-down
 */ 
function tav_add_code_style( $settings ) {

	$style_formats = array(
		array(
			'title' => 'Code',
			'inline' => 'code',
			'wrapper' => false
		),
		array(
			'title' => 'Basic abbreviation',
			'inline' => 'abbr',
			'wrapper' => false
		),
		array(
			'title' => 'User input (kbd)',
			'inline' => 'kbd',
			'wrapper' => false
		),
		array(
			'title' => 'Alert Success',
			'block' => 'div',
			'classes' => 'alert alert-success',
			'wrapper' => false
		),
		array(
			'title' => 'Alert Info',
			'block' => 'div',
			'classes' => 'alert alert-info',
			'wrapper' => false
		),
		array(
			'title' => 'Alert Warning',
			'block' => 'div',
			'classes' => 'alert alert-warning',
			'wrapper' => false
		),
		array(
			'title' => 'Alert Danger',
			'block' => 'div',
			'classes' => 'alert alert-danger',
			'wrapper' => false
		),
		array(
			'title' => 'Well',
			'block' => 'div',
			'classes' => 'well',
			'wrapper' => false
		),
		array(
			'title' => 'Lead Paragraph',
			'selector' => 'p',
			'classes' => 'lead',
			'wrapper' => false,
			'styles' => array(
				'fontSize' => 'large'
			)
		),
		array(
			'title' => 'List unstyled',
			'selector' => 'ul,ol',
			'classes' => 'list-unstyled',
			'wrapper' => false
		),
		array(
			'title' => 'List inline',
			'selector' => 'ul,ol',
			'classes' => 'list-inline',
			'wrapper' => false
		),
		/*
		array(
			'title' => 'Red Uppercase Text',
			'inline' => 'span',
			'styles' => array(
				'color' => '#ff0000',
				'fontWeight' => 'bold',
				'textTransform' => 'uppercase'
			)
		),
		array(
			'title' => 'Download Link',
			'selector' => 'a',
			'classes' => 'download'
		),
		*/
		);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;

}

add_action( 'after_setup_theme', 'n2cc_add_editor_style' );
function n2cc_add_editor_style() {
    add_editor_style( N2CC_URL . 'css/n2-custom.css' );
}

/* hook updater to init */
add_action( 'init', 'n2c_custom_updater_init' );

/**
 * Load and Activate Plugin Updater Class.
 */
function n2c_custom_updater_init() {

    /* Load Plugin Updater */
    require_once( N2CC_PATH . 'includes/plugin-updater.php' );

    /* Updater Config */
    $config = array(
        'base'      => plugin_basename( __FILE__ ),
        'dashboard' => false,
        'username'  => false,
        'key'       => '',
        'repo_uri'  => 'https://api.themeavenue.net',
        'repo_slug' => 'n2clic-custom',
    );

    /* Load Updater Class */
    new N2Clic_Custom_Updater( $config );
}