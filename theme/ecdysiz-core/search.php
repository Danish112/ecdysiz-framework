<?php
/**
 * Search results template.
 *
 * @package Ecdysiz_Core
 */

get_header();
?>

<main id="ecdysiz-main" class="ecdysiz-main" role="main">

	<header class="ecdysiz-archive__header">
		<h1 class="ecdysiz-archive__title">
			<?php
			printf(
				/* translators: %s: search query. */
				esc_html__( 'Search results for: %s', 'ecdysiz-core' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
		</h1>
	</header>

	<?php if ( have_posts() ) : ?>

		<?php
		while ( have_posts() ) :
			the_post();
			?>

			<article <?php post_class( 'ecdysiz-post' ); ?>>
				<header class="ecdysiz-post__header">
					<h2 class="ecdysiz-post__title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h2>
				</header>
				<div class="ecdysiz-post__excerpt">
					<?php the_excerpt(); ?>
				</div>
			</article>

			<?php
		endwhile;
		?>

		<?php
		the_posts_pagination(
			array(
				'class' => 'ecdysiz-pagination',
			)
		);
		?>

	<?php else : ?>

		<p><?php esc_html_e( 'No results found.', 'ecdysiz-core' ); ?></p>
		<?php get_search_form(); ?>

	<?php endif; ?>

</main>

<?php
get_footer();