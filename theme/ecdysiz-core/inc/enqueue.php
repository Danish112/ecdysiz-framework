<?php
/**
 * Asset enqueueing.
 *
 * Single responsibility: enqueue stylesheets and scripts in cascade-correct order:
 *   tokens.css -> framework.css -> components.css -> client.css
 *
 * Cascade layer wrapping for Elementor stylesheets lives in inc/cascade.php (Step 7).
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue framework stylesheets in cascade-correct order.
 *
 * Order matters for the @layer cascade:
 *   tokens (CSS variables) -> framework -> components -> client
 *
 * @return void
 */
function ecdysiz_enqueue_styles() {
	$css_uri = ECDYSIZ_URI . '/assets/css';

	wp_enqueue_style(
		'ecdysiz-tokens',
		$css_uri . '/generated/tokens.css',
		array(),
		ECDYSIZ_VERSION
	);

	wp_enqueue_style(
		'ecdysiz-framework',
		$css_uri . '/framework.css',
		array( 'ecdysiz-tokens' ),
		ECDYSIZ_VERSION
	);

	wp_enqueue_style(
		'ecdysiz-components',
		$css_uri . '/components.css',
		array( 'ecdysiz-framework' ),
		ECDYSIZ_VERSION
	);

	wp_enqueue_style(
		'ecdysiz-client',
		$css_uri . '/client.css',
		array( 'ecdysiz-components' ),
		ECDYSIZ_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'ecdysiz_enqueue_styles' );

/**
 * Enqueue framework JavaScript.
 *
 * @return void
 */
function ecdysiz_enqueue_scripts() {
	$js_uri = ECDYSIZ_URI . '/assets/js';

	wp_enqueue_style(
		'ecdysiz-components',
		$css_uri . '/components.css',
		array( 'ecdysiz-framework' ),
		ECDYSIZ_VERSION
	);

	wp_enqueue_style(
		'ecdysiz-sections',
		$css_uri . '/sections.css',
		array( 'ecdysiz-components' ),
		ECDYSIZ_VERSION
	);

	wp_enqueue_style(
		'ecdysiz-client',
		$css_uri . '/client.css',
		array( 'ecdysiz-sections' ),
		ECDYSIZ_VERSION
	);
}
add_action( 'wp_enqueue_scripts', 'ecdysiz_enqueue_scripts' );
