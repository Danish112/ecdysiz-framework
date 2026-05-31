<?php
/**
 * Header template.
 *
 * Contains:
 *  - Inline FOUC-prevention hydration script (must run before paint)
 *  - Skip link (rendered via wp_body_open in inc/accessibility.php)
 *  - Site header landmark
 *
 * The FOUC script is intentionally inline in <head> so it executes before
 * any CSS renders. Deferring it would cause a theme flash.
 *
 * @package Ecdysiz_Core
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> data-theme="light">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<script>
		(function () {
			try {
				var stored = localStorage.getItem('ecdysiz-theme');
				var prefersDark = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
				var theme = stored || (prefersDark ? 'dark' : 'light');
				document.documentElement.setAttribute('data-theme', theme);
			} catch (e) {
				document.documentElement.setAttribute('data-theme', 'light');
			}
		})();
	</script>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="ecdysiz-site-header" role="banner">
	<div class="ecdysiz-site-header__inner">

		<?php if ( has_custom_logo() ) : ?>
			<div class="ecdysiz-site-logo">
				<?php the_custom_logo(); ?>
			</div>
		<?php else : ?>
			<p class="ecdysiz-site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<?php bloginfo( 'name' ); ?>
				</a>
			</p>
		<?php endif; ?>

		<nav class="ecdysiz-site-nav" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'ecdysiz-core' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'ecdysiz-menu',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

	</div>
</header>