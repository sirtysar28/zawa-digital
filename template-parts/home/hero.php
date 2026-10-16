<?php
/**
 * Homepage — Hero: big image + descriptive text.
 *
 * @package Zawa_Digital
 */

$hero_image_id = (int) get_theme_mod( 'zawa_hero_image' );
?>
<section class="zawa-hero">
	<div class="zawa-blob zawa-blob--blue" aria-hidden="true"></div>
	<div class="zawa-blob zawa-blob--yellow" aria-hidden="true"></div>
	<div class="zawa-blob zawa-blob--green" aria-hidden="true"></div>

	<div class="zawa-container zawa-hero__inner">

		<div class="zawa-hero__content">
			<?php $badge = zawa_get_option( 'zawa_hero_badge' ); ?>
			<?php if ( $badge ) : ?>
				<p class="zawa-eyebrow"><span class="zawa-eyebrow__dot" aria-hidden="true"></span><?php echo esc_html( $badge ); ?></p>
			<?php endif; ?>

			<h1 class="zawa-hero__title"><?php echo wp_kses_post( zawa_get_option( 'zawa_hero_title' ) ); ?></h1>
			<p class="zawa-hero__text"><?php echo wp_kses_post( zawa_get_option( 'zawa_hero_text' ) ); ?></p>

			<div class="zawa-hero__actions">
				<a class="zawa-btn zawa-btn--primary" href="<?php echo esc_url( get_theme_mod( 'zawa_hero_btn_url' ) ? get_theme_mod( 'zawa_hero_btn_url' ) : zawa_quote_url() ); ?>">
					<?php echo esc_html( zawa_get_option( 'zawa_hero_btn_text' ) ); ?>
					<?php echo zawa_icon( 'arrow', 18 ); ?>
				</a>
				<a class="zawa-btn zawa-btn--ghost" href="<?php echo esc_url( get_theme_mod( 'zawa_hero_btn2_url' ) ? get_theme_mod( 'zawa_hero_btn2_url' ) : home_url( '/services/' ) ); ?>">
					<?php echo esc_html( zawa_get_option( 'zawa_hero_btn2_text' ) ); ?>
				</a>
			</div>
		</div>

		<div class="zawa-hero__media">
			<div class="zawa-hero__frame">
				<?php
				if ( $hero_image_id ) {
					echo wp_get_attachment_image( $hero_image_id, 'zawa-wide', false, array( 'class' => 'zawa-hero__img' ) );
				} else {
					// Placeholder gradient bermerek (tanpa gambar eksternal).
					?>
					<div class="zawa-hero__placeholder" role="img" aria-label="<?php esc_attr_e( 'Ilustrasi tim ZAWA Digital sedang bekerja', 'zawa-digital' ); ?>">
						<div class="zawa-hero__ph-card">
							<span class="zawa-hero__ph-bar" style="width:70%"></span>
							<span class="zawa-hero__ph-bar" style="width:45%"></span>
							<span class="zawa-hero__ph-chip"></span>
						</div>
						<div class="zawa-hero__ph-float zawa-hero__ph-float--1"><strong>SEO</strong><span>+128%</span></div>
						<div class="zawa-hero__ph-float zawa-hero__ph-float--2"><strong>Apps</strong><span>iOS &amp; Android</span></div>
					</div>
					<?php
				}
				?>
			</div>
		</div>

	</div>
</section>
