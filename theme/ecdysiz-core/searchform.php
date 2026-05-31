<?php
/**
 * Search form fragment.
 * Step 8 finalizes with full a11y attributes.
 *
 * @package Ecdysiz_Core
 */

?>
<form role="search" method="get" class="ecdysiz-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="ecdysiz-search-input"><?php esc_html_e( 'Search', 'ecdysiz-core' ); ?></label>
	<input type="search" id="ecdysiz-search-input" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" />
	<button type="submit"><?php esc_html_e( 'Search', 'ecdysiz-core' ); ?></button>
</form>