<?php
/**
 * Index — required fallback template.
 * Step 8 finalizes all templates.
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
			the_title( '<h1>', '</h1>' );
			the_content();
		endwhile;
	else :
		esc_html_e( 'No content found.', 'ecdysiz-core' );
	endif;
	?>
</main>

<?php
get_footer();
