<?php
/**
 * Home — blog index when front page is static.
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
			the_title( '<h2>', '</h2>' );
			the_excerpt();
		endwhile;
	endif;
	?>
</main>

<?php
get_footer();
