<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="bg-white rounded-2xl border border-slate-200/80 p-8 sm:p-12 text-center max-w-xl mx-auto my-12">
	<div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-indigo-50 text-indigo-600 mb-4">
		<svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
			<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
		</svg>
	</div>

	<h1 class="text-2xl font-bold text-slate-900 mb-2">
		<?php esc_html_e( 'Nothing Found', 'robin' ); ?>
	</h1>

	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		<p class="text-slate-600 mb-6">
			<?php
			printf(
				/* translators: 1: link to WP admin new post page. */
				esc_html__( 'Ready to publish your first post? %1$sGet started here%2$s.', 'robin' ),
				'<a href="' . esc_url( admin_url( 'post-new.php' ) ) . '" class="text-indigo-600 font-semibold hover:underline">',
				'</a>'
			);
			?>
		</p>
	<?php elseif ( is_search() ) : ?>
		<p class="text-slate-600 mb-6">
			<?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'robin' ); ?>
		</p>
		<div class="max-w-md mx-auto">
			<?php get_search_form(); ?>
		</div>
	<?php else : ?>
		<p class="text-slate-600 mb-6">
			<?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'robin' ); ?>
		</p>
		<div class="max-w-md mx-auto">
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>
</section>
