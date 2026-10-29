<?php
/**
 * The template for displaying comments
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-10 mt-10">

	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title text-2xl font-bold text-slate-900 mb-6 pb-4 border-b border-slate-100">
			<?php
			$robin_comment_count = get_comments_number();
			if ( '1' === $robin_comment_count ) {
				printf(
					/* translators: 1: title. */
					esc_html__( 'One comment on &ldquo;%1$s&rdquo;', 'robin' ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			} else {
				printf(
					/* translators: 1: comment count number, 2: title. */
					esc_html( _nx( '%1$s comment on &ldquo;%2$s&rdquo;', '%1$s comments on &ldquo;%2$s&rdquo;', $robin_comment_count, 'comments title', 'robin' ) ),
					number_format_i18n( $robin_comment_count ),
					'<span>' . wp_kses_post( get_the_title() ) . '</span>'
				);
			}
			?>
		</h2>

		<ol class="comment-list space-y-6 mb-8">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size'=> 48,
				)
			);
			?>
		</ol>

		<?php
		the_comments_navigation(
			array(
				'prev_text' => __( '&larr; Older Comments', 'robin' ),
				'next_text' => __( 'Newer Comments &rarr;', 'robin' ),
			)
		);
		?>

	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments text-sm text-slate-500 italic"><?php esc_html_e( 'Comments are closed.', 'robin' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_container'     => 'comment-respond mt-8 pt-6 border-t border-slate-100',
			'title_reply_before'  => '<h3 id="reply-title" class="comment-reply-title text-xl font-bold text-slate-900 mb-4">',
			'title_reply_after'   => '</h3>',
			'class_submit'        => 'px-6 py-2.5 rounded-xl bg-indigo-600 text-white font-semibold text-sm hover:bg-indigo-700 transition cursor-pointer shadow-xs',
		)
	);
	?>

</div>
