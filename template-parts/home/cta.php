<?php
/**
 * Homepage — CTA band sebelum footer.
 *
 * @package Zawa_Digital
 */
?>
<section class="zawa-cta">
	<div class="zawa-container">
		<div class="zawa-cta__card">
			<div class="zawa-blob zawa-blob--yellow" aria-hidden="true"></div>
			<h2 class="zawa-cta__title"><?php echo wp_kses_post( zawa_get_option( 'zawa_cta_title' ) ); ?></h2>
			<p class="zawa-cta__text"><?php echo wp_kses_post( zawa_get_option( 'zawa_cta_text' ) ); ?></p>
			<div class="zawa-cta__actions">
				<a class="zawa-btn zawa-btn--light" href="<?php echo esc_url( zawa_quote_url() ); ?>">
					<?php echo esc_html( zawa_get_option( 'zawa_cta_btn' ) ); ?>
					<?php echo zawa_icon( 'arrow', 18 ); ?>
				</a>
				<a class="zawa-cta__wa" href="<?php echo esc_url( zawa_whatsapp_link( 'Halo ZAWA Digital, saya ingin diskusi proyek.' ) ); ?>" target="_blank" rel="noopener">
					<?php echo zawa_icon( 'whatsapp', 22 ); ?>
					<span><?php esc_html_e( 'or chat via WhatsApp', 'zawa-digital' ); ?></span>
				</a>
			</div>
		</div>
	</div>
</section>
