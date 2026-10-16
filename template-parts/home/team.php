<?php
/**
 * Homepage — Teams: 3 kartu horizontal (foto, nama, jabatan).
 *
 * @package Zawa_Digital
 */
?>
<section class="zawa-section zawa-section--soft zawa-team" id="team">
	<div class="zawa-container">

		<div class="zawa-section__head">
			<p class="zawa-eyebrow"><span class="zawa-eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'People', 'zawa-digital' ); ?></p>
			<h2 class="zawa-section__title"><?php echo wp_kses_post( zawa_get_option( 'zawa_team_title' ) ); ?></h2>
			<p class="zawa-section__sub"><?php echo wp_kses_post( zawa_get_option( 'zawa_team_sub' ) ); ?></p>
		</div>

		<div class="zawa-team__grid">
			<?php for ( $i = 1; $i <= 3; $i++ ) : ?>
				<?php
				$name   = zawa_get_option( "zawa_team{$i}_n" );
				$role   = zawa_get_option( "zawa_team{$i}_t" );
				$img_id = (int) get_theme_mod( "zawa_team{$i}_img" );
				if ( ! $name && ! $role && ! $img_id ) {
					continue;
				}
				?>
				<article class="zawa-team-card zawa-reveal" style="--zawa-delay:<?php echo esc_attr( ( $i - 1 ) * 0.1 ); ?>s">
					<div class="zawa-team-card__photo">
						<?php if ( $img_id ) : ?>
							<?php echo wp_get_attachment_image( $img_id, 'zawa-portrait', false, array( 'class' => 'zawa-team-card__img' ) ); ?>
						<?php else : ?>
							<div class="zawa-team-card__placeholder" aria-hidden="true">
								<?php echo esc_html( strtoupper( substr( (string) $name, 0, 1 ) ) ); ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="zawa-team-card__meta">
						<h3 class="zawa-team-card__name"><?php echo esc_html( $name ); ?></h3>
						<p class="zawa-team-card__role"><?php echo esc_html( $role ); ?></p>
					</div>
				</article>
			<?php endfor; ?>
		</div>

	</div>
</section>
