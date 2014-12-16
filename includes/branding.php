<?php

/* -----------------------------------------
Login page branding
http://codex.wordpress.org/Customizing_the_Login_Form
----------------------------------------- */

$GLOBALS['n2_website_url'] = 'http://n2clic.com/';
$GLOBALS['n2_welcome_msg'] = 'Website created by <a href="' . $n2_website_url . '" target="_blank">N2Clic Ltd</a>.';
$GLOBALS['n2_about'] = 'N2Clic is a web design and development agency specialized in WordPress.';
if(get_locale() == 'fr_FR') {
	$GLOBALS['n2_website_url'] = 'http://n2clic.fr/';
	$GLOBALS['n2_welcome_msg'] = 'Site créé par <a href="' . $n2_website_url . '" target="_blank">N2Clic Ltd</a>.';
	$GLOBALS['n2_about'] = 'N2Clic est une agence web spécialisée dans WordPress.';
}

/**
 * Add style to login page
 */
function n2_login_style() { ?>
<style type="text/css">
/* Customize the background */
body.login {
	background: url('data:image/png;base64,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');
}
/* Replace the default WordPress logo */
body.login div#login h1 a {
	background-image: url('data:image/png;base64,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');
	-webkit-background-size: 100px;
	background-size: 100px;
	height: 58px;
	width: 100px;
}
/* Customize login message */
.n2-login-message {
	text-align: center;
	font-size: 16px;
	font-weight: bold;
}
.n2-login-message a {
	text-decoration: none;
}
</style>
<?php }
add_action( 'login_enqueue_scripts', 'n2_login_style' );


/**
 * Add link to logo
 */
function n2_login_logo_url() {
	return $n2_website_url;
}
add_filter( 'login_headerurl', 'n2_login_logo_url' );


/**
 * Add logo title
 */
function n2_login_logo_url_title() {
	return '';
}
add_filter( 'login_headertitle', 'n2_login_logo_url_title' );


/**
 * Replace the default login message
 */
function n2_login_message( $message ) {
	if ( empty($message) ){
		return '<div class="n2-login-message">' . $GLOBALS['n2_welcome_msg'] . '</div>';
	} else {
		return $message;
	}
}
add_filter( 'login_message', 'n2_login_message' );


/* -----------------------------------------
Dashboard branding
http://codex.wordpress.org/Plugin_API/Filter_Reference/admin_footer_text
----------------------------------------- */
function n2_custom_footer_admin () {
	echo 'Website created by <a href="' . $GLOBALS['n2_website_url'] . '">N2Clic Ltd.</a>';
}
add_filter('admin_footer_text', 'n2_custom_footer_admin');