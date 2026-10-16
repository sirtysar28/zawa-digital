<?php
/**
 * Halaman (Services, Case Studies, dll).
 * Halaman yang dibangun dengan Elementor otomatis dirender full-width.
 *
 * @package Zawa_Digital
 */

get_header();

while ( have_posts() ) :
	the_post();

	if ( zawa_is_elementor_page() ) :
		?>
		<div class="zawa-elementor-canvas">
			<?php the_content(); ?>
		</div>
		<?php
	else :
		?>
		<div class="zawa-page-hero">
			<div class="zawa-container">
				<?php
				$show_title = apply_filters( 'zawa_show_page_title', true );
				if ( $show_title ) :
					?>
					<h1 class="zawa-page-hero__title"><?php the_title(); ?></h1>
				<?php endif; ?>
			</div>
		</div>

		<div class="zawa-container zawa-entry-layout">
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'zawa-entry' ); ?>>
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="zawa-entry__thumb"><?php the_post_thumbnail( 'zawa-wide' ); ?></div>
				<?php endif; ?>

				<div class="zawa-entry__content">
					<?php
					the_content();
					wp_link_pages( array(
						'before' => '<nav class="zawa-page-links">' . esc_html__( 'Pages:', 'zawa-digital' ),
						'after'  => '</nav>',
					) );
					?>
				</div>
			</article>

			<?php
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			?>
		</div>
		<?php
	endif;

endwhile;

get_footer();
