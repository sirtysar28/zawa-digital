<?php
/**
 * Kartu artikel: judul, featured image, excerpt.
 *
 * @package Zawa_Digital
 */
?>
<article <?php post_class( 'zawa-post-card zawa-reveal' ); ?>>
	<a class="zawa-post-card__media" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php the_post_thumbnail( 'zawa-card', array( 'class' => 'zawa-post-card__img' ) ); ?>
		<?php else : ?>
			<div class="zawa-post-card__placeholder" aria-hidden="true"><?php echo zawa_icon( 'spark', 40 ); ?></div>
		<?php endif; ?>
	</a>

	<div class="zawa-post-card__body">
		<?php zawa_posted_on(); ?>
		<h2 class="zawa-post-card__title">
			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		</h2>
		<p class="zawa-post-card__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
		<a class="zawa-link-more" href="<?php the_permalink(); ?>">
			<?php esc_html_e( 'Read more', 'zawa-digital' ); ?> <?php echo zawa_icon( 'arrow', 16 ); ?>
		</a>
	</div>
</article>
