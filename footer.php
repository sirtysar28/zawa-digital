<?php
/**
 * The footer for our theme.
 *
 * @package Zawa_Digital
 */
?>
</main><!-- .zawa-site-main -->

<?php
// Jika Elementor Pro Theme Builder meng-override lokasi "footer", pakai itu.
if ( ! function_exists( 'elementor_theme_do_location' ) || ! elementor_theme_do_location( 'footer' ) ) {
	get_template_part( 'template-parts/footer/site-footer' );
}

// Floating button "Request Quote" (bisa dimatikan dari Customizer).
// Dibungkus .zawa-float-btn-wrap yang memakai rumus container sama persis
// (max-width + margin auto + padding identik .zawa-container) supaya posisinya
// SELALU sejajar margin konten di semua ukuran layar.
if ( (int) zawa_get_option( 'zawa_float_enable' ) ) :
	?>
	<div class="zawa-float-btn-wrap">
		<a class="zawa-float-btn" href="<?php echo esc_url( zawa_quote_url() ); ?>">
			<?php echo zawa_icon( 'spark', 22 ); ?>
			<span class="zawa-float-btn__label"><?php echo esc_html( zawa_get_option( 'zawa_float_label' ) ); ?></span>
		</a>
	</div>
	<?php
endif;
?>

<?php wp_footer(); ?>
</body>
</html>
