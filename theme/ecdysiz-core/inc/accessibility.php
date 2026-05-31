<?php
/**
 * Accessibility helpers.
 *
 * Single responsibility: skip-link rendering, landmark output helpers.
 * Focus-visible baseline lives in framework.css.
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Output the skip-to-main-content link immediately after <body>.
 *
 * The link is visually hidden until focused, allowing keyboard users
 * to bypass header navigation. Targets #ecdysiz-main (set in templates).
 *
 * @return void
 */
function ecdysiz_skip_link() {
	printf(
		'<a class="ecdysiz-skip-link" href="#ecdysiz-main">%s</a>',
		esc_html__( 'Skip to main content', 'ecdysiz-core' )
	);
}
add_action( 'wp_body_open', 'ecdysiz_skip_link' );
