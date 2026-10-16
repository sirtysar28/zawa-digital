<?php
/**
 * Hasil pencarian.
 *
 * @package Zawa_Digital
 */

get_header();
?>

<div class="zawa-page-hero">
	<div class="zawa-container">
		<h1 class="zawa-page-hero__title">
			<?php
			printf( esc_html__( 'Search: %s', 'zawa-digital' ), '<span>&ldquo;' . get_search_query() . '&rdquo;</span>' );
			?>
		</h1>
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
				<h2><?php esc_html_e( 'No results', 'zawa-digital' ); ?></h2>
				<p><?php esc_html_e( 'Nothing matched your search. Try again?', 'zawa-digital' ); ?></p>
				<?php get_search_form(); ?>
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
