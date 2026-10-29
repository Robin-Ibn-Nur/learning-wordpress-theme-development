<?php
/**
 * Custom template tags for Robin theme
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Prints HTML with meta information for the current post-date/time.
 */
function robin_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated hidden" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( DATE_W3C ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="inline-flex items-center text-xs font-medium text-slate-500">' . $time_string . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Prints HTML with meta information for the current author.
 */
function robin_posted_by() {
	echo '<span class="inline-flex items-center text-xs font-medium text-slate-600">';
	echo esc_html__( 'By ', 'robin' );
	echo '<a href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '" class="ml-1 font-semibold text-slate-800 hover:text-indigo-600 transition">';
	echo esc_html( get_the_author() );
	echo '</a></span>';
}

/**
 * Prints categories list for current post.
 */
function robin_entry_categories() {
	$categories_list = get_the_category_list( ' ' );
	if ( $categories_list ) {
		echo '<div class="flex flex-wrap gap-1.5 mb-2">';
		// Custom format categories as badges
		$categories = get_the_category();
		foreach ( $categories as $cat ) {
			printf(
				'<a href="%1$s" class="inline-flex items-center rounded-full bg-indigo-50 px-2.5 py-0.5 text-xs font-medium text-indigo-700 hover:bg-indigo-100 transition">%2$s</a>',
				esc_url( get_category_link( $cat->term_id ) ),
				esc_html( $cat->name )
			);
		}
		echo '</div>';
	}
}

/**
 * Render pagination with Tailwind styling
 */
function robin_pagination() {
	the_posts_pagination( array(
		'mid_size'  => 2,
		'prev_text' => __( '&larr; Previous', 'robin' ),
		'next_text' => __( 'Next &rarr;', 'robin' ),
		'class'     => 'robin-pagination flex justify-center my-10',
	) );
}
