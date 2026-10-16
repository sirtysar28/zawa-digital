<?php
/**
 * Area komentar.
 *
 * @package Zawa_Digital
 */

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="zawa-comments">

	<?php if ( have_comments() ) : ?>
		<h2 class="zawa-comments__title">
			<?php
			$count = get_comments_number();
			printf(
				esc_html( _n( '%s Comment', '%s Comments', $count, 'zawa-digital' ) ),
				esc_html( number_format_i18n( $count ) )
			);
			?>
		</h2>

		<ol class="zawa-comments__list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_ping'  => true,
				'avatar_size' => 44,
			) );
			?>
		</ol>

		<?php
		the_comments_navigation( array(
			'prev_text' => '&larr; ' . __( 'Previous', 'zawa-digital' ),
			'next_text' => __( 'Next', 'zawa-digital' ) . ' &rarr;',
		) );

		if ( ! comments_open() ) :
			?>
			<p class="zawa-comments__closed"><?php esc_html_e( 'Comments are closed.', 'zawa-digital' ); ?></p>
			<?php
		endif;

	endif;

	comment_form( array(
		'title_reply'         => __( 'Leave a comment', 'zawa-digital' ),
		'class_submit'        => 'zawa-btn zawa-btn--primary',
		'comment_notes_before' => '',
	) );
	?>

</div>
