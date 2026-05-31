<?php
/**
 * Theme supports — add_theme_support() declarations.
 *
 * Single responsibility: declare WordPress theme supports, image sizes, menus.
 *
 * @package Ecdysiz_Core
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register all theme supports.
 *
 * @return void
 */
function ecdysiz_theme_supports() {
	// Core supports.
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'editor-styles' );

	// HTML5 markup.
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Register navigation menu locations.
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'ecdysiz-core' ),
			'footer'  => __( 'Footer Menu', 'ecdysiz-core' ),
		)
	);
}
add_action( 'after_setup_theme', 'ecdysiz_theme_supports' );
