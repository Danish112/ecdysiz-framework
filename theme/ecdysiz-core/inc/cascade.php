<?php
/**
 * Cascade layer wrapping for Elementor stylesheets.
 *
 * Single responsibility: wrap Elementor's stylesheets into @layer elementor
 * via @import url(...) layer(elementor) so @layer client can override
 * Elementor CSS without !important.
 *
 * Validated in Validation 2 (May 2026) across Chrome, Firefox, Safari.
 * See docs/decisions/0002-cascade-import-layer.md.
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Static list of known Elementor stylesheet handles to wrap into @layer elementor.
 *
 * Dynamic per-page handles (elementor-post-{id}, local-{id}-frontend-*) are
 * matched by pattern in ecdysiz_should_wrap_handle().
 *
 * @return array
 */
function ecdysiz_elementor_handles() {
	return array(
		'elementor-common',
		'elementor-frontend',
		'elementor-frontend-legacy',
		'elementor-global',
		'elementor-icons',
		'elementor-icons-shared-0',
		'elementor-icons-fa-solid',
		'elementor-icons-fa-regular',
		'elementor-icons-fa-brands',
		'elementor-wp-admin-bar',
		'elementor-pro',
		'elementor-pro-frontend',
		'elementor-pro-custom-fonts',
		'e-theme-ui-light',
		'e-theme-ui-dark',
		'e-atomic-widgets',
		'e-atomic-widgets-styles',
		'e-atomic',
		'e-styles',
		'e-styles-frontend',
		'widget-heading',
		'widget-image',
		'widget-button',
		'widget-text-editor',
		'widget-icon',
		'widget-icon-box',
		'widget-icon-list',
		'widget-divider',
		'widget-spacer',
		'widget-video',
		'base-desktop',
	);
}

/**
 * Determine whether a stylesheet handle should be wrapped into @layer elementor.
 *
 * Matches static list + dynamic Elementor patterns.
 *
 * @param string $handle Stylesheet handle.
 * @return bool
 */
function ecdysiz_should_wrap_handle( $handle ) {
	if ( in_array( $handle, ecdysiz_elementor_handles(), true ) ) {
		return true;
	}

	if ( preg_match( '/^elementor-post-\d+$/', $handle ) ) {
		return true;
	}

	if ( preg_match( '/^local-\d+-frontend-(desktop|tablet|mobile)$/', $handle ) ) {
		return true;
	}

	if ( preg_match( '/^elementor-gf-/', $handle ) ) {
		return true;
	}

	return false;
}

/**
 * Emit the canonical cascade layer order in <head> before any stylesheet loads.
 *
 * Layer order: reset → framework → components → elementor → client.
 * Establishes layer priority regardless of stylesheet load order.
 *
 * @return void
 */
function ecdysiz_emit_cascade_order() {
	echo '<style id="ecdysiz-cascade-order">@layer reset, framework, components, elementor, client;</style>' . "\n";
}
add_action( 'wp_head', 'ecdysiz_emit_cascade_order', 1 );

/**
 * Wrap matched Elementor stylesheets into @layer elementor via @import.
 *
 * Converts <link rel="stylesheet"> tags into <style> blocks containing
 *
 * @import url(...) layer(elementor) <media>; — the spec-compliant way to
 * assign an external stylesheet to a cascade layer.
 *
 * @param string $tag    The HTML link tag.
 * @param string $handle Stylesheet handle.
 * @param string $href   Stylesheet URL.
 * @param string $media  Media attribute value.
 * @return string Modified HTML.
 */
function ecdysiz_wrap_elementor_in_layer( $tag, $handle, $href, $media ) {
	if ( ! ecdysiz_should_wrap_handle( $handle ) ) {
		return $tag;
	}

	return sprintf(
		'<style id="%s-css-layered" data-ecdysiz-layered="elementor">@import url("%s") layer(elementor) %s;</style>' . "\n",
		esc_attr( $handle ),
		esc_url( $href ),
		esc_attr( $media )
	);
}
add_filter( 'style_loader_tag', 'ecdysiz_wrap_elementor_in_layer', 10, 4 );
