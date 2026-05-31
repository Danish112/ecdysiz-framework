<?php
/**
 * Archive template — categories, tags, author, date.
 *
 * @package Ecdysiz_Core
 */

get_header();
?>

<main id="ecdysiz-main" class="ecdysiz-main" role="main">

	<header class="ecdysiz-archive__header">
		<?php the_archive_title( '<h1 class="ecdysiz-archive__title">', '</h1>' ); ?>
		<?php the_archive_description( '<div class="ecdysiz-archive__description">', '</div>' ); ?>
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

		<p><?php esc_html_e( 'No content found.', 'ecdysiz-core' ); ?></p>

	<?php endif; ?>

</main>

<?php
get_footer();