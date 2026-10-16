<?php
/**
 * Homepage — Services: grid 2×2.
 *
 * @package Zawa_Digital
 */

$icons  = array( 'spark', 'globe', 'services', 'whatsapp' );
$colors = array( 'coral', 'blue', 'yellow', 'green' );
?>
<section class="zawa-section zawa-services" id="services">
	<div class="zawa-container">

		<div class="zawa-section__head">
			<p class="zawa-eyebrow"><span class="zawa-eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Services', 'zawa-digital' ); ?></p>
			<h2 class="zawa-section__title"><?php echo wp_kses_post( zawa_get_option( 'zawa_services_title' ) ); ?></h2>
			<p class="zawa-section__sub"><?php echo wp_kses_post( zawa_get_option( 'zawa_services_sub' ) ); ?></p>
		</div>

		<div class="zawa-services__grid">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<article class="zawa-service-card zawa-reveal" style="--zawa-delay:<?php echo esc_attr( ( $i - 1 ) * 0.08 ); ?>s">
					<div class="zawa-service-card__icon zawa-service-card__icon--<?php echo esc_attr( $colors[ $i - 1 ] ); ?>">
						<?php echo zawa_icon( $icons[ $i - 1 ], 26 ); ?>
					</div>
					<h3 class="zawa-service-card__title"><?php echo wp_kses_post( zawa_get_option( "zawa_service{$i}_t" ) ); ?></h3>
					<p class="zawa-service-card__desc"><?php echo wp_kses_post( zawa_get_option( "zawa_service{$i}_d" ) ); ?></p>
				</article>
			<?php endfor; ?>
		</div>

		<?php $services_url = get_theme_mod( 'zawa_services_url' ); ?>
		<div class="zawa-section__more">
			<a class="zawa-btn zawa-btn--ghost" href="<?php echo esc_url( $services_url ? $services_url : home_url( '/services/' ) ); ?>">
				<?php esc_html_e( 'All services', 'zawa-digital' ); ?>
				<?php echo zawa_icon( 'arrow', 18 ); ?>
			</a>
		</div>

	</div>
</section>
