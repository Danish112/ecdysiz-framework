<?php
/**
 * Footer template.
 *
 * Contains:
 *  - Footer landmark with secondary nav
 *  - Theme toggle button (light/dark switcher)
 *  - wp_footer() hook
 *
 * @package Ecdysiz_Core
 */

?>

<footer class="ecdysiz-site-footer" role="contentinfo">
	<div class="ecdysiz-site-footer__inner">

		<nav class="ecdysiz-footer-nav" aria-label="<?php esc_attr_e( 'Footer Menu', 'ecdysiz-core' ); ?>">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'footer',
					'container'      => false,
					'menu_class'     => 'ecdysiz-menu ecdysiz-menu--footer',
					'fallback_cb'    => false,
				)
			);
			?>
		</nav>

		<button
			type="button"
			class="ecdysiz-theme-toggle"
			aria-label="<?php esc_attr_e( 'Toggle dark mode', 'ecdysiz-core' ); ?>"
			data-ecdysiz-theme-toggle
		>
			<span class="ecdysiz-theme-toggle__label">
				<?php esc_html_e( 'Toggle theme', 'ecdysiz-core' ); ?>
			</span>
		</button>

		<p class="ecdysiz-site-credit">
			<?php
			printf(
				/* translators: 1: current year, 2: site name. */
				esc_html__( '© %1$s %2$s', 'ecdysiz-core' ),
				esc_html( gmdate( 'Y' ) ),
				esc_html( get_bloginfo( 'name' ) )
			);
			?>
		</p>

	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>