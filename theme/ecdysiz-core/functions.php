<?php
/**
 * Ecdysiz Core — Theme Bootstrap
 *
 * This file is a MANIFEST. It loads modules from inc/ and defines constants.
 * Never add logic here. Logic belongs in the matching inc/ module
 * (see CONTRIBUTING.md "Where new code goes").
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Theme constants.
define( 'ECDYSIZ_VERSION', '0.0.1' );
define( 'ECDYSIZ_DIR', get_template_directory() );
define( 'ECDYSIZ_URI', get_template_directory_uri() );
define( 'ECDYSIZ_TEXT_DOMAIN', 'ecdysiz-core' );

// Module manifest.
require_once ECDYSIZ_DIR . '/inc/setup.php';
require_once ECDYSIZ_DIR . '/inc/theme-support.php';
require_once ECDYSIZ_DIR . '/inc/enqueue.php';
require_once ECDYSIZ_DIR . '/inc/cascade.php';
require_once ECDYSIZ_DIR . '/inc/security.php';
require_once ECDYSIZ_DIR . '/inc/accessibility.php';
require_once ECDYSIZ_DIR . '/inc/helpers.php';
