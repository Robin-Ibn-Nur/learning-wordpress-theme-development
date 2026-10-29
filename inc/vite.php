<?php
/**
 * Vite integration for Robin theme
 *
 * Handles enqueuing assets in both development (HMR via Vite dev server)
 * and production (built assets from dist/ manifest).
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const ROBIN_VITE_SERVER = 'http://localhost:5173';

/**
 * Check if the Vite dev server is running
 *
 * @return bool
 */
function robin_is_vite_dev_server_running() {
	static $is_running = null;

	if ( null !== $is_running ) {
		return $is_running;
	}

	// Always default to false if explicitly disabled
	if ( defined( 'ROBIN_VITE_DEV' ) && ! ROBIN_VITE_DEV ) {
		$is_running = false;
		return false;
	}

	// Test connection to Vite dev server with short timeout
	$response = wp_remote_get( ROBIN_VITE_SERVER . '/@vite/client', array(
		'timeout'   => 0.3,
		'sslverify' => false,
	) );

	$is_running = ( ! is_wp_error( $response ) && 200 === wp_remote_retrieve_response_code( $response ) );
	return $is_running;
}

/**
 * Get manifest file data
 *
 * @return array
 */
function robin_get_vite_manifest() {
	static $manifest = null;

	if ( null !== $manifest ) {
		return $manifest;
	}

	// Vite 5+ places manifest in dist/.vite/manifest.json, earlier versions in dist/manifest.json
	$manifest_path = get_theme_file_path( 'dist/.vite/manifest.json' );
	if ( ! file_exists( $manifest_path ) ) {
		$manifest_path = get_theme_file_path( 'dist/manifest.json' );
	}

	if ( ! file_exists( $manifest_path ) ) {
		return array();
	}

	$content = file_get_contents( $manifest_path );
	$manifest = json_decode( $content, true );

	return is_array( $manifest ) ? $manifest : array();
}

/**
 * Enqueue Vite assets
 */
function robin_enqueue_vite_assets() {
	$theme_version = wp_get_theme()->get( 'Version' );

	if ( robin_is_vite_dev_server_running() ) {
		// --- DEV MODE ---
		// Enqueue Vite client for HMR
		wp_enqueue_script(
			'robin-vite-client',
			ROBIN_VITE_SERVER . '/@vite/client',
			array(),
			null,
			false
		);

		// Enqueue main JS entry (CSS is imported inside main.js)
		wp_enqueue_script(
			'robin-main',
			ROBIN_VITE_SERVER . '/src/main.js',
			array( 'robin-vite-client' ),
			null,
			true
		);
	} else {
		// --- PRODUCTION MODE ---
		$manifest = robin_get_vite_manifest();
		$entry_key = 'src/main.js';

		if ( isset( $manifest[ $entry_key ] ) ) {
			$entry = $manifest[ $entry_key ];

			// Enqueue production JS
			if ( ! empty( $entry['file'] ) ) {
				wp_enqueue_script(
					'robin-main',
					get_theme_file_uri( 'dist/' . $entry['file'] ),
					array(),
					$theme_version,
					true
				);
			}

			// Enqueue production CSS
			if ( ! empty( $entry['css'] ) && is_array( $entry['css'] ) ) {
				foreach ( $entry['css'] as $index => $css_file ) {
					wp_enqueue_style(
						'robin-main-style-' . $index,
						get_theme_file_uri( 'dist/' . $css_file ),
						array(),
						$theme_version
					);
				}
			}
		} else {
			// Fallback: enqueue style.css if no build exists yet
			wp_enqueue_style(
				'robin-fallback-style',
				get_stylesheet_uri(),
				array(),
				$theme_version
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'robin_enqueue_vite_assets' );

/**
 * Add type="module" to Vite script tags
 *
 * @param string $tag Script HTML tag.
 * @param string $handle Script handle.
 * @param string $src Script source URL.
 * @return string Modified tag.
 */
function robin_add_type_attribute( $tag, $handle, $src ) {
	if ( in_array( $handle, array( 'robin-vite-client', 'robin-main' ), true ) ) {
		return sprintf(
			'<script type="module" src="%s" id="%s-js"></script>' . "\n",
			esc_url( $src ),
			esc_attr( $handle )
		);
	}
	return $tag;
}
add_filter( 'script_loader_tag', 'robin_add_type_attribute', 10, 3 );
