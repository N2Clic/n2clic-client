<?php
/**
 * Editor Functions.
 *
 * This file contains all customizations done to the WordPress
 * visual editor. It regroup both back-end and front-end functions.
 *
 * Summary:
 * - n2cc_add_style_dropdown()
 * - n2cc_add_new_styles()
 * - n2cc_add_editor_style()
 *
 * @since  1.0.0
 */


add_filter( 'mce_buttons_2', 'n2cc_add_style_dropdown' );
/**
 * Add the style dropdown.
 *
 * Adds a new dropdown in the WYSIWYG editor containing
 * all the custom styles for various elements.
 *
 * @since  1.0.0
 * @param  array $buttons The list of available buttons for the editor
 * @return array          The same array of buttons with the style dropdown
 */
function n2cc_add_style_dropdown( $buttons ) {
	array_unshift( $buttons, 'styleselect' );
	return $buttons;
}

add_filter( 'tiny_mce_before_init', 'n2cc_add_new_styles' );
/**
 * Add styles.
 *
 * Insert new styles into the "Style" dropdown.
 *
 * @since  1.0.0
 * @param  array $config Array of available styles
 * @return array         The customized array of styles
 */ 
function n2cc_add_new_styles( $config ) {

	/* Where we will store the new styles */
	$new = array();

	/* If some custom style is already defined we add ours to it. */
	if ( isset( $config['style_formats'] ) ) {
		$new = json_decode( $config['style_formats'] );
	}

	/* Our custom styles */
	$custom_styles = array(
		array(
			'title'   => 'Code',
			'inline'  => 'code',
			'wrapper' => false
		),
		array(
			'title'   => 'Basic abbreviation',
			'inline'  => 'abbr',
			'wrapper' => false
		),
		array(
			'title'   => 'User input (kbd)',
			'inline'  => 'kbd',
			'wrapper' => false
		),
		array(
			'title'   => 'Alert Success',
			'block'   => 'div',
			'classes' => 'alert alert-success',
			'wrapper' => false
		),
		array(
			'title'   => 'Alert Info',
			'block'   => 'div',
			'classes' => 'alert alert-info',
			'wrapper' => false
		),
		array(
			'title'   => 'Alert Warning',
			'block'   => 'div',
			'classes' => 'alert alert-warning',
			'wrapper' => false
		),
		array(
			'title'   => 'Alert Danger',
			'block'   => 'div',
			'classes' => 'alert alert-danger',
			'wrapper' => false
		),
		array(
			'title'   => 'Well',
			'block'   => 'div',
			'classes' => 'well',
			'wrapper' => false
		),
		array(
			'title'    => 'Lead Paragraph',
			'selector' => 'p',
			'classes'  => 'lead',
			'wrapper'  => false,
			'styles'   => array(
				'fontSize' => 'large'
			)
		),
		array(
			'title'    => 'List unstyled',
			'selector' => 'ul,ol',
			'classes'  => 'list-unstyled',
			'wrapper'  => false
		),
		array(
			'title'    => 'List inline',
			'selector' => 'ul,ol',
			'classes'  => 'list-inline',
			'wrapper'  => false
		),
		/*
		array(
			'title'  => 'Red Uppercase Text',
			'inline' => 'span',
			'styles' => array(
				'color'         => '#ff0000',
				'fontWeight'    => 'bold',
				'textTransform' => 'uppercase'
			)
		),
		array(
			'title'    => 'Download Link',
			'selector' => 'a',
			'classes'  => 'download'
		),
		*/
	);

	/* Add the custom styles */
	foreach ( $custom_styles as $style ) {
		array_push( $new, $style );
	}

	$config['style_formats'] = json_encode( $new );

	return $config;

}

add_action('init', 'n2cc_add_editor_style');
/**
 * Load editor style.
 *
 * Add a custom stylesheet to the WordPress visual editor.
 * The stylesheet loaded is actually the one that's loaded
 * on the front-end.
 *
 * @since  1.0.0
 * @return void
 */
function n2cc_add_editor_style() {
	add_editor_style( N2CC_URL . 'css/n2-custom.css' );
}