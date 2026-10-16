<?php
/**
 * Arsip (kategori, tag, penulis, tanggal).
 *
 * @package Zawa_Digital
 */

get_header();
?>

<div class="zawa-page-hero">
	<div class="zawa-container">
		<h1 class="zawa-page-hero__title"><?php the_archive_title(); ?></h1>
		<?php the_archive_description( '<p class="zawa-page-hero__sub">', '</p>' ); ?>
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
				<h2><?php esc_html_e( 'Nothing found', 'zawa-digital' ); ?></h2>
				<p><?php esc_html_e( 'Try another search term.', 'zawa-digital' ); ?></p>
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
