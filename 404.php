<?php
/**
 * 404 — halaman tidak ditemukan.
 *
 * @package Zawa_Digital
 */

get_header();
?>

<div class="zawa-container zawa-404">
	<p class="zawa-404__code" aria-hidden="true">4<span class="zawa-404__zero"></span>4</p>
	<h1 class="zawa-404__title"><?php esc_html_e( 'Page not found', 'zawa-digital' ); ?></h1>
	<p class="zawa-404__text"><?php esc_html_e( 'The page you are looking for doesn&rsquo;t exist or has been moved.', 'zawa-digital' ); ?></p>
	<div class="zawa-404__actions">
		<a class="zawa-btn zawa-btn--primary" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php echo zawa_icon( 'arrow', 18 ); ?>
			<?php esc_html_e( 'Back to homepage', 'zawa-digital' ); ?>
		</a>
	</div>
	<div class="zawa-404__search"><?php get_search_form(); ?></div>
</div>

<?php
get_footer();
