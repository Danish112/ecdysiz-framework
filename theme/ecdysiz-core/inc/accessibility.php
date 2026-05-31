<?php
/**
 * Accessibility helpers.
 *
 * Single responsibility: skip-link rendering, landmark helpers,
 * screen-reader utilities. Focus-visible baseline lives in framework.css.
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
 * to bypass header navigation. Targets #ecdysiz-main set in all templates.
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

/**
 * Add lang attribute to <html> if missing.
 *
 * WordPress usually handles this via language_attributes(), but this
 * ensures it's never empty for screen readers.
 *
 * @param string $output The HTML lang attributes.
 * @return string
 */
function ecdysiz_ensure_lang_attribute( $output ) {
	if ( empty( $output ) || false === strpos( $output, 'lang=' ) ) {
		$output .= ' lang="' . esc_attr( get_locale() ) . '"';
	}
	return $output;
}
add_filter( 'language_attributes', 'ecdysiz_ensure_lang_attribute' );

/**
 * Render a screen-reader-only string.
 *
 * Use for context that's visually redundant but useful for assistive tech.
 *
 * @param string $text Text to render.
 * @return void
 */
function ecdysiz_sr_only( $text ) {
	printf(
		'<span class="ecdysiz-sr-only">%s</span>',
		esc_html( $text )
	);
}
