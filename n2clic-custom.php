<?php
/*
Plugin Name: N2Clic Custom
Plugin URI: http://themeavenue.net/awesome-support/
Description: N2Clic Custom Functions
Version: 1.0.0
Author: N2Clic
Author URI: http://n2clic.com/
License: GPL2
*/

define( 'N2CC_URL', plugin_dir_url( __FILE__ ) );
define( 'N2CC_PATH', plugin_dir_path( __FILE__ ) );

add_action( 'wp_print_styles', 'n2cc_load_custom_style' );
/* Custom style */
function n2cc_load_custom_style() {
	wp_enqueue_style( 'n2c-custom', N2CC_URL . 'css/custom.css', array(), NULL, 'screen' );
}

/**
 * Apply styles to the visual editor
 */  
add_filter('mce_css', 'tuts_mcekit_editor_style');
function tuts_mcekit_editor_style($url) {

	if ( !empty($url) )
		$url .= ',';

	// Retrieves the plugin directory URL
	// Change the path here if using different directories
	$url .= trailingslashit( plugin_dir_url(__FILE__) ) . '/editor-styles.css';

	return $url;
}

/**
 * Add "Styles" drop-down
 */ 
add_filter( 'mce_buttons_2', 'tuts_mce_editor_buttons' );

function tuts_mce_editor_buttons( $buttons ) {
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
			'classes' => '',
			'wrapper' => false
		),
		array(
			'title' => 'Keyboard',
			'inline' => 'kbd',
			'classes' => '',
			'wrapper' => false
		),
		/*array(
			'title' => 'Download Link',
			'selector' => 'a',
			'classes' => 'download'
			),
		array(
			'title' => 'Testimonial',
			'selector' => 'p',
			'classes' => 'testimonial',
			),
		array(
			'title' => 'Warning Box',
			'block' => 'div',
			'classes' => 'warning box',
			'wrapper' => true
			),
		array(
			'title' => 'Red Uppercase Text',
			'inline' => 'span',
			'styles' => array(
				'color' => '#ff0000',
				'fontWeight' => 'bold',
				'textTransform' => 'uppercase'
				)
			)*/
		);

	$settings['style_formats'] = json_encode( $style_formats );

	return $settings;

}

/* Learn TinyMCE style format options at http://www.tinymce.com/wiki.php/Configuration:formats */

/*
 * Add custom stylesheet to the website front-end with hook 'wp_enqueue_scripts'
 */
add_action('wp_enqueue_scripts', 'tuts_mcekit_editor_enqueue');

/*
 * Enqueue stylesheet, if it exists.
 */
function tuts_mcekit_editor_enqueue() {
  $StyleUrl = plugin_dir_url(__FILE__).'editor-styles.css'; // Customstyle.css is relative to the current file
  wp_enqueue_style( 'myCustomStyles', $StyleUrl );
}
?>