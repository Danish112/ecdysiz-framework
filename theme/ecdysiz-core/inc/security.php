<?php
/**
 * Security hardening.
 *
 * Single responsibility: output-escaping helpers, version-leak removal,
 * safe enqueue practices.
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Remove WordPress version meta from <head> and RSS feeds.
 *
 * Reduces information disclosure for security scanners.
 *
 * @return void
 */
function ecdysiz_remove_version_leak() {
	remove_action( 'wp_head', 'wp_generator' );
}
add_action( 'init', 'ecdysiz_remove_version_leak' );

/**
 * Remove version query strings from enqueued asset URLs in production output.
 *
 * Versions are still passed to wp_enqueue_style/script for cache-busting via
 * ECDYSIZ_VERSION — this filter only strips them from public-facing URLs when
 * desired. Currently a no-op; activated only if a deployment requires it.
 *
 * @param string $src Asset source URL.
 * @return string
 */
function ecdysiz_clean_asset_version( $src ) {
	// Intentional no-op for v0.0.1; cache-busting via ECDYSIZ_VERSION is correct.
	return $src;
}
add_filter( 'style_loader_src', 'ecdysiz_clean_asset_version', 10, 1 );
add_filter( 'script_loader_src', 'ecdysiz_clean_asset_version', 10, 1 );
