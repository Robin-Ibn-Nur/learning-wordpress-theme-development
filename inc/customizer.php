<?php
/**
 * Vélora Theme Customizer
 *
 * Full real-time customizer controls for:
 * - Native WordPress Image Uploaders (WP_Customize_Image_Control)
 * - Typography (Font families & weights)
 * - Colors (Color pickers)
 * - Dimensions (Heights & Widths)
 * - All content sections
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register customizer options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function robin_customize_register( $wp_customize ) {
	$defaults = robin_get_theme_defaults();

	// Primary Panel: Vélora Theme Options
	$wp_customize->add_panel(
		'robin_theme_panel',
		array(
			'title'       => __( 'Vélora Theme Controls', 'robin' ),
			'description' => __( 'Customize typography, colors, heights, media uploads, and all fashion sections.', 'robin' ),
			'priority'    => 20,
		)
	);

	// ==========================================
	// 0. TYPOGRAPHY & FONTS
	// ==========================================
	$wp_customize->add_section(
		'velora_typography_section',
		array(
			'title'    => __( '✦ Typography & Fonts', 'robin' ),
			'panel'    => 'robin_theme_panel',
			'priority' => 1,
		)
	);

	// Heading Font Family
	$wp_customize->add_setting(
		'font_heading',
		array(
			'default'           => $defaults['font_heading'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'font_heading',
		array(
			'label'       => __( 'Heading Font Family', 'robin' ),
			'description' => __( 'Font applied to headlines, titles, and logo.', 'robin' ),
			'section'     => 'velora_typography_section',
			'type'        => 'select',
			'choices'     => array(
				'Cormorant Garamond' => 'Cormorant Garamond (Editorial Luxury Serif)',
				'Playfair Display'   => 'Playfair Display (Classic Elegant Serif)',
				'Cinzel'             => 'Cinzel (Roman Classical Serif)',
				'Italiana'           => 'Italiana (Italian Vogue Style)',
				'Bodoni Moda'        => 'Bodoni Moda (High-Fashion Didot Serif)',
				'Plus Jakarta Sans'  => 'Plus Jakarta Sans (Modern Geometric Sans)',
				'Inter'              => 'Inter (Clean Neutral Sans)',
				'Montserrat'        => 'Montserrat (Bold Architectural Sans)',
			),
		)
	);

	// Heading Font Weight
	$wp_customize->add_setting(
		'font_weight_heading',
		array(
			'default'           => $defaults['font_weight_heading'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'font_weight_heading',
		array(
			'label'   => __( 'Heading Font Weight', 'robin' ),
			'section' => 'velora_typography_section',
			'type'    => 'select',
			'choices' => array(
				'300' => '300 (Light)',
				'400' => '400 (Regular)',
				'500' => '500 (Medium)',
				'600' => '600 (Semi-Bold)',
				'700' => '700 (Bold)',
			),
		)
	);

	// Body Font Family
	$wp_customize->add_setting(
		'font_body',
		array(
			'default'           => $defaults['font_body'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'font_body',
		array(
			'label'   => __( 'Body Text Font Family', 'robin' ),
			'section' => 'velora_typography_section',
			'type'    => 'select',
			'choices' => array(
				'Plus Jakarta Sans'  => 'Plus Jakarta Sans (Modern Geometric Sans)',
				'Inter'              => 'Inter (Clean Technical Sans)',
				'Montserrat'        => 'Montserrat (Architectural Sans)',
				'Lato'               => 'Lato (Warm Humanist Sans)',
				'Roboto'             => 'Roboto (Standard Sans)',
				'Cormorant Garamond' => 'Cormorant Garamond (Serif)',
			),
		)
	);

	// Body Font Weight
	$wp_customize->add_setting(
		'font_weight_body',
		array(
			'default'           => $defaults['font_weight_body'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'font_weight_body',
		array(
			'label'   => __( 'Body Font Weight', 'robin' ),
			'section' => 'velora_typography_section',
			'type'    => 'select',
			'choices' => array(
				'300' => '300 (Light)',
				'400' => '400 (Regular)',
				'500' => '500 (Medium)',
				'600' => '600 (Semi-Bold)',
			),
		)
	);

	// Base Font Size
	$wp_customize->add_setting(
		'font_size_base',
		array(
			'default'           => $defaults['font_size_base'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'font_size_base',
		array(
			'label'   => __( 'Base Body Font Size', 'robin' ),
			'section' => 'velora_typography_section',
			'type'    => 'select',
			'choices' => array(
				'14px' => '14px (Compact)',
				'15px' => '15px (Standard Luxury)',
				'16px' => '16px (Comfortable)',
				'17px' => '17px (Large)',
				'18px' => '18px (Editorial)',
			),
		)
	);

	// ==========================================
	// 0B. COLORS & PALETTE
	// ==========================================
	$wp_customize->add_section(
		'velora_colors_section',
		array(
			'title'    => __( '✦ Colors & Palette', 'robin' ),
			'panel'    => 'robin_theme_panel',
			'priority' => 2,
		)
	);

	$colors = array(
		'color_accent'       => array( 'label' => __( 'Primary Gold / Accent Color', 'robin' ), 'default' => $defaults['color_accent'] ),
		'color_accent_hover' => array( 'label' => __( 'Accent Hover Color', 'robin' ), 'default' => $defaults['color_accent_hover'] ),
		'color_dark_bg'      => array( 'label' => __( 'Dark Background Color', 'robin' ), 'default' => $defaults['color_dark_bg'] ),
		'color_light_bg'     => array( 'label' => __( 'Light Cream Background Color', 'robin' ), 'default' => $defaults['color_light_bg'] ),
		'color_heading_text' => array( 'label' => __( 'Headings Text Color', 'robin' ), 'default' => $defaults['color_heading_text'] ),
		'color_body_text'    => array( 'label' => __( 'Body Text Color', 'robin' ), 'default' => $defaults['color_body_text'] ),
	);

	foreach ( $colors as $key => $args ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $args['default'],
				'sanitize_callback' => 'sanitize_hex_color',
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$key,
				array(
					'label'   => $args['label'],
					'section' => 'velora_colors_section',
				)
			)
		);
	}

	// ==========================================
	// 0C. LAYOUT & HEIGHTS
	// ==========================================
	$wp_customize->add_section(
		'velora_layout_section',
		array(
			'title'    => __( '✦ Layout & Heights', 'robin' ),
			'panel'    => 'robin_theme_panel',
			'priority' => 3,
		)
	);

	// Hero Height
	$wp_customize->add_setting(
		'hero_min_height',
		array(
			'default'           => $defaults['hero_min_height'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'hero_min_height',
		array(
			'label'       => __( 'Hero Section Minimum Height', 'robin' ),
			'description' => __( 'Adjust the vertical height of the main hero banner.', 'robin' ),
			'section'     => 'velora_layout_section',
			'type'        => 'select',
			'choices'     => array(
				'480px' => '480px (Compact)',
				'580px' => '580px (Medium)',
				'640px' => '640px (Standard - Recommended)',
				'740px' => '740px (Tall)',
				'85vh'  => '85vh (Viewport Height)',
				'100vh' => '100vh (Full Screen Viewport)',
			),
		)
	);

	// Container Max Width
	$wp_customize->add_setting(
		'container_max_width',
		array(
			'default'           => $defaults['container_max_width'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'container_max_width',
		array(
			'label'   => __( 'Site Max Container Width', 'robin' ),
			'section' => 'velora_layout_section',
			'type'    => 'select',
			'choices' => array(
				'1140px' => '1140px (Classic)',
				'1280px' => '1280px (Standard Luxury)',
				'1400px' => '1400px (Wide)',
				'1536px' => '1536px (Ultra Wide)',
			),
		)
	);

	// Product Card Ratio
	$wp_customize->add_setting(
		'product_card_ratio',
		array(
			'default'           => $defaults['product_card_ratio'],
			'sanitize_callback' => 'sanitize_text_field',
		)
	);
	$wp_customize->add_control(
		'product_card_ratio',
		array(
			'label'   => __( 'Product Image Aspect Ratio', 'robin' ),
			'section' => 'velora_layout_section',
			'type'    => 'select',
			'choices' => array(
				'4/5'  => '4:5 (Portrait Editorial - Recommended)',
				'3/4'  => '3:4 (Classic Portrait)',
				'1/1'  => '1:1 (Square)',
				'16/9' => '16:9 (Landscape)',
			),
		)
	);

	// ==========================================
	// 1. TOP ANNOUNCEMENT BAR
	// ==========================================
	$wp_customize->add_section(
		'robin_topbar_section',
		array(
			'title' => __( '1. Announcement Bar', 'robin' ),
			'panel' => 'robin_theme_panel',
		)
	);

	$topbar_fields = array(
		'topbar_text'     => array( 'label' => __( 'Announcement Message', 'robin' ), 'type' => 'text' ),
		'topbar_currency' => array( 'label' => __( 'Currency Code', 'robin' ), 'type' => 'text' ),
		'topbar_lang'     => array( 'label' => __( 'Language Code', 'robin' ), 'type' => 'text' ),
	);

	foreach ( $topbar_fields as $key => $args ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $defaults[ $key ] ?? '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'   => $args['label'],
				'section' => 'robin_topbar_section',
				'type'    => $args['type'],
			)
		);
	}

	// ==========================================
	// 2. HERO SECTION (WITH NATIVE IMAGE UPLOAD)
	// ==========================================
	$wp_customize->add_section(
		'robin_hero_section',
		array(
			'title' => __( '2. Hero Section', 'robin' ),
			'panel' => 'robin_theme_panel',
		)
	);

	$hero_texts = array(
		'hero_season'      => __( 'Season Eyebrow (e.g. SPRING / SUMMER 2025)', 'robin' ),
		'hero_title_line1' => __( 'Headline Line 1 (e.g. Timeless)', 'robin' ),
		'hero_title_line2' => __( 'Headline Line 2 (e.g. Elegance)', 'robin' ),
		'hero_subtitle'    => __( 'Subtitle', 'robin' ),
		'hero_btn_text'    => __( 'Button Label', 'robin' ),
		'hero_btn_url'     => __( 'Button Link URL', 'robin' ),
	);

	foreach ( $hero_texts as $key => $lbl ) {
		$wp_customize->add_setting(
			$key,
			array(
				'default'           => $defaults[ $key ] ?? '',
				'sanitize_callback' => 'sanitize_text_field',
			)
		);
		$wp_customize->add_control(
			$key,
			array(
				'label'   => $lbl,
				'section' => 'robin_hero_section',
				'type'    => 'text',
			)
		);
	}

	// Hero Image with WP_Customize_Image_Control
	$wp_customize->add_setting(
		'hero_bg_image',
		array(
			'default'           => $defaults['hero_bg_image'],
			'sanitize_callback' => 'esc_url_raw',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'hero_bg_image',
			array(
				'label'       => __( 'Hero Background Image', 'robin' ),
				'description' => __( 'Upload or select high-resolution luxury fashion photo.', 'robin' ),
				'section'     => 'robin_hero_section',
			)
		)
	);

	// ==========================================
	// 3. DUAL CATEGORIES (WITH IMAGE UPLOADS)
	// ==========================================
	$wp_customize->add_section(
		'robin_categories_section',
		array(
			'title' => __( '3. Women & Men Banners', 'robin' ),
			'panel' => 'robin_theme_panel',
		)
	);

	// Women fields
	$wp_customize->add_setting( 'cat_women_title', array( 'default' => $defaults['cat_women_title'], 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cat_women_title', array( 'label' => __( 'Women Title', 'robin' ), 'section' => 'robin_categories_section' ) );

	$wp_customize->add_setting( 'cat_women_desc', array( 'default' => $defaults['cat_women_desc'], 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cat_women_desc', array( 'label' => __( 'Women Description', 'robin' ), 'section' => 'robin_categories_section' ) );

	$wp_customize->add_setting( 'cat_women_img', array( 'default' => $defaults['cat_women_img'], 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cat_women_img', array( 'label' => __( 'Women Banner Image Upload', 'robin' ), 'section' => 'robin_categories_section' ) ) );

	// Men fields
	$wp_customize->add_setting( 'cat_men_title', array( 'default' => $defaults['cat_men_title'], 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cat_men_title', array( 'label' => __( 'Men Title', 'robin' ), 'section' => 'robin_categories_section' ) );

	$wp_customize->add_setting( 'cat_men_desc', array( 'default' => $defaults['cat_men_desc'], 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'cat_men_desc', array( 'label' => __( 'Men Description', 'robin' ), 'section' => 'robin_categories_section' ) );

	$wp_customize->add_setting( 'cat_men_img', array( 'default' => $defaults['cat_men_img'], 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'cat_men_img', array( 'label' => __( 'Men Banner Image Upload', 'robin' ), 'section' => 'robin_categories_section' ) ) );

	// ==========================================
	// 4. VALUE PROPOSITIONS / BENEFITS
	// ==========================================
	$wp_customize->add_section(
		'robin_benefits_section',
		array(
			'title' => __( '4. Benefits & Value Props', 'robin' ),
			'panel' => 'robin_theme_panel',
		)
	);

	$benefit_fields = array(
		'benefit_1_title'    => __( 'Benefit 1 Title (Shipping)', 'robin' ),
		'benefit_1_subtitle' => __( 'Benefit 1 Subtitle', 'robin' ),
		'benefit_2_title'    => __( 'Benefit 2 Title (Returns)', 'robin' ),
		'benefit_2_subtitle' => __( 'Benefit 2 Subtitle', 'robin' ),
		'benefit_3_title'    => __( 'Benefit 3 Title (Payments)', 'robin' ),
		'benefit_3_subtitle' => __( 'Benefit 3 Subtitle', 'robin' ),
		'benefit_4_title'    => __( 'Benefit 4 Title (Packaging)', 'robin' ),
		'benefit_4_subtitle' => __( 'Benefit 4 Subtitle', 'robin' ),
	);

	foreach ( $benefit_fields as $key => $lbl ) {
		$wp_customize->add_setting( $key, array( 'default' => $defaults[ $key ] ?? '', 'sanitize_callback' => 'sanitize_text_field' ) );
		$wp_customize->add_control( $key, array( 'label' => $lbl, 'section' => 'robin_benefits_section' ) );
	}

	// ==========================================
	// 5. THE EDIT (WITH NATIVE IMAGE UPLOADS)
	// ==========================================
	$wp_customize->add_section(
		'robin_edit_section',
		array(
			'title' => __( '5. The Edit (Editorial & Cards)', 'robin' ),
			'panel' => 'robin_theme_panel',
		)
	);

	$wp_customize->add_setting( 'edit_title', array( 'default' => $defaults['edit_title'], 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'edit_title', array( 'label' => __( 'Editorial Headline', 'robin' ), 'section' => 'robin_edit_section' ) );

	$wp_customize->add_setting( 'edit_subtitle', array( 'default' => $defaults['edit_subtitle'], 'sanitize_callback' => 'wp_kses_post' ) );
	$wp_customize->add_control( 'edit_subtitle', array( 'label' => __( 'Editorial Subtitle', 'robin' ), 'section' => 'robin_edit_section', 'type' => 'textarea' ) );

	$wp_customize->add_setting( 'edit_main_img', array( 'default' => $defaults['edit_main_img'], 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'edit_main_img', array( 'label' => __( 'Main Editorial Image (Evening Gown)', 'robin' ), 'section' => 'robin_edit_section' ) ) );

	// Stacked cards
	$wp_customize->add_setting( 'edit_card1_img', array( 'default' => $defaults['edit_card1_img'], 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'edit_card1_img', array( 'label' => __( 'Resort Wear Card Image', 'robin' ), 'section' => 'robin_edit_section' ) ) );

	$wp_customize->add_setting( 'edit_card2_img', array( 'default' => $defaults['edit_card2_img'], 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'edit_card2_img', array( 'label' => __( 'Formal Wear Card Image', 'robin' ), 'section' => 'robin_edit_section' ) ) );

	$wp_customize->add_setting( 'edit_card3_img', array( 'default' => $defaults['edit_card3_img'], 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'edit_card3_img', array( 'label' => __( 'Accessories Card Image', 'robin' ), 'section' => 'robin_edit_section' ) ) );

	// ==========================================
	// 6. OUR STORY (WITH IMAGE UPLOAD)
	// ==========================================
	$wp_customize->add_section(
		'robin_story_section',
		array(
			'title' => __( '6. Our Story & Craftsmanship', 'robin' ),
			'panel' => 'robin_theme_panel',
		)
	);

	$wp_customize->add_setting( 'story_title', array( 'default' => $defaults['story_title'], 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'story_title', array( 'label' => __( 'Story Heading', 'robin' ), 'section' => 'robin_story_section' ) );

	$wp_customize->add_setting( 'story_paragraph', array( 'default' => $defaults['story_paragraph'], 'sanitize_callback' => 'wp_kses_post' ) );
	$wp_customize->add_control( 'story_paragraph', array( 'label' => __( 'Story Narrative', 'robin' ), 'section' => 'robin_story_section', 'type' => 'textarea' ) );

	$wp_customize->add_setting( 'story_img', array( 'default' => $defaults['story_img'], 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'story_img', array( 'label' => __( 'Craftsmanship Photo Upload', 'robin' ), 'section' => 'robin_story_section' ) ) );

	// ==========================================
	// 7. VIP NEWSLETTER & FOOTER
	// ==========================================
	$wp_customize->add_section(
		'robin_footer_section',
		array(
			'title' => __( '7. VIP Newsletter & Footer', 'robin' ),
			'panel' => 'robin_theme_panel',
		)
	);

	$wp_customize->add_setting( 'newsletter_title', array( 'default' => $defaults['newsletter_title'], 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'newsletter_title', array( 'label' => __( 'Newsletter Title', 'robin' ), 'section' => 'robin_footer_section' ) );

	$wp_customize->add_setting( 'newsletter_bg_img', array( 'default' => $defaults['newsletter_bg_img'], 'sanitize_callback' => 'esc_url_raw' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'newsletter_bg_img', array( 'label' => __( 'Newsletter Background Image', 'robin' ), 'section' => 'robin_footer_section' ) ) );

	$wp_customize->add_setting( 'footer_about', array( 'default' => $defaults['footer_about'], 'sanitize_callback' => 'wp_kses_post' ) );
	$wp_customize->add_control( 'footer_about', array( 'label' => __( 'Footer About Text', 'robin' ), 'section' => 'robin_footer_section', 'type' => 'textarea' ) );

	$wp_customize->add_setting( 'footer_copyright', array( 'default' => $defaults['footer_copyright'], 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( 'footer_copyright', array( 'label' => __( 'Copyright Text', 'robin' ), 'section' => 'robin_footer_section' ) );
}
add_action( 'customize_register', 'robin_customize_register' );
