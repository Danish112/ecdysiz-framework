<?php
/**
 * 404 not-found template.
 *
 * @package Ecdysiz_Core
 */

get_header();
?>

<main id="ecdysiz-main" class="ecdysiz-main" role="main">

	<section class="ecdysiz-error-404">
		<h1 class="ecdysiz-error-404__title">
			<?php esc_html_e( 'Page not found', 'ecdysiz-core' ); ?>
		</h1>
		<p class="ecdysiz-error-404__message">
			<?php esc_html_e( 'The page you are looking for does not exist or has been moved.', 'ecdysiz-core' ); ?>
		</p>
		<?php get_search_form(); ?>
		<p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php esc_html_e( 'Return to home', 'ecdysiz-core' ); ?>
			</a>
		</p>
	</section>

</main>

<?php
get_footer();