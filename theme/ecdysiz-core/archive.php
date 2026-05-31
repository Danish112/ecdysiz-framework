<?php
/**
 * Archive template — categories, tags, authors.
 * Step 8 finalizes.
 *
 * @package Ecdysiz_Core
 */

get_header();
?>

<main id="ecz-main" role="main">
	<header>
		<?php the_archive_title( '<h1>', '</h1>' ); ?>
	</header>

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
