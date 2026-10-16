<?php
/**
 * Site header — sticky (bisa diatur on/off via Customizer), glassy, responsif.
 *
 * @package Zawa_Digital
 */
?>
<header id="masthead" class="zawa-header">
	<div class="zawa-header__inner">

		<div class="zawa-header__brand">
			<?php zawa_site_logo(); ?>
		</div>

		<nav class="zawa-nav" id="zawa-nav" aria-label="<?php esc_attr_e( 'Primary Menu', 'zawa-digital' ); ?>">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'primary-menu',
				'menu_class'     => 'zawa-nav__menu',
				'container'      => false,
				'fallback_cb'    => 'zawa_nav_fallback',
				'depth'          => 2,
			) );
			?>

			<div class="zawa-nav__foot">
				<a class="zawa-btn zawa-btn--wa" href="<?php echo esc_url( zawa_whatsapp_link( __( 'Halo ZAWA Digital, saya ingin konsultasi proyek.', 'zawa-digital' ) ) ); ?>" target="_blank" rel="noopener">
					<?php echo zawa_icon( 'whatsapp', 18 ); ?>
					<span><?php esc_html_e( 'Chat via WhatsApp', 'zawa-digital' ); ?></span>
				</a>
			</div>
		</nav>
		<!-- /.zawa-nav -->

		<div class="zawa-header__actions">
			<button class="zawa-burger" id="zawa-burger" aria-expanded="false" aria-controls="zawa-nav" aria-label="<?php esc_attr_e( 'Buka menu', 'zawa-digital' ); ?>">
				<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'zawa-digital' ); ?></span>
				<?php echo zawa_icon( 'menu', 24 ); ?>
				<?php echo zawa_icon( 'close', 24 ); ?>
			</button>
		</div>

	</div>
</header>

<div class="zawa-nav__backdrop" id="zawa-nav-backdrop" aria-hidden="true"></div>
