<?php
/**
 * Single post template.
 *
 * @package Ecdysiz_Core
 */

get_header();
?>

<main id="ecdysiz-main" class="ecdysiz-main" role="main">

	<?php
	while ( have_posts() ) :
		the_post();
		?>

		<article <?php post_class( 'ecdysiz-single' ); ?>>

			<header class="ecdysiz-single__header">
				<h1 class="ecdysiz-single__title"><?php the_title(); ?></h1>
				<div class="ecdysiz-single__meta">
					<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
						<?php echo esc_html( get_the_date() ); ?>
					</time>
				</div>
			</header>

			<div class="ecdysiz-single__content">
				<?php the_content(); ?>
			</div>

		</article>

		<?php
	endwhile;
	?>

</main>

<?php
get_footer();