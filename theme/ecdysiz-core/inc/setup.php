<?php
/**
 * Theme setup — text domain, init.
 *
 * Single responsibility: theme initialization that must run on after_setup_theme.
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load the theme text domain for internationalization.
 *
 * @return void
 */
function ecdysiz_setup() {
	load_theme_textdomain( ECDYSIZ_TEXT_DOMAIN, ECDYSIZ_DIR . '/languages' );
}
add_action( 'after_setup_theme', 'ecdysiz_setup' );
