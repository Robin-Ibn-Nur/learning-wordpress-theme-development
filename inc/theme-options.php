<?php
/**
 * Vélora Theme Options Admin Page
 *
 * Full dashboard settings interface for customizing:
 * - Direct WordPress Media Library Image Uploads
 * - Typography (Google Fonts & Weights)
 * - Colors (Color Pickers)
 * - Heights & Dimensions
 * - All content sections
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Theme Options admin page under Appearance
 */
function robin_add_theme_admin_menu() {
	add_theme_page(
		__( 'Vélora Theme Options', 'robin' ),
		__( 'Vélora Theme Options', 'robin' ),
		'edit_theme_options',
		'robin-theme-options',
		'robin_render_theme_options_page'
	);
}
add_action( 'admin_menu', 'robin_add_theme_admin_menu' );

/**
 * Enqueue WordPress Media Uploader and Color Picker scripts
 */
function velora_admin_options_scripts( $hook ) {
	if ( 'appearance_page_robin-theme-options' !== $hook ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'velora_admin_options_scripts' );

/**
 * Register settings
 */
function robin_register_settings() {
	register_setting(
		'robin_theme_options_group',
		'robin_theme_options',
		'robin_sanitize_theme_options'
	);
}
add_action( 'admin_init', 'robin_register_settings' );

/**
 * Sanitize options input
 */
function robin_sanitize_theme_options( $input ) {
	$sanitized = array();
	if ( ! is_array( $input ) ) {
		return $sanitized;
	}

	foreach ( $input as $key => $value ) {
		if ( strpos( $key, 'paragraph' ) !== false || strpos( $key, 'text' ) !== false || strpos( $key, 'desc' ) !== false || strpos( $key, 'about' ) !== false ) {
			$sanitized[ $key ] = wp_kses_post( $value );
		} elseif ( strpos( $key, 'img' ) !== false || strpos( $key, 'image' ) !== false || strpos( $key, 'url' ) !== false || strpos( $key, 'avatar' ) !== false ) {
			$sanitized[ $key ] = esc_url_raw( $value );
		} elseif ( strpos( $key, 'color' ) !== false ) {
			$sanitized[ $key ] = sanitize_hex_color( $value );
		} else {
			$sanitized[ $key ] = sanitize_text_field( $value );
		}
	}

	return $sanitized;
}

/**
 * Helper to render an image uploader field with live preview
 */
function velora_render_image_uploader_field( $key, $value, $label, $desc = '' ) {
	?>
	<div class="velora-image-uploader-field" style="margin-bottom: 8px;">
		<div style="display: flex; align-items: flex-start; gap: 16px;">
			<div class="velora-img-preview-box" style="width: 140px; height: 95px; background: #f1f5f9; border: 1px solid #cbd5e1; border-radius: 6px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
				<?php if ( ! empty( $value ) ) : ?>
					<img src="<?php echo esc_url( $value ); ?>" id="preview_<?php echo esc_attr( $key ); ?>" style="width: 100%; height: 100%; object-fit: cover;" />
				<?php else : ?>
					<span style="color: #94a3b8; font-size: 11px;">No Image</span>
				<?php endif; ?>
			</div>
			<div style="flex: 1;">
				<input type="text" data-target="<?php echo esc_attr( $key ); ?>" id="input_<?php echo esc_attr( $key ); ?>" value="<?php echo esc_attr( $value ); ?>" class="large-text" style="margin-bottom: 8px;" />
				<div>
					<button type="button" class="button button-secondary velora-upload-btn" data-input="input_<?php echo esc_attr( $key ); ?>" data-preview="preview_<?php echo esc_attr( $key ); ?>">
						📁 <?php esc_html_e( 'Upload / Select from Media Library', 'robin' ); ?>
					</button>
					<button type="button" class="button button-link-delete velora-remove-btn" data-input="input_<?php echo esc_attr( $key ); ?>" data-preview="preview_<?php echo esc_attr( $key ); ?>" style="margin-left: 10px;">
						<?php esc_html_e( 'Remove', 'robin' ); ?>
					</button>
				</div>
				<?php if ( $desc ) : ?>
					<p class="description" style="margin-top: 6px;"><?php echo esc_html( $desc ); ?></p>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<?php
}

/**
 * Render Theme Options Dashboard Page
 */
function robin_render_theme_options_page() {
	$options = get_option( 'robin_theme_options', array() );
	$defaults = robin_get_theme_defaults();
	$values = wp_parse_args( $options, $defaults );

	$active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'typography';
	?>
	<div class="wrap robin-admin-wrap" style="max-width: 1200px; margin-top: 20px;">
		<div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 16px;">
			<div>
				<h1 style="display: flex; align-items: center; gap: 12px; font-size: 26px; font-weight: 800; color: #0f172a; margin: 0;">
					<span style="background: #c5a880; color: #0c0c0c; padding: 4px 14px; border-radius: 6px; font-size: 16px; font-weight: 700; letter-spacing: 2px;">VÉLORA</span>
					<?php esc_html_e( 'Theme Customization Dashboard', 'robin' ); ?>
				</h1>
				<p style="color: #64748b; margin: 6px 0 0 0; font-size: 14px;">
					<?php esc_html_e( 'Complete control over Typography, Colors, Dimensions, Media Uploads, and Products.', 'robin' ); ?>
				</p>
			</div>
			<div style="display: flex; gap: 10px;">
				<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=velora_product' ) ); ?>" class="button button-primary" style="background: #0c0c0c; border-color: #0c0c0c; height: 38px; line-height: 36px; padding: 0 16px; font-weight: 600;">
					+ <?php esc_html_e( 'Add New Product', 'robin' ); ?>
				</a>
				<a href="<?php echo esc_url( admin_url( 'customize.php?autofocus[panel]=robin_theme_panel' ) ); ?>" class="button button-secondary" style="height: 38px; line-height: 36px; padding: 0 16px; font-weight: 600;">
					<?php esc_html_e( 'Open Live Customizer', 'robin' ); ?> &rarr;
				</a>
			</div>
		</div>

		<?php settings_errors(); ?>

		<!-- Navigation Tabs -->
		<h2 class="nav-tab-wrapper" style="margin-bottom: 24px; border-bottom: 1px solid #cbd5e1;">
			<a href="?page=robin-theme-options&tab=typography" class="nav-tab <?php echo 'typography' === $active_tab ? 'nav-tab-active' : ''; ?>">
				✦ <?php esc_html_e( 'Typography & Fonts', 'robin' ); ?>
			</a>
			<a href="?page=robin-theme-options&tab=colors" class="nav-tab <?php echo 'colors' === $active_tab ? 'nav-tab-active' : ''; ?>">
				✦ <?php esc_html_e( 'Colors & Styling', 'robin' ); ?>
			</a>
			<a href="?page=robin-theme-options&tab=layout" class="nav-tab <?php echo 'layout' === $active_tab ? 'nav-tab-active' : ''; ?>">
				✦ <?php esc_html_e( 'Layout & Heights', 'robin' ); ?>
			</a>
			<a href="?page=robin-theme-options&tab=hero" class="nav-tab <?php echo 'hero' === $active_tab ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Hero & Header', 'robin' ); ?>
			</a>
			<a href="?page=robin-theme-options&tab=categories" class="nav-tab <?php echo 'categories' === $active_tab ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Women & Men', 'robin' ); ?>
			</a>
			<a href="?page=robin-theme-options&tab=benefits" class="nav-tab <?php echo 'benefits' === $active_tab ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Benefits Bar', 'robin' ); ?>
			</a>
			<a href="?page=robin-theme-options&tab=edit" class="nav-tab <?php echo 'edit' === $active_tab ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'The Edit', 'robin' ); ?>
			</a>
			<a href="?page=robin-theme-options&tab=story" class="nav-tab <?php echo 'story' === $active_tab ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Our Story', 'robin' ); ?>
			</a>
			<a href="?page=robin-theme-options&tab=newsletter" class="nav-tab <?php echo 'newsletter' === $active_tab ? 'nav-tab-active' : ''; ?>">
				<?php esc_html_e( 'Newsletter & Footer', 'robin' ); ?>
			</a>
		</h2>

		<form method="post" action="options.php" style="background: #fff; padding: 24px 32px; border-radius: 12px; border: 1px solid #e2e8f0; box-shadow: 0 1px 3px rgba(0,0,0,0.05);">
			<?php
			settings_fields( 'robin_theme_options_group' );

			// Pass all values as hidden fields for inactive tabs
			foreach ( $values as $k => $v ) {
				echo '<input type="hidden" name="robin_theme_options[' . esc_attr( $k ) . ']" value="' . esc_attr( $v ) . '" id="hidden_' . esc_attr( $k ) . '" />';
			}

			// ==========================================
			// TAB 1: TYPOGRAPHY
			// ==========================================
			if ( 'typography' === $active_tab ) :
				?>
				<h3 style="margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; color: #0f172a;">
					<?php esc_html_e( 'Typography & Font Choices', 'robin' ); ?>
				</h3>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Heading Font Family', 'robin' ); ?></label></th>
						<td>
							<select data-target="font_heading" class="regular-text">
								<?php
								$heading_fonts = array(
									'Cormorant Garamond' => 'Cormorant Garamond (Editorial Luxury Serif - Default)',
									'Playfair Display'   => 'Playfair Display (Classic Elegant Serif)',
									'Cinzel'             => 'Cinzel (Roman Classical Serif)',
									'Italiana'           => 'Italiana (Italian Vogue Style)',
									'Bodoni Moda'        => 'Bodoni Moda (Didot High Fashion Serif)',
									'Plus Jakarta Sans'  => 'Plus Jakarta Sans (Modern Geometric Sans)',
									'Inter'              => 'Inter (Clean Neutral Sans)',
									'Montserrat'        => 'Montserrat (Architectural Sans)',
								);
								foreach ( $heading_fonts as $fkey => $flabel ) {
									printf(
										'<option value="%s"%s>%s</option>',
										esc_attr( $fkey ),
										selected( $values['font_heading'], $fkey, false ),
										esc_html( $flabel )
									);
								}
								?>
							</select>
							<p class="description"><?php esc_html_e( 'Font family used for headlines, section titles, and brand logo.', 'robin' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Heading Font Weight', 'robin' ); ?></label></th>
						<td>
							<select data-target="font_weight_heading" class="regular-text">
								<option value="300" <?php selected( $values['font_weight_heading'], '300' ); ?>>300 (Light)</option>
								<option value="400" <?php selected( $values['font_weight_heading'], '400' ); ?>>400 (Regular - Recommended)</option>
								<option value="500" <?php selected( $values['font_weight_heading'], '500' ); ?>>500 (Medium)</option>
								<option value="600" <?php selected( $values['font_weight_heading'], '600' ); ?>>600 (Semi-Bold)</option>
								<option value="700" <?php selected( $values['font_weight_heading'], '700' ); ?>>700 (Bold)</option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Body Text Font Family', 'robin' ); ?></label></th>
						<td>
							<select data-target="font_body" class="regular-text">
								<?php
								$body_fonts = array(
									'Plus Jakarta Sans'  => 'Plus Jakarta Sans (Modern Geometric Sans - Default)',
									'Inter'              => 'Inter (Clean Technical Sans)',
									'Montserrat'        => 'Montserrat (Architectural Sans)',
									'Lato'               => 'Lato (Warm Humanist Sans)',
									'Roboto'             => 'Roboto (Standard Sans)',
									'Cormorant Garamond' => 'Cormorant Garamond (Serif)',
								);
								foreach ( $body_fonts as $fkey => $flabel ) {
									printf(
										'<option value="%s"%s>%s</option>',
										esc_attr( $fkey ),
										selected( $values['font_body'], $fkey, false ),
										esc_html( $flabel )
									);
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Body Text Font Weight', 'robin' ); ?></label></th>
						<td>
							<select data-target="font_weight_body" class="regular-text">
								<option value="300" <?php selected( $values['font_weight_body'], '300' ); ?>>300 (Light)</option>
								<option value="400" <?php selected( $values['font_weight_body'], '400' ); ?>>400 (Regular - Recommended)</option>
								<option value="500" <?php selected( $values['font_weight_body'], '500' ); ?>>500 (Medium)</option>
								<option value="600" <?php selected( $values['font_weight_body'], '600' ); ?>>600 (Semi-Bold)</option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Base Font Size', 'robin' ); ?></label></th>
						<td>
							<select data-target="font_size_base" class="regular-text">
								<option value="14px" <?php selected( $values['font_size_base'], '14px' ); ?>>14px (Compact)</option>
								<option value="15px" <?php selected( $values['font_size_base'], '15px' ); ?>>15px (Standard Luxury)</option>
								<option value="16px" <?php selected( $values['font_size_base'], '16px' ); ?>>16px (Comfortable)</option>
								<option value="17px" <?php selected( $values['font_size_base'], '17px' ); ?>>17px (Large)</option>
							</select>
						</td>
					</tr>
				</table>

			<?php elseif ( 'colors' === $active_tab ) : ?>
				<h3 style="margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; color: #0f172a;">
					<?php esc_html_e( 'Brand Colors & Palette', 'robin' ); ?>
				</h3>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Accent Gold Color', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="color_accent" value="<?php echo esc_attr( $values['color_accent'] ); ?>" class="velora-color-picker" data-default-color="#c5a880" />
							<p class="description"><?php esc_html_e( 'Primary luxury gold accent used for tags, wishlist heart, and highlights.', 'robin' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Dark Background Color', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="color_dark_bg" value="<?php echo esc_attr( $values['color_dark_bg'] ); ?>" class="velora-color-picker" data-default-color="#0c0c0c" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Light Cream Background Color', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="color_light_bg" value="<?php echo esc_attr( $values['color_light_bg'] ); ?>" class="velora-color-picker" data-default-color="#faf9f5" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Headings Text Color', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="color_heading_text" value="<?php echo esc_attr( $values['color_heading_text'] ); ?>" class="velora-color-picker" data-default-color="#0c0c0c" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Body Text Color', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="color_body_text" value="<?php echo esc_attr( $values['color_body_text'] ); ?>" class="velora-color-picker" data-default-color="#4a4a4a" />
						</td>
					</tr>
				</table>

			<?php elseif ( 'layout' === $active_tab ) : ?>
				<h3 style="margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; color: #0f172a;">
					<?php esc_html_e( 'Layout Heights & Dimensions', 'robin' ); ?>
				</h3>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Hero Section Height', 'robin' ); ?></label></th>
						<td>
							<select data-target="hero_min_height" class="regular-text">
								<option value="480px" <?php selected( $values['hero_min_height'], '480px' ); ?>>480px (Compact)</option>
								<option value="580px" <?php selected( $values['hero_min_height'], '580px' ); ?>>580px (Medium)</option>
								<option value="640px" <?php selected( $values['hero_min_height'], '640px' ); ?>>640px (Standard - Recommended)</option>
								<option value="740px" <?php selected( $values['hero_min_height'], '740px' ); ?>>740px (Tall)</option>
								<option value="85vh" <?php selected( $values['hero_min_height'], '85vh' ); ?>>85vh (Viewport Height)</option>
								<option value="100vh" <?php selected( $values['hero_min_height'], '100vh' ); ?>>100vh (Full Screen Viewport)</option>
							</select>
							<p class="description"><?php esc_html_e( 'Minimum vertical height of the main hero banner.', 'robin' ); ?></p>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Container Max Width', 'robin' ); ?></label></th>
						<td>
							<select data-target="container_max_width" class="regular-text">
								<option value="1140px" <?php selected( $values['container_max_width'], '1140px' ); ?>>1140px (Classic)</option>
								<option value="1280px" <?php selected( $values['container_max_width'], '1280px' ); ?>>1280px (Standard Luxury)</option>
								<option value="1400px" <?php selected( $values['container_max_width'], '1400px' ); ?>>1400px (Wide)</option>
								<option value="1536px" <?php selected( $values['container_max_width'], '1536px' ); ?>>1536px (Ultra Wide)</option>
							</select>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Product Image Aspect Ratio', 'robin' ); ?></label></th>
						<td>
							<select data-target="product_card_ratio" class="regular-text">
								<option value="4/5" <?php selected( $values['product_card_ratio'], '4/5' ); ?>>4:5 (Portrait Editorial - Recommended)</option>
								<option value="3/4" <?php selected( $values['product_card_ratio'], '3/4' ); ?>>3:4 (Classic Portrait)</option>
								<option value="1/1" <?php selected( $values['product_card_ratio'], '1/1' ); ?>>1:1 (Square)</option>
							</select>
						</td>
					</tr>
				</table>

			<?php elseif ( 'hero' === $active_tab ) : ?>
				<h3 style="margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; color: #0f172a;">
					<?php esc_html_e( 'Hero Section & Top Bar', 'robin' ); ?>
				</h3>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Top Announcement Text', 'robin' ); ?></label></th>
						<td><input type="text" data-target="topbar_text" value="<?php echo esc_attr( $values['topbar_text'] ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Hero Season Tag', 'robin' ); ?></label></th>
						<td><input type="text" data-target="hero_season" value="<?php echo esc_attr( $values['hero_season'] ); ?>" class="regular-text" /></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Hero Headline Line 1', 'robin' ); ?></label></th>
						<td><input type="text" data-target="hero_title_line1" value="<?php echo esc_attr( $values['hero_title_line1'] ); ?>" class="regular-text" placeholder="Timeless" /></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Hero Headline Line 2', 'robin' ); ?></label></th>
						<td><input type="text" data-target="hero_title_line2" value="<?php echo esc_attr( $values['hero_title_line2'] ); ?>" class="regular-text" placeholder="Elegance" /></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Hero Subtitle', 'robin' ); ?></label></th>
						<td><input type="text" data-target="hero_subtitle" value="<?php echo esc_attr( $values['hero_subtitle'] ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Hero Button Text & Link', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="hero_btn_text" value="<?php echo esc_attr( $values['hero_btn_text'] ); ?>" class="regular-text" />
							<input type="text" data-target="hero_btn_url" value="<?php echo esc_attr( $values['hero_btn_url'] ); ?>" class="regular-text" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Hero Background Image', 'robin' ); ?></label></th>
						<td>
							<?php velora_render_image_uploader_field( 'hero_bg_image', $values['hero_bg_image'], 'Hero Background Image', 'Upload or choose from Media Library.' ); ?>
						</td>
					</tr>
				</table>

			<?php elseif ( 'categories' === $active_tab ) : ?>
				<h3 style="margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; color: #0f172a;">
					<?php esc_html_e( 'Women & Men Category Banners', 'robin' ); ?>
				</h3>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Women Banner (For Her)', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="cat_women_title" value="<?php echo esc_attr( $values['cat_women_title'] ); ?>" class="regular-text" placeholder="Women" /><br/><br/>
							<input type="text" data-target="cat_women_desc" value="<?php echo esc_attr( $values['cat_women_desc'] ); ?>" class="large-text" placeholder="Graceful. Bold. Unforgettable." /><br/><br/>
							<?php velora_render_image_uploader_field( 'cat_women_img', $values['cat_women_img'], 'Women Banner Image' ); ?>
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Men Banner (For Him)', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="cat_men_title" value="<?php echo esc_attr( $values['cat_men_title'] ); ?>" class="regular-text" placeholder="Men" /><br/><br/>
							<input type="text" data-target="cat_men_desc" value="<?php echo esc_attr( $values['cat_men_desc'] ); ?>" class="large-text" placeholder="Confident. Refined. Timeless." /><br/><br/>
							<?php velora_render_image_uploader_field( 'cat_men_img', $values['cat_men_img'], 'Men Banner Image' ); ?>
						</td>
					</tr>
				</table>

			<?php elseif ( 'benefits' === $active_tab ) : ?>
				<h3 style="margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; color: #0f172a;">
					<?php esc_html_e( 'Value Propositions / Benefits Bar', 'robin' ); ?>
				</h3>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Benefit 1', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="benefit_1_title" value="<?php echo esc_attr( $values['benefit_1_title'] ); ?>" class="regular-text" />
							<input type="text" data-target="benefit_1_subtitle" value="<?php echo esc_attr( $values['benefit_1_subtitle'] ); ?>" class="regular-text" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Benefit 2', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="benefit_2_title" value="<?php echo esc_attr( $values['benefit_2_title'] ); ?>" class="regular-text" />
							<input type="text" data-target="benefit_2_subtitle" value="<?php echo esc_attr( $values['benefit_2_subtitle'] ); ?>" class="regular-text" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Benefit 3', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="benefit_3_title" value="<?php echo esc_attr( $values['benefit_3_title'] ); ?>" class="regular-text" />
							<input type="text" data-target="benefit_3_subtitle" value="<?php echo esc_attr( $values['benefit_3_subtitle'] ); ?>" class="regular-text" />
						</td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Benefit 4', 'robin' ); ?></label></th>
						<td>
							<input type="text" data-target="benefit_4_title" value="<?php echo esc_attr( $values['benefit_4_title'] ); ?>" class="regular-text" />
							<input type="text" data-target="benefit_4_subtitle" value="<?php echo esc_attr( $values['benefit_4_subtitle'] ); ?>" class="regular-text" />
						</td>
					</tr>
				</table>

			<?php elseif ( 'edit' === $active_tab ) : ?>
				<h3 style="margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; color: #0f172a;">
					<?php esc_html_e( 'The Edit (Editorial Showcase)', 'robin' ); ?>
				</h3>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Editorial Headline', 'robin' ); ?></label></th>
						<td><input type="text" data-target="edit_title" value="<?php echo esc_attr( $values['edit_title'] ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Editorial Subtitle', 'robin' ); ?></label></th>
						<td><textarea data-target="edit_subtitle" rows="3" class="large-text"><?php echo esc_textarea( $values['edit_subtitle'] ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Main Image (Left Large)', 'robin' ); ?></label></th>
						<td><?php velora_render_image_uploader_field( 'edit_main_img', $values['edit_main_img'], 'Main Editorial Image' ); ?></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Card 1 (Resort Wear)', 'robin' ); ?></label></th>
						<td><?php velora_render_image_uploader_field( 'edit_card1_img', $values['edit_card1_img'], 'Resort Wear Image' ); ?></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Card 2 (Formal Wear)', 'robin' ); ?></label></th>
						<td><?php velora_render_image_uploader_field( 'edit_card2_img', $values['edit_card2_img'], 'Formal Wear Image' ); ?></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Card 3 (Accessories)', 'robin' ); ?></label></th>
						<td><?php velora_render_image_uploader_field( 'edit_card3_img', $values['edit_card3_img'], 'Accessories Image' ); ?></td>
					</tr>
				</table>

			<?php elseif ( 'story' === $active_tab ) : ?>
				<h3 style="margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; color: #0f172a;">
					<?php esc_html_e( 'Our Story & Brand Craftsmanship', 'robin' ); ?>
				</h3>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Story Heading', 'robin' ); ?></label></th>
						<td><input type="text" data-target="story_title" value="<?php echo esc_attr( $values['story_title'] ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Story Narrative', 'robin' ); ?></label></th>
						<td><textarea data-target="story_paragraph" rows="4" class="large-text"><?php echo esc_textarea( $values['story_paragraph'] ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Craftsmanship Photo', 'robin' ); ?></label></th>
						<td><?php velora_render_image_uploader_field( 'story_img', $values['story_img'], 'Craftsmanship Photo' ); ?></td>
					</tr>
				</table>

			<?php elseif ( 'newsletter' === $active_tab ) : ?>
				<h3 style="margin-top: 0; padding-bottom: 12px; border-bottom: 1px solid #f1f5f9; color: #0f172a;">
					<?php esc_html_e( 'VIP Inner Circle & Footer', 'robin' ); ?>
				</h3>
				<table class="form-table" role="presentation">
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Newsletter Title', 'robin' ); ?></label></th>
						<td><input type="text" data-target="newsletter_title" value="<?php echo esc_attr( $values['newsletter_title'] ); ?>" class="large-text" /></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Newsletter Background Image', 'robin' ); ?></label></th>
						<td><?php velora_render_image_uploader_field( 'newsletter_bg_img', $values['newsletter_bg_img'], 'Newsletter Background' ); ?></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Footer About Blurb', 'robin' ); ?></label></th>
						<td><textarea data-target="footer_about" rows="3" class="large-text"><?php echo esc_textarea( $values['footer_about'] ); ?></textarea></td>
					</tr>
					<tr>
						<th scope="row"><label><?php esc_html_e( 'Copyright Notice', 'robin' ); ?></label></th>
						<td><input type="text" data-target="footer_copyright" value="<?php echo esc_attr( $values['footer_copyright'] ); ?>" class="large-text" /></td>
					</tr>
				</table>

			<?php else : ?>
				<p><?php esc_html_e( 'Select a section tab above to configure settings.', 'robin' ); ?></p>
			<?php endif; ?>

			<div style="margin-top: 32px; padding-top: 16px; border-top: 1px solid #f1f5f9;">
				<?php submit_button( __( 'Save All Changes', 'robin' ), 'primary', 'submit', false, array( 'style' => 'background: #c5a880; border-color: #a98b64; color: #0c0c0c; font-size: 15px; padding: 6px 24px; font-weight: 700;' ) ); ?>
			</div>
		</form>
	</div>

	<script>
	jQuery(document).ready(function($) {
		// Initialize color pickers
		$('.velora-color-picker').wpColorPicker();

		// Media Uploader click handler
		$(document).on('click', '.velora-upload-btn', function(e) {
			e.preventDefault();
			var button = $(this);
			var targetInputId = button.data('input');
			var targetPreviewId = button.data('preview');

			var customUploader = wp.media({
				title: 'Select or Upload Fashion Image',
				button: { text: 'Use this Image' },
				multiple: false
			}).on('select', function() {
				var attachment = customUploader.state().get('selection').first().toJSON();
				$('#' + targetInputId).val(attachment.url).trigger('change');
				var previewImg = $('#' + targetPreviewId);
				if (previewImg.length) {
					previewImg.attr('src', attachment.url);
				} else {
					button.closest('.velora-image-uploader-field').find('.velora-img-preview-box').html('<img src="' + attachment.url + '" id="' + targetPreviewId + '" style="width: 100%; height: 100%; object-fit: cover;" />');
				}
			}).open();
		});

		// Remove image click handler
		$(document).on('click', '.velora-remove-btn', function(e) {
			e.preventDefault();
			var button = $(this);
			var targetInputId = button.data('input');
			var targetPreviewId = button.data('preview');
			$('#' + targetInputId).val('').trigger('change');
			button.closest('.velora-image-uploader-field').find('.velora-img-preview-box').html('<span style="color: #94a3b8; font-size: 11px;">No Image</span>');
		});

		// Sync inputs to hidden inputs before submit
		var form = document.querySelector('.robin-admin-wrap form');
		if (form) {
			form.addEventListener('submit', function() {
				var visibleInputs = form.querySelectorAll('[data-target]');
				visibleInputs.forEach(function(input) {
					var targetKey = input.getAttribute('data-target');
					var hiddenInput = document.getElementById('hidden_' + targetKey);
					if (hiddenInput) {
						hiddenInput.value = input.value;
					}
				});
			});
		}
	});
	</script>
	<?php
}
