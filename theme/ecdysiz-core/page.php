<?php
/**
 * Single page template — Elementor-built content area.
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