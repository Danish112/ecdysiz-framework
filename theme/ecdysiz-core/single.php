<?php
/**
 * Single post template.
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
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_title( '<h1>', '</h1>' ); ?>
				<?php the_content(); ?>
			</article>
			<?php
		endwhile;
	endif;
	?>
</main>

<?php
get_footer();
