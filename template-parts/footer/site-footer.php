<?php
/**
 * Site footer — kontak, menu, sosial, copyright.
 *
 * @package Zawa_Digital
 */
?>
<footer class="zawa-footer">
	<div class="zawa-container">

		<div class="zawa-footer__grid">

			<div class="zawa-footer__brand">
				<?php zawa_site_logo(); ?>
				<p class="zawa-footer__about"><?php echo wp_kses_post( zawa_get_option( 'zawa_footer_about' ) ); ?></p>
				<div class="zawa-footer__social">
					<?php foreach ( zawa_footer_socials() as $social ) : ?>
						<?php if ( empty( $social['url'] ) ) { continue; } ?>
						<?php $s_name = $social['name'] ? $social['name'] : ucfirst( $social['icon'] ); ?>
						<a href="<?php echo esc_url( $social['url'] ); ?>" target="_blank" rel="noopener nofollow" aria-label="<?php echo esc_attr( $s_name ); ?>" title="<?php echo esc_attr( $s_name ); ?>">
							<?php echo zawa_icon( $social['icon'], 20 ); ?>
						</a>
					<?php endforeach; ?>
				</div>
			</div>

			<div class="zawa-footer__contact">
				<h3 class="zawa-footer__title"><?php esc_html_e( 'Contact us', 'zawa-digital' ); ?></h3>
				<ul>
					<li>
						<?php echo zawa_icon( 'whatsapp', 20 ); ?>
						<a href="<?php echo esc_url( zawa_whatsapp_link( 'Halo ZAWA Digital!' ) ); ?>" target="_blank" rel="noopener"><?php echo esc_html( zawa_format_phone( zawa_get_option( 'zawa_wa_number' ) ) ); ?></a>
					</li>
					<li>
						<?php echo zawa_icon( 'mail', 20 ); ?>
						<a href="mailto:<?php echo esc_attr( antispambot( zawa_get_option( 'zawa_email' ) ) ); ?>"><?php echo esc_html( antispambot( zawa_get_option( 'zawa_email' ) ) ); ?></a>
					</li>
					<li>
						<?php echo zawa_icon( 'pin', 20 ); ?>
						<span><?php echo wp_kses_post( zawa_get_option( 'zawa_address' ) ); ?></span>
					</li>
				</ul>
			</div>

			<div class="zawa-footer__menu">
				<h3 class="zawa-footer__title"><?php esc_html_e( 'Menu', 'zawa-digital' ); ?></h3>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'menu_class'     => 'zawa-footer__nav',
					'container'      => false,
					'fallback_cb'    => 'zawa_nav_fallback',
					'depth'          => 1,
				) );
				?>
			</div>

		</div>

		<div class="zawa-footer__bottom">
			<p class="zawa-footer__copy">
				<?php
				$copy = zawa_get_option( 'zawa_copyright' );
				echo wp_kses_post( str_replace( '{year}', gmdate( 'Y' ), $copy ) );
				?>
			</p>
			<a class="zawa-footer__backtop" href="#masthead"><?php esc_html_e( 'Back to top', 'zawa-digital' ); ?> <?php echo zawa_icon( 'arrow', 18 ); ?></a>
		</div>

	</div>
</footer>
