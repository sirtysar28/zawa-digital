<?php
/**
 * Form pencarian.
 *
 * @package Zawa_Digital
 */
?>
<form role="search" method="get" class="zawa-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="zawa-search-field"><?php esc_html_e( 'Search for:', 'zawa-digital' ); ?></label>
	<input type="search" id="zawa-search-field" class="zawa-search-form__input" placeholder="<?php esc_attr_e( 'Search…', 'zawa-digital' ); ?>" value="<?php echo get_search_query(); ?>" name="s">
	<button type="submit" class="zawa-search-form__btn" aria-label="<?php esc_attr_e( 'Search', 'zawa-digital' ); ?>">
		<svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
	</button>
</form>
