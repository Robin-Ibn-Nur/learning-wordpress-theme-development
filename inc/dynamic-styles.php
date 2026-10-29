<?php
/**
 * Vélora Dynamic Typography, Colors & Dimensions
 *
 * Injects user-selected Google Fonts, weights, dimensions,
 * and custom colors into the frontend head.
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Enqueue selected Google Fonts
 */
function velora_enqueue_custom_fonts() {
	$heading_font = robin_get_option( 'font_heading', 'Cormorant Garamond' );
	$body_font    = robin_get_option( 'font_body', 'Plus Jakarta Sans' );

	$fonts_to_load = array_unique( array( $heading_font, $body_font ) );
	$font_families = array();

	foreach ( $fonts_to_load as $font ) {
		$font_slug = str_replace( ' ', '+', trim( $font ) );
		// Load standard weights 300, 400, 500, 600, 700 with italic
		$font_families[] = "family={$font_slug}:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400";
	}

	$fonts_url = 'https://fonts.googleapis.com/css2?' . implode( '&', $font_families ) . '&display=swap';

	wp_enqueue_style( 'velora-google-fonts', esc_url( $fonts_url ), array(), null );
}
add_action( 'wp_enqueue_scripts', 'velora_enqueue_custom_fonts', 5 );

/**
 * Inject dynamic CSS variables and dimensions into head
 */
function velora_output_dynamic_styles() {
	$heading_font       = robin_get_option( 'font_heading', 'Cormorant Garamond' );
	$body_font          = robin_get_option( 'font_body', 'Plus Jakarta Sans' );
	$heading_weight     = robin_get_option( 'font_weight_heading', '400' );
	$body_weight        = robin_get_option( 'font_weight_body', '400' );
	$font_size_base     = robin_get_option( 'font_size_base', '15px' );

	$color_accent       = robin_get_option( 'color_accent', '#c5a880' );
	$color_accent_hover = robin_get_option( 'color_accent_hover', '#a98b64' );
	$color_dark_bg      = robin_get_option( 'color_dark_bg', '#0c0c0c' );
	$color_light_bg     = robin_get_option( 'color_light_bg', '#faf9f5' );
	$color_heading_text = robin_get_option( 'color_heading_text', '#0c0c0c' );
	$color_body_text    = robin_get_option( 'color_body_text', '#4a4a4a' );

	$hero_min_height    = robin_get_option( 'hero_min_height', '640px' );
	$container_max_width= robin_get_option( 'container_max_width', '1280px' );
	$product_card_ratio = robin_get_option( 'product_card_ratio', '4/5' );
	$section_padding    = robin_get_option( 'section_vertical_padding', '80px' );
	?>
	<style id="velora-dynamic-css">
		:root {
			--font-serif: '<?php echo esc_attr( $heading_font ); ?>', Georgia, 'Times New Roman', serif;
			--font-sans: '<?php echo esc_attr( $body_font ); ?>', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
			--heading-font-weight: <?php echo esc_attr( $heading_weight ); ?>;
			--body-font-weight: <?php echo esc_attr( $body_weight ); ?>;
			--font-size-base: <?php echo esc_attr( $font_size_base ); ?>;

			--color-velora-gold: <?php echo esc_attr( $color_accent ); ?>;
			--color-velora-gold-dark: <?php echo esc_attr( $color_accent_hover ); ?>;
			--color-velora-black: <?php echo esc_attr( $color_dark_bg ); ?>;
			--color-velora-cream: <?php echo esc_attr( $color_light_bg ); ?>;
			--color-heading-text: <?php echo esc_attr( $color_heading_text ); ?>;
			--color-body-text: <?php echo esc_attr( $color_body_text ); ?>;

			--hero-min-height: <?php echo esc_attr( $hero_min_height ); ?>;
			--container-max-width: <?php echo esc_attr( $container_max_width ); ?>;
			--product-card-ratio: <?php echo esc_attr( $product_card_ratio ); ?>;
			--section-padding: <?php echo esc_attr( $section_padding ); ?>;
		}

		body {
			font-family: var(--font-sans) !important;
			font-weight: var(--body-font-weight) !important;
			font-size: var(--font-size-base);
			color: var(--color-body-text);
		}

		h1, h2, h3, h4, .font-serif-luxury {
			font-family: var(--font-serif) !important;
			font-weight: var(--heading-font-weight) !important;
			color: var(--color-heading-text);
		}

		/* Container width */
		.max-w-7xl {
			max-width: var(--container-max-width) !important;
		}

		/* Hero section custom height */
		#hero {
			min-height: var(--hero-min-height) !important;
		}

		/* Custom Product card ratio */
		.aspect-4\/5 {
			aspect-ratio: var(--product-card-ratio) !important;
		}

		/* Dynamic Gold Accents */
		.bg-\[\#c5a880\] {
			background-color: var(--color-velora-gold) !important;
		}
		.text-\[\#c5a880\] {
			color: var(--color-velora-gold) !important;
		}
		.border-\[\#c5a880\] {
			border-color: var(--color-velora-gold) !important;
		}

		/* Dark Backgrounds */
		.bg-\[\#0c0c0c\], .bg-\[\#0a0a0a\] {
			background-color: var(--color-velora-black) !important;
		}

		/* Light Cream Backgrounds */
		.bg-\[\#faf9f5\] {
			background-color: var(--color-velora-cream) !important;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'velora_output_dynamic_styles', 100 );
