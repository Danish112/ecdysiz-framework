<?php
/**
 * Security hardening.
 *
 * Single responsibility: information-disclosure prevention,
 * safe enqueue practices, output escaping helpers.
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Remove WordPress version disclosure from public output.
 *
 * Reduces information available to automated vulnerability scanners
 * by hiding the WordPress version from <head>, RSS feeds, and asset URLs.
 *
 * @return void
 */
function ecdysiz_remove_version_leak() {
	// Remove version from <head>.
	remove_action( 'wp_head', 'wp_generator' );

	// Remove version from RSS feeds.
	add_filter( 'the_generator', '__return_empty_string' );
}
add_action( 'init', 'ecdysiz_remove_version_leak' );

/**
 * Strip WordPress version from asset URLs in public-facing markup.
 *
 * Theme/plugin versions (ECDYSIZ_VERSION) are preserved for cache-busting.
 * Only the WordPress core version query string is removed.
 *
 * @param string $src Asset source URL.
 * @return string Cleaned URL.
 */
function ecdysiz_remove_wp_version_from_assets( $src ) {
	if ( strpos( $src, 'ver=' . get_bloginfo( 'version' ) ) !== false ) {
		$src = remove_query_arg( 'ver', $src );
	}
	return $src;
}
add_filter( 'style_loader_src', 'ecdysiz_remove_wp_version_from_assets', 9999 );
add_filter( 'script_loader_src', 'ecdysiz_remove_wp_version_from_assets', 9999 );

/**
 * Remove unnecessary <head> elements that expose site metadata.
 *
 * - RSD link (legacy XML-RPC discovery)
 * - Windows Live Writer manifest
 * - Shortlink (redundant with canonical)
 *
 * @return void
 */
function ecdysiz_clean_head() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
}
add_action( 'init', 'ecdysiz_clean_head' );

/**
 * Disable XML-RPC entirely.
 *
 * XML-RPC is a common brute-force and DDoS vector. Most modern WordPress
 * installs do not need it. If a client needs it, this filter can be
 * removed in a child theme's functions.php.
 *
 * @return bool
 */
function ecdysiz_disable_xmlrpc() {
	return false;
}
add_filter( 'xmlrpc_enabled', 'ecdysiz_disable_xmlrpc' );

/**
 * Disable user enumeration via REST API.
 *
 * Blocks the /wp-json/wp/v2/users endpoint for unauthenticated requests,
 * preventing automated username harvesting.
 *
 * @param mixed $response Current REST response.
 * @return mixed Original response, or WP_Error on blocked endpoints.
 */
function ecdysiz_block_user_enumeration( $response ) {
	if ( ! is_user_logged_in() ) {
		$current_route = isset( $GLOBALS['wp']->query_vars['rest_route'] )
			? $GLOBALS['wp']->query_vars['rest_route']
			: '';

		if ( preg_match( '#^/wp/v2/users#', $current_route ) ) {
			return new WP_Error(
				'rest_user_cannot_view',
				__( 'Sorry, you are not allowed to view users.', 'ecdysiz-core' ),
				array( 'status' => 401 )
			);
		}
	}
	return $response;
}
add_filter( 'rest_pre_dispatch', 'ecdysiz_block_user_enumeration', 10, 1 );
