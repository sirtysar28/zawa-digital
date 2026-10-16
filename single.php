<?php
/**
 * Artikel tunggal (blog post).
 *
 * @package Zawa_Digital
 */

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<div class="zawa-page-hero zawa-page-hero--post">
		<div class="zawa-container">
			<?php
			$categories = get_the_category();
			if ( $categories ) {
				echo '<p class="zawa-eyebrow"><span class="zawa-eyebrow__dot" aria-hidden="true"></span>' . esc_html( $categories[0]->name ) . '</p>';
			}
			?>
			<h1 class="zawa-page-hero__title"><?php the_title(); ?></h1>
			<?php zawa_posted_on(); ?>
		</div>
	</div>

	<div class="zawa-container zawa-entry-layout">

		<article id="post-<?php the_ID(); ?>" <?php post_class( 'zawa-entry zawa-entry--single' ); ?>>

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

			<?php the_tags( '<footer class="zawa-entry__tags"><span class="screen-reader-text">' . esc_html__( 'Tags:', 'zawa-digital' ) . '</span>', '', '</footer>' ); ?>

		</article>

		<nav class="zawa-post-nav" aria-label="<?php esc_attr_e( 'Post navigation', 'zawa-digital' ); ?>">
			<?php
			previous_post_link( '<div class="zawa-post-nav__prev"><span>' . esc_html__( 'Previous article', 'zawa-digital' ) . '</span>%link</div>', '%title' );
			next_post_link( '<div class="zawa-post-nav__next"><span>' . esc_html__( 'Next article', 'zawa-digital' ) . '</span>%link</div>', '%title' );
			?>
		</nav>

		<?php
		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
		?>

	</div>

	<?php
endwhile;

get_footer();
