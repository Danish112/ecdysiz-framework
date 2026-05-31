<?php
/**
 * Asset enqueueing.
 *
 * Single responsibility: enqueue stylesheets and scripts in cascade-correct order:
 *   tokens.css -> framework.css -> components.css -> client.css
 *
 * Populated in Step 7.
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Step 7: wp_enqueue_style for tokens, framework, components, client
// with proper dependency chain and ECZ_VERSION cache-busting.
