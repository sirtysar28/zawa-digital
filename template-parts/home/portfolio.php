<?php
/**
 * Homepage — Portfolio: 4 item vertikal, gambar di kiri.
 *
 * @package Zawa_Digital
 */
?>
<section class="zawa-section zawa-section--soft zawa-portfolio" id="works">
	<div class="zawa-container">

		<div class="zawa-section__head">
			<p class="zawa-eyebrow"><span class="zawa-eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Case studies', 'zawa-digital' ); ?></p>
			<h2 class="zawa-section__title"><?php echo wp_kses_post( zawa_get_option( 'zawa_port_title' ) ); ?></h2>
			<p class="zawa-section__sub"><?php echo wp_kses_post( zawa_get_option( 'zawa_port_sub' ) ); ?></p>
		</div>

		<div class="zawa-portfolio__list">
			<?php for ( $i = 1; $i <= 4; $i++ ) : ?>
				<?php
				$title = zawa_get_option( "zawa_port{$i}_t" );
				if ( ! $title ) {
					continue;
				}
				$img_id = (int) get_theme_mod( "zawa_port{$i}_img" );
				$url    = get_theme_mod( "zawa_port{$i}_url" );
				?>
				<article class="zawa-work zawa-reveal" style="--zawa-delay:<?php echo esc_attr( ( $i - 1 ) * 0.06 ); ?>s">
					<div class="zawa-work__media">
						<?php if ( $img_id ) : ?>
							<?php echo wp_get_attachment_image( $img_id, 'zawa-card', false, array( 'class' => 'zawa-work__img' ) ); ?>
						<?php else : ?>
							<div class="zawa-work__placeholder zawa-work__placeholder--<?php echo esc_attr( $i ); ?>" aria-hidden="true">
								<span><?php echo esc_html( wp_strip_all_tags( $title ) ); ?></span>
							</div>
						<?php endif; ?>
					</div>
					<div class="zawa-work__body">
						<span class="zawa-work__num"><?php echo esc_html( sprintf( '%02d', $i ) ); ?></span>
						<h3 class="zawa-work__title"><?php echo wp_kses_post( $title ); ?></h3>
						<p class="zawa-work__desc"><?php echo wp_kses_post( zawa_get_option( "zawa_port{$i}_d" ) ); ?></p>
						<?php if ( $url ) : ?>
							<a class="zawa-link-more" href="<?php echo esc_url( $url ); ?>">
								<?php esc_html_e( 'View case study', 'zawa-digital' ); ?> <?php echo zawa_icon( 'arrow', 16 ); ?>
							</a>
						<?php endif; ?>
					</div>
				</article>
			<?php endfor; ?>
		</div>

	</div>
</section>
