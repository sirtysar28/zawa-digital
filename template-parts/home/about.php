<?php
/**
 * Homepage — About Us: 3 paragraf + gambar pendukung.
 *
 * @package Zawa_Digital
 */

$about_image_id = (int) get_theme_mod( 'zawa_about_image' );
?>
<section class="zawa-section zawa-about" id="about">
	<div class="zawa-container zawa-about__inner">

		<div class="zawa-about__media">
			<?php if ( $about_image_id ) : ?>
				<?php echo wp_get_attachment_image( $about_image_id, 'zawa-portrait', false, array( 'class' => 'zawa-about__img' ) ); ?>
			<?php else : ?>
				<div class="zawa-about__placeholder" aria-hidden="true">
					<div class="zawa-about__ph-quote">&ldquo;<?php esc_html_e( 'A relentless passion for understanding our clients&rsquo; needs.', 'zawa-digital' ); ?>&rdquo;</div>
					<div class="zawa-about__ph-stats">
						<div><strong>10+</strong><span><?php esc_html_e( 'Years in strategy', 'zawa-digital' ); ?></span></div>
						<div><strong>∞</strong><span><?php esc_html_e( 'Curiosity', 'zawa-digital' ); ?></span></div>
					</div>
				</div>
			<?php endif; ?>
		</div>

		<div class="zawa-about__content">
			<p class="zawa-eyebrow"><span class="zawa-eyebrow__dot" aria-hidden="true"></span><?php echo esc_html( zawa_get_option( 'zawa_about_title' ) ); ?></p>
			<h2 class="zawa-section__title zawa-section__title--left"><?php echo wp_kses_post( zawa_get_option( 'zawa_about_sub' ) ); ?></h2>
			<div class="zawa-about__text">
				<p><?php echo wp_kses_post( zawa_get_option( 'zawa_about_p1' ) ); ?></p>
				<p><?php echo wp_kses_post( zawa_get_option( 'zawa_about_p2' ) ); ?></p>
				<p><?php echo wp_kses_post( zawa_get_option( 'zawa_about_p3' ) ); ?></p>
			</div>
		</div>

	</div>
</section>
