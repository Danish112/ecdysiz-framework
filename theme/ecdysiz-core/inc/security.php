<?php
/**
 * Security hardening.
 *
 * Single responsibility: output escaping helpers, version-leak removal,
 * safe inline script output.
 *
 * Populated in Step 9.
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Step 9: remove_action for version meta, escaping helpers, safe inline patterns.
