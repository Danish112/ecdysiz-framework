<?php
/**
 * Front page template.
 *
 * Loads Elementor-built content if a static front page is set,
 * otherwise falls back to the home/blog index.
 *
 * @package Ecdysiz_Core
 */

get_header();
?>

<main id="ecdysiz-main" class="ecdysiz-main" role="main">

	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>

</main>

<?php
get_footer();