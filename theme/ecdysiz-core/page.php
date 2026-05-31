<?php
/**
 * Page template — Elementor-built content area.
 * Step 8 finalizes.
 *
 * @package Ecdysiz_Core
 */

get_header();
?>

<main id="ecz-main" role="main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	endif;
	?>
</main>

<?php
get_footer();
