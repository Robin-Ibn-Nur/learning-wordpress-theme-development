<?php
/**
 * Robin theme functions and definitions
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'robin_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 */
	function robin_setup() {
		// Make theme available for translation.
		load_theme_textdomain( 'robin', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 675, true ); // 16:9 ratio

		// Register Navigation Menus
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Navigation Menu', 'robin' ),
				'footer'  => esc_html__( 'Footer Menu', 'robin' ),
			)
		);

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add support for core custom logo.
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 80,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'robin_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function robin_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'robin_content_width', 1140 );
}
add_action( 'after_setup_theme', 'robin_content_width', 0 );

/**
 * Register widget area.
 */
function robin_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'robin' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'robin' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s bg-white p-6 rounded-2xl border border-slate-100 shadow-xs mb-6">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title text-lg font-bold text-slate-900 mb-4 pb-2 border-b border-slate-100">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 1', 'robin' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Widgets for footer column 1.', 'robin' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer Column 2', 'robin' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Widgets for footer column 2.', 'robin' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s mb-6">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="text-sm font-semibold text-slate-900 uppercase tracking-wider mb-3">',
			'after_title'   => '</h3>',
		)
	);
}
add_action( 'widgets_init', 'robin_widgets_init' );

/**
 * Load template tags & helpers
 */
require_once get_template_directory() . '/inc/template-tags.php';

/**
 * Load theme defaults and options helpers
 */
require_once get_template_directory() . '/inc/theme-defaults.php';

/**
 * Load Vélora Product Custom Post Type & Meta Boxes
 */
require_once get_template_directory() . '/inc/post-types.php';

/**
 * Load Dynamic Typography, Colors & Dimensions
 */
require_once get_template_directory() . '/inc/dynamic-styles.php';

/**
 * Load live customizer integration
 */
require_once get_template_directory() . '/inc/customizer.php';

/**
 * Load admin theme options page
 */
require_once get_template_directory() . '/inc/theme-options.php';

/**
 * Load Vite asset bundler integration
 */
require_once get_template_directory() . '/inc/vite.php';
