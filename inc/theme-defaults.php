<?php
/**
 * Vélora Theme Default Content & Settings
 *
 * Provides fallback and default values for all customizable sections
 * of the Vélora Timeless Elegance luxury fashion homepage.
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get all theme options with defaults
 *
 * @param string $key Optional specific setting key.
 * @param mixed  $default Optional fallback if key not found.
 * @return mixed
 */
function robin_get_option( $key = '', $default = null ) {
	$defaults = robin_get_theme_defaults();

	if ( empty( $key ) ) {
		$options = get_option( 'robin_theme_options', array() );
		return wp_parse_args( $options, $defaults );
	}

	// 1. Check theme_mod (Customizer)
	$mod_value = get_theme_mod( $key, null );
	if ( null !== $mod_value && '' !== $mod_value ) {
		return $mod_value;
	}

	// 2. Check theme_options (Admin settings page)
	$options = get_option( 'robin_theme_options', array() );
	if ( isset( $options[ $key ] ) && '' !== $options[ $key ] ) {
		return $options[ $key ];
	}

	// 3. Fallback to default
	if ( isset( $defaults[ $key ] ) ) {
		return $defaults[ $key ];
	}

	return $default;
}

/**
 * Return master list of default content and settings for Vélora
 *
 * @return array
 */
function robin_get_theme_defaults() {
	return array(
		// --- Typography & Fonts ---
		'font_heading'             => 'Cormorant Garamond',
		'font_body'                => 'Plus Jakarta Sans',
		'font_weight_heading'      => '400',
		'font_weight_body'         => '400',
		'font_size_base'           => '15px',

		// --- Colors & Palette ---
		'color_accent'             => '#c5a880',
		'color_accent_hover'       => '#a98b64',
		'color_dark_bg'            => '#0c0c0c',
		'color_light_bg'           => '#faf9f5',
		'color_heading_text'       => '#0c0c0c',
		'color_body_text'          => '#4a4a4a',

		// --- Layout & Dimensions (Heights & Widths) ---
		'hero_min_height'          => '640px',
		'container_max_width'      => '1280px',
		'product_card_ratio'       => '4/5',
		'section_vertical_padding' => '80px',

		// --- Top Announcement Bar ---
		'topbar_text'              => 'Free express shipping on orders over $200 | Easy returns within 30 days',
		'topbar_currency'          => 'USD',
		'topbar_lang'              => 'EN',

		// --- Header & Brand ---
		'brand_name'               => 'VÉLORA',
		'brand_tagline'            => 'TIMELESS STYLE',

		// --- Hero Section ---
		'hero_season'              => 'SPRING / SUMMER 2025',
		'hero_title_line1'         => 'Timeless',
		'hero_title_line2'         => 'Elegance',
		'hero_subtitle'            => 'Effortless style for every moment.',
		'hero_btn_text'            => 'SHOP NEW ARRIVALS',
		'hero_btn_url'             => '#signature-pieces',
		'hero_bg_image'            => get_theme_file_uri( 'assets/images/hero-bg.jpg' ),
		'hero_slide_indicator'     => '01 / 03',

		// --- Dual Categories: Women & Men ---
		'cat_women_label'          => 'FOR HER',
		'cat_women_title'          => 'Women',
		'cat_women_desc'           => 'Graceful. Bold. Unforgettable.',
		'cat_women_btn_text'       => 'EXPLORE COLLECTION',
		'cat_women_btn_url'        => '#signature-pieces',
		'cat_women_img'            => get_theme_file_uri( 'assets/images/cat-women.jpg' ),

		'cat_men_label'            => 'FOR HIM',
		'cat_men_title'            => 'Men',
		'cat_men_desc'             => 'Confident. Refined. Timeless.',
		'cat_men_btn_text'         => 'EXPLORE COLLECTION',
		'cat_men_btn_url'          => '#signature-pieces',
		'cat_men_img'              => get_theme_file_uri( 'assets/images/cat-men.jpg' ),

		// --- Value Propositions / Benefits ---
		'benefit_1_title'          => 'FREE EXPRESS SHIPPING',
		'benefit_1_subtitle'       => 'Worldwide & Fast',
		'benefit_2_title'          => 'EASY RETURNS',
		'benefit_2_subtitle'       => '30 Days Hassle-Free',
		'benefit_3_title'          => 'SECURE PAYMENTS',
		'benefit_3_subtitle'       => '100% Protected',
		'benefit_4_title'          => 'PREMIUM PACKAGING',
		'benefit_4_subtitle'       => 'Luxury in Every Detail',

		// --- Featured Collection: Signature Pieces ---
		'signature_eyebrow'        => 'FEATURED COLLECTION',
		'signature_title'          => 'Our Signature Pieces',
		'signature_subtitle'       => 'Timeless designs. Premium fabrics. Crafted for a more beautiful tomorrow.',

		// --- The Edit Section ---
		'edit_eyebrow'             => 'THE EDIT',
		'edit_title'               => 'Modern Elegance for Every Occasion',
		'edit_subtitle'            => 'From sunlit escapes to evening affairs — find your perfect look.',
		'edit_btn_text'            => 'EXPLORE EDITORIAL',
		'edit_btn_url'             => '#',
		'edit_main_img'            => get_theme_file_uri( 'assets/images/edit-main.jpg' ),

		'edit_card1_title'         => 'Resort Wear',
		'edit_card1_desc'          => 'Light. Breezy. Luxurious.',
		'edit_card1_btn'           => 'SHOP NOW',
		'edit_card1_url'           => '#',
		'edit_card1_img'           => get_theme_file_uri( 'assets/images/edit-resort.jpg' ),

		'edit_card2_title'         => 'Formal Wear',
		'edit_card2_desc'          => 'Sharp. Sophisticated. Modern.',
		'edit_card2_btn'           => 'SHOP NOW',
		'edit_card2_url'           => '#',
		'edit_card2_img'           => get_theme_file_uri( 'assets/images/edit-formal.jpg' ),

		'edit_card3_title'         => 'Accessories',
		'edit_card3_desc'          => 'The finishing touch.',
		'edit_card3_btn'           => 'SHOP NOW',
		'edit_card3_url'           => '#',
		'edit_card3_img'           => get_theme_file_uri( 'assets/images/edit-accessories.jpg' ),

		// --- Our Story Section ---
		'story_eyebrow'            => 'OUR STORY',
		'story_title'              => 'More Than Just Fashion',
		'story_paragraph'          => 'Vélora is a celebration of timeless elegance, inspired by culture, craftsmanship and the beauty of life’s finest moments. Every piece is thoughtfully designed and meticulously crafted for those who appreciate true luxury.',
		'story_btn_text'           => 'OUR JOURNEY',
		'story_btn_url'            => '#',
		'story_img'                => get_theme_file_uri( 'assets/images/story-craft.jpg' ),
		'story_stat1_num'          => 'EST. 2018',
		'story_stat1_lbl'          => 'A global fashion house',
		'story_stat2_num'          => '500+',
		'story_stat2_lbl'          => 'Curated pieces',
		'story_stat3_num'          => '100K+',
		'story_stat3_lbl'          => 'Happy customers',

		// --- Testimonials Section ---
		'testimonials_eyebrow'     => 'WHAT OUR CUSTOMERS SAY',
		'testimonials_title'       => 'Loved by Style Seekers',
		'testimonials_subtitle'    => 'Real people. Real stories. Timeless style.',
		'testimonials_rating'      => '4.9/5 from 10,000+ reviews',

		'review_1_text'            => '“Absolutely stunning quality! The fit, the fabric, everything is perfect. Velora has completely changed the way I shop for fashion.”',
		'review_1_author'          => 'Emily R.',
		'review_1_city'            => 'New York, USA',
		'review_1_avatar'          => get_theme_file_uri( 'assets/images/avatar-emily.jpg' ),

		'review_2_text'            => '“The best online fashion experience I’ve had. Elegant designs, fast shipping, and exceptional quality. Highly recommended!”',
		'review_2_author'          => 'James T.',
		'review_2_city'            => 'London, UK',
		'review_2_avatar'          => get_theme_file_uri( 'assets/images/avatar-james.jpg' ),

		'review_3_text'            => '“Vélora is luxury at its finest. Every piece feels special. I’m in love with my purchase!”',
		'review_3_author'          => 'Sophia M.',
		'review_3_city'            => 'Sydney, AUS',
		'review_3_avatar'          => get_theme_file_uri( 'assets/images/avatar-sophia.jpg' ),

		// --- Newsletter / VIP Section ---
		'newsletter_eyebrow'       => 'BE THE FIRST TO KNOW',
		'newsletter_title'         => 'Join Our Inner Circle',
		'newsletter_subtitle'      => 'Get exclusive access to new arrivals, special offers and more.',
		'newsletter_btn_text'      => 'SUBSCRIBE',
		'newsletter_bg_img'        => get_theme_file_uri( 'assets/images/vip-bg.jpg' ),

		// --- Footer ---
		'footer_about'             => 'Luxury fashion for modern lives. For women. For men. For you.',
		'footer_copyright'         => '© 2025 Vélora. All rights reserved.',
	);
}
