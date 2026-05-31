<?php
/**
 * Ecdysiz Reference Child — Thin Bootstrap
 *
 * Per Phase 1.5: child functions.php is enqueue wiring + the parent's
 * published hooks only. No reusable logic. If logic would be reused
 * across children, it belongs in the parent.
 *
 * @package Ecdysiz_Reference
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ECDYSIZ_REF_VERSION', '0.0.1' );
define( 'ECDYSIZ_REF_DIR', get_stylesheet_directory() );
define( 'ECDYSIZ_REF_URI', get_stylesheet_directory_uri() );

/**
 * Enqueue the child theme's generated tokens (override) and client overrides.
 *
 * Loads AFTER parent stylesheets so cascade order is preserved.
 *
 * @return void
 */
function ecdysiz_ref_enqueue_assets() {
	$css_uri = ECDYSIZ_REF_URI . '/assets/css';

	wp_enqueue_style(
		'ecdysiz-ref-tokens',
		$css_uri . '/generated/tokens.css',
		array( 'ecdysiz-client' ),
		ECDYSIZ_REF_VERSION
	);

	wp_enqueue_style(
		'ecdysiz-ref-overrides',
		$css_uri . '/client-overrides.css',
		array( 'ecdysiz-ref-tokens' ),
		ECDYSIZ_REF_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'ecdysiz_ref_enqueue_assets', 100 );
