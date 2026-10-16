<?php
/**
 * Halaman depan.
 *
 * Bila halaman depan dibangun dengan Elementor, kontennya dirender
 * full-width tanpa pembungkus theme — bebas kustom total.
 * Bila belum, theme menampilkan homepage default (Hero, Services 2×2,
 * Portfolio, About Us, Teams, CTA) yang kontennya bisa diubah
 * lewat Appearance → Customize.
 *
 * @package Zawa_Digital
 */

get_header();

if ( zawa_is_elementor_page() ) :
	/* ---------------- Homepage via ELEMENTOR ---------------- */
	while ( have_posts() ) :
		the_post();
		?>
		<div class="zawa-elementor-canvas">
			<?php the_content(); ?>
		</div>
		<?php
	endwhile;
else :
	/* ---------------- Homepage default theme ---------------- */
	get_template_part( 'template-parts/home/hero' );
	get_template_part( 'template-parts/home/about' );
	get_template_part( 'template-parts/home/services' );
	get_template_part( 'template-parts/home/portfolio' );
	get_template_part( 'template-parts/home/team' );
	get_template_part( 'template-parts/home/blog' );
	get_template_part( 'template-parts/home/cta' );
endif;

get_footer();
