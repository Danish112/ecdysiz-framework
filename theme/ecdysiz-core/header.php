<?php
/**
 * Header template.
 *
 * Step 8 finalizes:
 *  - FOUC-prevention dark-mode hydration script (inline, before paint)
 *  - Skip link
 *  - Primary navigation
 *
 * @package Ecdysiz_Core
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header role="banner">
	<?php // Step 8: site identity + primary nav. ?>
</header>