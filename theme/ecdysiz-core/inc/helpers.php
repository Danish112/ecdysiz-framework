<?php
/**
 * Shared utility functions.
 *
 * Single responsibility: pure utility helpers used across modules.
 * No hooks. No side effects. Pure functions only.
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Return a sanitized list of CSS classes joined as a string.
 *
 * Convenience helper for composing ecdysiz- prefixed classes in templates.
 *
 * @param array $classes Array of class names.
 * @return string Space-separated class string.
 */
function ecdysiz_classes( $classes ) {
	$classes = array_filter( (array) $classes );
	$classes = array_map( 'sanitize_html_class', $classes );

	return implode( ' ', $classes );
}

/**
 * Echo a sanitized class attribute.
 *
 * @param array $classes Array of class names.
 * @return void
 */
function ecdysiz_class_attr( $classes ) {
	echo 'class="' . esc_attr( ecdysiz_classes( $classes ) ) . '"';
}
