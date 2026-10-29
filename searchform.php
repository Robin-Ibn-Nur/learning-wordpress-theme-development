<?php
/**
 * Custom search form
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<form role="search" method="get" class="search-form flex items-center gap-2 w-full" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="sr-only" for="robin-search-field"><?php esc_html_e( 'Search for:', 'robin' ); ?></label>
	<div class="relative flex-grow">
		<div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-400">
			<svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
				<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
			</svg>
		</div>
		<input type="search" id="robin-search-field" class="search-field block w-full pl-9 pr-4 py-2.5 text-sm rounded-xl border border-slate-200 bg-white placeholder-slate-400 focus:outline-hidden focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition" placeholder="<?php echo esc_attr_x( 'Search articles, topics&hellip;', 'placeholder', 'robin' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</div>
	<button type="submit" class="search-submit px-4 py-2.5 bg-indigo-600 text-white text-sm font-semibold rounded-xl hover:bg-indigo-700 transition shadow-xs">
		<?php esc_html_e( 'Search', 'robin' ); ?>
	</button>
</form>
