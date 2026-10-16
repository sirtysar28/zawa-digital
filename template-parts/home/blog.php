<?php
/**
 * Homepage — Latest articles: 3 kartu postingan terbaru
 * + tombol "More Info" menuju halaman Blog.
 *
 * @package Zawa_Digital
 */

$zawa_blog_query = new WP_Query( array(
	'post_type'           => 'post',
	'posts_per_page'      => 3,
	'ignore_sticky_posts' => true,
	'no_found_rows'       => true,
) );

// Section disembunyikan total bila belum ada artikel.
if ( ! $zawa_blog_query->have_posts() ) {
	return;
}

// URL halaman Blog: pakai "Posts page" bila diatur, jika tidak /blog/.
$zawa_blog_page_id = (int) get_option( 'page_for_posts' );
$zawa_blog_url     = $zawa_blog_page_id ? get_permalink( $zawa_blog_page_id ) : home_url( '/blog/' );
?>
<section class="zawa-section zawa-homeblog" id="blog">
	<div class="zawa-container">

		<div class="zawa-section__head">
			<p class="zawa-eyebrow"><span class="zawa-eyebrow__dot" aria-hidden="true"></span><?php esc_html_e( 'Blog', 'zawa-digital' ); ?></p>
			<h2 class="zawa-section__title"><?php esc_html_e( 'Latest articles', 'zawa-digital' ); ?></h2>
			<p class="zawa-section__sub"><?php esc_html_e( 'Insights, tips & updates from the ZAWA Digital team.', 'zawa-digital' ); ?></p>
		</div>

		<div class="zawa-posts-grid zawa-homeblog__grid">
			<?php
			while ( $zawa_blog_query->have_posts() ) :
				$zawa_blog_query->the_post();
				get_template_part( 'template-parts/content/card' );
			endwhile;
			wp_reset_postdata();
			?>
		</div>

		<div class="zawa-section__more">
			<a class="zawa-btn zawa-btn--primary" href="<?php echo esc_url( $zawa_blog_url ); ?>">
				<?php esc_html_e( 'More Info', 'zawa-digital' ); ?>
				<?php echo zawa_icon( 'arrow', 18 ); ?>
			</a>
		</div>

	</div>
</section>
