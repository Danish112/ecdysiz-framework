<?php
/**
 * Search form template.
 *
 * @package Ecdysiz_Core
 */

?>

<form role="search" method="get" class="ecdysiz-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="ecdysiz-search-input" class="screen-reader-text">
		<?php esc_html_e( 'Search', 'ecdysiz-core' ); ?>
	</label>
	<input
		type="search"
		id="ecdysiz-search-input"
		class="ecdysiz-search-form__input"
		name="s"
		value="<?php echo esc_attr( get_search_query() ); ?>"
		placeholder="<?php esc_attr_e( 'Search…', 'ecdysiz-core' ); ?>"
		required
	>
	<button type="submit" class="ecdysiz-search-form__submit">
		<?php esc_html_e( 'Search', 'ecdysiz-core' ); ?>
	</button>
</form>