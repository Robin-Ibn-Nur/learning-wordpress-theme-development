<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="flex-grow flex items-center justify-center py-16 sm:py-24">
	<div class="max-w-xl mx-auto px-4 text-center">
		<span class="inline-block text-6xl sm:text-8xl font-black text-indigo-600 tracking-tight mb-4">404</span>
		<h1 class="text-3xl sm:text-4xl font-extrabold text-slate-900 mb-3">
			<?php esc_html_e( 'Page Not Found', 'robin' ); ?>
		</h1>
		<p class="text-slate-600 text-base sm:text-lg mb-8 leading-relaxed">
			<?php esc_html_e( 'Oops! The page you are looking for doesn’t exist, has been removed, or is temporarily unavailable.', 'robin' ); ?>
		</p>

		<div class="max-w-md mx-auto mb-8">
			<?php get_search_form(); ?>
		</div>

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-indigo-600 text-white font-semibold text-sm hover:bg-indigo-700 transition shadow-sm">
			<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
			</svg>
			<?php esc_html_e( 'Back to Homepage', 'robin' ); ?>
		</a>
	</div>
</main>

<?php
get_footer();
