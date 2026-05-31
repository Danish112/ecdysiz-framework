<?php
/**
 * 404 template.
 * Step 8 finalizes.
 *
 * @package Ecdysiz_Core
 */

get_header();
?>

<main id="ecz-main" role="main">
	<h1><?php esc_html_e( 'Page not found', 'ecdysiz-core' ); ?></h1>
	<p><?php esc_html_e( 'The page you are looking for does not exist.', 'ecdysiz-core' ); ?></p>
	<?php get_search_form(); ?>
</main>

<?php
get_footer();
