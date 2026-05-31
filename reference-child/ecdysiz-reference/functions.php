<?php
/**
 * Ecdysiz Reference Child — Thin Bootstrap
 *
 * Per Phase 1.5: child functions.php is enqueue wiring + the parent's
 * published hooks only. No reusable logic. If logic would be reused
 * across children, it belongs in the parent.
 *
 * Populated in Step 11.
 *
 * @package Ecdysiz_Reference
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'ECDYSIZ_REF_VERSION', '0.0.1' );
define( 'ECDYSIZ_REF_DIR', get_stylesheet_directory() );
define( 'ECDYSIZ_REF_URI', get_stylesheet_directory_uri() );

// Step 11: enqueue generated client tokens.css and client-overrides.css.
