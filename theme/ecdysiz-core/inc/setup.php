<?php
/**
 * Theme setup — text domain, init.
 *
 * Single responsibility: theme initialization that must run on after_setup_theme.
 * Populated in Step 6 (text domain) and Step 9 (i18n hardening).
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Step 6: load_theme_textdomain( ECDYSIZ_TEXT_DOMAIN, ECDYSIZ_DIR . '/languages' ).
