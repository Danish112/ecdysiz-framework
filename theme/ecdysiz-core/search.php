<?php
/**
 * Search results template.
 * Step 8 finalizes.
 *
 * @package Ecdysiz_Core
 */

get_header();
?>

<main id="ecz-main" role="main">
	<header>
		<h1>
			<?php
			/* translators: %s: search query */
			printf( esc_html__( 'Search results for: %s', 'ecdysiz-core' ), '<span>' . esc_html( get_search_query() ) . '</span>' );
			?>
		</h1>
	</header>

	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			the_title( '<h2>', '</h2>' );
			the_excerpt();
		endwhile;
	else :
		esc_html_e( 'No results found.', 'ecdysiz-core' );
		get_search_form();
	endif;
	?>
</main>

<?php
get_footer();
