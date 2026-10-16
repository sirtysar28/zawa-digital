<?php
/**
 * Blog / halaman daftar artikel.
 *
 * @package Zawa_Digital
 */

get_header();
?>

<div class="zawa-page-hero">
	<div class="zawa-container">
		<h1 class="zawa-page-hero__title">
			<?php
			if ( is_home() && ! is_front_page() ) {
				single_post_title();
			} else {
				esc_html_e( 'Blog', 'zawa-digital' );
			}
			?>
		</h1>
		<p class="zawa-page-hero__sub"><?php esc_html_e( 'Insights, updates & stories from the ZAWA Digital team.', 'zawa-digital' ); ?></p>
	</div>
</div>

<div class="zawa-container zawa-layout <?php echo zawa_has_sidebar() ? 'zawa-layout--with-sidebar' : ''; ?>">

	<div id="primary" class="zawa-layout__main">
		<?php if ( have_posts() ) : ?>
			<div class="zawa-posts-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/card' );
				endwhile;
				?>
			</div>
			<?php
			the_posts_pagination( array(
				'mid_size'  => 1,
				'prev_text' => '&larr; ' . __( 'Previous', 'zawa-digital' ),
				'next_text' => __( 'Next', 'zawa-digital' ) . ' &rarr;',
			) );
			?>
		<?php else : ?>
			<div class="zawa-empty">
				<h2><?php esc_html_e( 'No posts yet', 'zawa-digital' ); ?></h2>
				<p><?php esc_html_e( 'Stay tuned — articles are coming soon.', 'zawa-digital' ); ?></p>
			</div>
		<?php endif; ?>
	</div>

	<?php if ( zawa_has_sidebar() ) : ?>
		<aside class="zawa-layout__sidebar">
			<?php dynamic_sidebar( 'sidebar-1' ); ?>
		</aside>
	<?php endif; ?>

</div>

<?php
get_footer();
