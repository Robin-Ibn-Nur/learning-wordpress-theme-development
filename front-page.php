<?php
/**
 * Vélora - Timeless Elegance Fashion Landing Page
 *
 * Pixel-accurate, luxury fashion landing page based on the Vélora design.
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

// Hero Settings
$hero_season          = robin_get_option( 'hero_season', 'SPRING / SUMMER 2025' );
$hero_title_line1     = robin_get_option( 'hero_title_line1', 'Timeless' );
$hero_title_line2     = robin_get_option( 'hero_title_line2', 'Elegance' );
$hero_subtitle        = robin_get_option( 'hero_subtitle', 'Effortless style for every moment.' );
$hero_btn_text        = robin_get_option( 'hero_btn_text', 'SHOP NEW ARRIVALS' );
$hero_btn_url         = robin_get_option( 'hero_btn_url', '#signature-pieces' );
$hero_bg_image        = robin_get_option( 'hero_bg_image', get_theme_file_uri( 'assets/images/hero-bg.jpg' ) );
$hero_slide_indicator = robin_get_option( 'hero_slide_indicator', '01 / 03' );

// Dual Categories Settings
$cat_women_label    = robin_get_option( 'cat_women_label', 'FOR HER' );
$cat_women_title    = robin_get_option( 'cat_women_title', 'Women' );
$cat_women_desc     = robin_get_option( 'cat_women_desc', 'Graceful. Bold. Unforgettable.' );
$cat_women_btn_text = robin_get_option( 'cat_women_btn_text', 'EXPLORE COLLECTION' );
$cat_women_btn_url  = robin_get_option( 'cat_women_btn_url', '#signature-pieces' );
$cat_women_img      = robin_get_option( 'cat_women_img', get_theme_file_uri( 'assets/images/cat-women.jpg' ) );

$cat_men_label    = robin_get_option( 'cat_men_label', 'FOR HIM' );
$cat_men_title    = robin_get_option( 'cat_men_title', 'Men' );
$cat_men_desc     = robin_get_option( 'cat_men_desc', 'Confident. Refined. Timeless.' );
$cat_men_btn_text = robin_get_option( 'cat_men_btn_text', 'EXPLORE COLLECTION' );
$cat_men_btn_url  = robin_get_option( 'cat_men_btn_url', '#signature-pieces' );
$cat_men_img      = robin_get_option( 'cat_men_img', get_theme_file_uri( 'assets/images/cat-men.jpg' ) );

// Value Props
$benefit_1_title    = robin_get_option( 'benefit_1_title', 'FREE EXPRESS SHIPPING' );
$benefit_1_subtitle = robin_get_option( 'benefit_1_subtitle', 'Worldwide & Fast' );
$benefit_2_title    = robin_get_option( 'benefit_2_title', 'EASY RETURNS' );
$benefit_2_subtitle = robin_get_option( 'benefit_2_subtitle', '30 Days Hassle-Free' );
$benefit_3_title    = robin_get_option( 'benefit_3_title', 'SECURE PAYMENTS' );
$benefit_3_subtitle = robin_get_option( 'benefit_3_subtitle', '100% Protected' );
$benefit_4_title    = robin_get_option( 'benefit_4_title', 'PREMIUM PACKAGING' );
$benefit_4_subtitle = robin_get_option( 'benefit_4_subtitle', 'Luxury in Every Detail' );

// Signature Pieces
$signature_eyebrow  = robin_get_option( 'signature_eyebrow', 'FEATURED COLLECTION' );
$signature_title    = robin_get_option( 'signature_title', 'Our Signature Pieces' );
$signature_subtitle = robin_get_option( 'signature_subtitle', 'Timeless designs. Premium fabrics. Crafted for a more beautiful tomorrow.' );

$default_products = array(
	array(
		'id'         => 1,
		'name'       => 'Silk Slip Dress',
		'category'   => 'Women',
		'tag'        => 'dresses',
		'price'      => '$ 420.00',
		'sale_price' => '',
		'badge'      => 'Bestseller',
		'image'      => get_theme_file_uri( 'assets/images/prod-dress.jpg' ),
		'link'       => '#',
	),
	array(
		'id'         => 2,
		'name'       => 'Linen Suit',
		'category'   => 'Men',
		'tag'        => 'suits',
		'price'      => '$ 780.00',
		'sale_price' => '',
		'badge'      => 'Signature',
		'image'      => get_theme_file_uri( 'assets/images/prod-suit.jpg' ),
		'link'       => '#',
	),
	array(
		'id'         => 3,
		'name'       => 'Leather Handbag',
		'category'   => 'Accessories',
		'tag'        => 'accessories',
		'price'      => '$ 650.00',
		'sale_price' => '',
		'badge'      => 'New',
		'image'      => get_theme_file_uri( 'assets/images/prod-bag.jpg' ),
		'link'       => '#',
	),
	array(
		'id'         => 4,
		'name'       => 'Leather Loafers',
		'category'   => 'Men',
		'tag'        => 'accessories',
		'price'      => '$ 390.00',
		'sale_price' => '',
		'badge'      => '',
		'image'      => get_theme_file_uri( 'assets/images/prod-loafers.jpg' ),
		'link'       => '#',
	),
	array(
		'id'         => 5,
		'name'       => 'Sunglasses',
		'category'   => 'Accessories',
		'tag'        => 'accessories',
		'price'      => '$ 180.00',
		'sale_price' => '',
		'badge'      => '',
		'image'      => get_theme_file_uri( 'assets/images/prod-sunglasses.jpg' ),
		'link'       => '#',
	),
);

// Query Custom velora_product posts
$custom_products   = array();
$active_categories = array();

$product_query = new WP_Query(
	array(
		'post_type'      => 'velora_product',
		'posts_per_page' => 20,
		'post_status'    => 'publish',
		'orderby'        => 'menu_order date',
		'order'          => 'DESC',
	)
);

if ( $product_query->have_posts() ) {
	while ( $product_query->have_posts() ) {
		$product_query->the_post();
		$pid        = get_the_ID();
		$price      = get_post_meta( $pid, '_velora_price', true );
		$sale_price = get_post_meta( $pid, '_velora_sale_price', true );
		$dept       = get_post_meta( $pid, '_velora_department', true );
		$badge      = get_post_meta( $pid, '_velora_badge', true );

		$terms     = get_the_terms( $pid, 'velora_category' );
		$tag_slugs = array();
		$cat_title = ! empty( $dept ) ? $dept : '';

		if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) {
			foreach ( $terms as $term_obj ) {
				$tag_slugs[] = $term_obj->slug;
				if ( ! isset( $active_categories[ $term_obj->slug ] ) ) {
					$active_categories[ $term_obj->slug ] = $term_obj->name;
				}
				if ( empty( $cat_title ) ) {
					$cat_title = $term_obj->name;
				}
			}
		}

		if ( empty( $cat_title ) ) {
			$cat_title = 'Vélora Collection';
		}

		$img_url = get_the_post_thumbnail_url( $pid, 'large' );
		if ( ! $img_url ) {
			$img_url = get_theme_file_uri( 'assets/images/prod-dress.jpg' );
		}

		$custom_products[] = array(
			'id'         => $pid,
			'name'       => get_the_title(),
			'category'   => $cat_title,
			'tag'        => ! empty( $tag_slugs ) ? implode( ' ', $tag_slugs ) : 'all',
			'price'      => ! empty( $price ) ? $price : '$ 0.00',
			'sale_price' => $sale_price,
			'badge'      => $badge,
			'image'      => $img_url,
			'link'       => get_permalink(),
		);
	}
	wp_reset_postdata();
}

$products = ! empty( $custom_products ) ? $custom_products : $default_products;

// The Edit Settings
$edit_eyebrow  = robin_get_option( 'edit_eyebrow', 'THE EDIT' );
$edit_title    = robin_get_option( 'edit_title', 'Modern Elegance for Every Occasion' );
$edit_subtitle = robin_get_option( 'edit_subtitle', 'From sunlit escapes to evening affairs — find your perfect look.' );
$edit_btn_text = robin_get_option( 'edit_btn_text', 'EXPLORE EDITORIAL' );
$edit_btn_url  = robin_get_option( 'edit_btn_url', '#' );
$edit_main_img = robin_get_option( 'edit_main_img', get_theme_file_uri( 'assets/images/edit-main.jpg' ) );

$edit_card1_title = robin_get_option( 'edit_card1_title', 'Resort Wear' );
$edit_card1_desc  = robin_get_option( 'edit_card1_desc', 'Light. Breezy. Luxurious.' );
$edit_card1_btn   = robin_get_option( 'edit_card1_btn', 'SHOP NOW' );
$edit_card1_url   = robin_get_option( 'edit_card1_url', '#' );
$edit_card1_img   = robin_get_option( 'edit_card1_img', get_theme_file_uri( 'assets/images/edit-resort.jpg' ) );

$edit_card2_title = robin_get_option( 'edit_card2_title', 'Formal Wear' );
$edit_card2_desc  = robin_get_option( 'edit_card2_desc', 'Sharp. Sophisticated. Modern.' );
$edit_card2_btn   = robin_get_option( 'edit_card2_btn', 'SHOP NOW' );
$edit_card2_url   = robin_get_option( 'edit_card2_url', '#' );
$edit_card2_img   = robin_get_option( 'edit_card2_img', get_theme_file_uri( 'assets/images/edit-formal.jpg' ) );

$edit_card3_title = robin_get_option( 'edit_card3_title', 'Accessories' );
$edit_card3_desc  = robin_get_option( 'edit_card3_desc', 'The finishing touch.' );
$edit_card3_btn   = robin_get_option( 'edit_card3_btn', 'SHOP NOW' );
$edit_card3_url   = robin_get_option( 'edit_card3_url', '#' );
$edit_card3_img   = robin_get_option( 'edit_card3_img', get_theme_file_uri( 'assets/images/edit-accessories.jpg' ) );

// Our Story Settings
$story_eyebrow   = robin_get_option( 'story_eyebrow', 'OUR STORY' );
$story_title     = robin_get_option( 'story_title', 'More Than Just Fashion' );
$story_paragraph = robin_get_option( 'story_paragraph', 'Vélora is a celebration of timeless elegance, inspired by culture, craftsmanship and the beauty of life’s finest moments. Every piece is thoughtfully designed and meticulously crafted for those who appreciate true luxury.' );
$story_btn_text  = robin_get_option( 'story_btn_text', 'OUR JOURNEY' );
$story_btn_url   = robin_get_option( 'story_btn_url', '#' );
$story_img       = robin_get_option( 'story_img', get_theme_file_uri( 'assets/images/story-craft.jpg' ) );
$story_stat1_num = robin_get_option( 'story_stat1_num', 'EST. 2018' );
$story_stat1_lbl = robin_get_option( 'story_stat1_lbl', 'A global fashion house' );
$story_stat2_num = robin_get_option( 'story_stat2_num', '500+' );
$story_stat2_lbl = robin_get_option( 'story_stat2_lbl', 'Curated pieces' );
$story_stat3_num = robin_get_option( 'story_stat3_num', '100K+' );
$story_stat3_lbl = robin_get_option( 'story_stat3_lbl', 'Happy customers' );

// Testimonials Settings
$testimonials_eyebrow  = robin_get_option( 'testimonials_eyebrow', 'WHAT OUR CUSTOMERS SAY' );
$testimonials_title    = robin_get_option( 'testimonials_title', 'Loved by Style Seekers' );
$testimonials_subtitle = robin_get_option( 'testimonials_subtitle', 'Real people. Real stories. Timeless style.' );
$testimonials_rating   = robin_get_option( 'testimonials_rating', '4.9/5 from 10,000+ reviews' );

$reviews = array(
	array(
		'text'   => robin_get_option( 'review_1_text', '“Absolutely stunning quality! The fit, the fabric, everything is perfect. Velora has completely changed the way I shop for fashion.”' ),
		'author' => robin_get_option( 'review_1_author', 'Emily R.' ),
		'city'   => robin_get_option( 'review_1_city', 'New York, USA' ),
		'avatar' => robin_get_option( 'review_1_avatar', get_theme_file_uri( 'assets/images/avatar-emily.jpg' ) ),
	),
	array(
		'text'   => robin_get_option( 'review_2_text', '“The best online fashion experience I’ve had. Elegant designs, fast shipping, and exceptional quality. Highly recommended!”' ),
		'author' => robin_get_option( 'review_2_author', 'James T.' ),
		'city'   => robin_get_option( 'review_2_city', 'London, UK' ),
		'avatar' => robin_get_option( 'review_2_avatar', get_theme_file_uri( 'assets/images/avatar-james.jpg' ) ),
	),
	array(
		'text'   => robin_get_option( 'review_3_text', '“Vélora is luxury at its finest. Every piece feels special. I’m in love with my purchase!”' ),
		'author' => robin_get_option( 'review_3_author', 'Sophia M.' ),
		'city'   => robin_get_option( 'review_3_city', 'Sydney, AUS' ),
		'avatar' => robin_get_option( 'review_3_avatar', get_theme_file_uri( 'assets/images/avatar-sophia.jpg' ) ),
	),
);

// Newsletter Settings
$newsletter_eyebrow  = robin_get_option( 'newsletter_eyebrow', 'BE THE FIRST TO KNOW' );
$newsletter_title    = robin_get_option( 'newsletter_title', 'Join Our Inner Circle' );
$newsletter_subtitle = robin_get_option( 'newsletter_subtitle', 'Get exclusive access to new arrivals, special offers and more.' );
$newsletter_btn_text = robin_get_option( 'newsletter_btn_text', 'SUBSCRIBE' );
$newsletter_bg_img   = robin_get_option( 'newsletter_bg_img', get_theme_file_uri( 'assets/images/vip-bg.jpg' ) );
?>

<main id="primary" class="flex-grow">

	<!-- ========================================================================= -->
	<!-- 1. HERO SECTION                                                           -->
	<!-- ========================================================================= -->
	<section id="hero" class="relative w-full aspect-16/9 sm:aspect-21/9 min-h-[480px] sm:min-h-[580px] lg:min-h-[640px] flex items-center overflow-hidden bg-neutral-900 text-white">
		<!-- Background Image -->
		<div class="absolute inset-0">
			<img src="<?php echo esc_url( $hero_bg_image ); ?>" alt="<?php echo esc_attr( $hero_title_line1 . ' ' . $hero_title_line2 ); ?>" class="w-full h-full object-cover object-center" />
			<div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>
			<div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
		</div>

		<!-- Hero Content -->
		<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-12">
			<div class="max-w-xl space-y-4 sm:space-y-6">

				<!-- Season Tag -->
				<div class="font-luxury-tag text-xs tracking-[0.25em] text-neutral-200">
					<?php echo esc_html( $hero_season ); ?>
				</div>

				<!-- Main Headline -->
				<h1 class="font-serif-luxury text-4xl sm:text-6xl lg:text-7xl font-normal leading-[1.05] tracking-tight text-white">
					<span class="block"><?php echo esc_html( $hero_title_line1 ); ?></span>
					<span class="block italic font-light"><?php echo esc_html( $hero_title_line2 ); ?></span>
				</h1>

				<!-- Subtitle -->
				<p class="text-sm sm:text-base text-neutral-200 font-light max-w-md leading-relaxed">
					<?php echo esc_html( $hero_subtitle ); ?>
				</p>

				<!-- Outlined Button -->
				<div class="pt-2">
					<a href="<?php echo esc_url( $hero_btn_url ); ?>" class="btn-luxury inline-flex items-center gap-3 px-6 py-3 rounded-full border border-white/90 bg-white/10 backdrop-blur-xs text-white text-[11px] font-semibold tracking-[0.16em] uppercase hover:bg-white hover:text-neutral-950 transition duration-300">
						<span><?php echo esc_html( $hero_btn_text ); ?></span>
						<span class="btn-arrow">&rarr;</span>
					</a>
				</div>

			</div>
		</div>

		<!-- Bottom Right Slider Indicator -->
		<div class="absolute bottom-6 right-6 sm:bottom-8 sm:right-10 z-10 flex items-center gap-3 text-xs font-luxury-tag text-white/80">
			<span><?php echo esc_html( $hero_slide_indicator ); ?></span>
			<span class="cursor-pointer hover:text-white">&rarr;</span>
		</div>
	</section>

	<!-- ========================================================================= -->
	<!-- 2. TWO CATEGORIES: WOMEN & MEN                                            -->
	<!-- ========================================================================= -->
	<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-16">
		<div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">

			<!-- Women Card -->
			<div class="relative group rounded-xl overflow-hidden aspect-16/10 bg-neutral-900 text-white flex items-end">
				<img src="<?php echo esc_url( $cat_women_img ); ?>" alt="<?php echo esc_attr( $cat_women_title ); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-700 opacity-90" />
				<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

				<div class="relative z-10 p-6 sm:p-10 space-y-2">
					<div class="font-luxury-tag text-[10px] text-neutral-300 tracking-[0.2em]">
						<?php echo esc_html( $cat_women_label ); ?>
					</div>
					<h2 class="font-serif-luxury text-3xl sm:text-4xl text-white font-normal">
						<?php echo esc_html( $cat_women_title ); ?>
					</h2>
					<p class="text-xs sm:text-sm text-neutral-300 font-light">
						<?php echo esc_html( $cat_women_desc ); ?>
					</p>
					<div class="pt-2">
						<a href="<?php echo esc_url( $cat_women_btn_url ); ?>" class="btn-luxury inline-flex items-center gap-2 text-xs font-luxury-tag text-white tracking-[0.18em] border-b border-white pb-0.5 hover:text-[#c5a880] hover:border-[#c5a880] transition">
							<span><?php echo esc_html( $cat_women_btn_text ); ?></span>
							<span class="btn-arrow">&rarr;</span>
						</a>
					</div>
				</div>
			</div>

			<!-- Men Card -->
			<div class="relative group rounded-xl overflow-hidden aspect-16/10 bg-neutral-900 text-white flex items-end">
				<img src="<?php echo esc_url( $cat_men_img ); ?>" alt="<?php echo esc_attr( $cat_men_title ); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-700 opacity-90" />
				<div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

				<div class="relative z-10 p-6 sm:p-10 space-y-2">
					<div class="font-luxury-tag text-[10px] text-neutral-300 tracking-[0.2em]">
						<?php echo esc_html( $cat_men_label ); ?>
					</div>
					<h2 class="font-serif-luxury text-3xl sm:text-4xl text-white font-normal">
						<?php echo esc_html( $cat_men_title ); ?>
					</h2>
					<p class="text-xs sm:text-sm text-neutral-300 font-light">
						<?php echo esc_html( $cat_men_desc ); ?>
					</p>
					<div class="pt-2">
						<a href="<?php echo esc_url( $cat_men_btn_url ); ?>" class="btn-luxury inline-flex items-center gap-2 text-xs font-luxury-tag text-white tracking-[0.18em] border-b border-white pb-0.5 hover:text-[#c5a880] hover:border-[#c5a880] transition">
							<span><?php echo esc_html( $cat_men_btn_text ); ?></span>
							<span class="btn-arrow">&rarr;</span>
						</a>
					</div>
				</div>
			</div>

		</div>
	</section>

	<!-- ========================================================================= -->
	<!-- 3. VALUE PROPOSITION / BENEFITS BAR                                       -->
	<!-- ========================================================================= -->
	<section class="border-y border-[#e8e6df] bg-[#faf9f5]">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-10">
			<div class="grid grid-cols-2 lg:grid-cols-4 gap-6 sm:gap-8">

				<!-- Benefit 1 -->
				<div class="flex items-center gap-3.5">
					<div class="w-10 h-10 rounded-full bg-[#f6f4ee] border border-[#e8e6df] text-[#c5a880] flex items-center justify-center shrink-0">
						<!-- Express Shipping Truck -->
						<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M8.25 18.75a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h6m-9 0H3.375a1.125 1.125 0 01-1.125-1.125V14.25m17.25 4.5a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m3 0h1.125c.621 0 1.129-.504 1.09-1.124a17.902 17.902 0 00-3.213-9.193 2.056 2.056 0 00-1.58-.86H14.25M16.5 18.75h-2.25m0-11.25H4.125c-.621 0-1.125.504-1.125 1.125v6.75" />
						</svg>
					</div>
					<div>
						<h3 class="font-luxury-tag text-[10px] text-neutral-900 tracking-wider">
							<?php echo esc_html( $benefit_1_title ); ?>
						</h3>
						<p class="text-xs text-neutral-500 font-light">
							<?php echo esc_html( $benefit_1_subtitle ); ?>
						</p>
					</div>
				</div>

				<!-- Benefit 2 -->
				<div class="flex items-center gap-3.5">
					<div class="w-10 h-10 rounded-full bg-[#f6f4ee] border border-[#e8e6df] text-[#c5a880] flex items-center justify-center shrink-0">
						<!-- Easy Returns -->
						<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
						</svg>
					</div>
					<div>
						<h3 class="font-luxury-tag text-[10px] text-neutral-900 tracking-wider">
							<?php echo esc_html( $benefit_2_title ); ?>
						</h3>
						<p class="text-xs text-neutral-500 font-light">
							<?php echo esc_html( $benefit_2_subtitle ); ?>
						</p>
					</div>
				</div>

				<!-- Benefit 3 -->
				<div class="flex items-center gap-3.5">
					<div class="w-10 h-10 rounded-full bg-[#f6f4ee] border border-[#e8e6df] text-[#c5a880] flex items-center justify-center shrink-0">
						<!-- Secure Payments Shield -->
						<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z" />
						</svg>
					</div>
					<div>
						<h3 class="font-luxury-tag text-[10px] text-neutral-900 tracking-wider">
							<?php echo esc_html( $benefit_3_title ); ?>
						</h3>
						<p class="text-xs text-neutral-500 font-light">
							<?php echo esc_html( $benefit_3_subtitle ); ?>
						</p>
					</div>
				</div>

				<!-- Benefit 4 -->
				<div class="flex items-center gap-3.5">
					<div class="w-10 h-10 rounded-full bg-[#f6f4ee] border border-[#e8e6df] text-[#c5a880] flex items-center justify-center shrink-0">
						<!-- Premium Packaging Gift -->
						<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
							<path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H4.5a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
						</svg>
					</div>
					<div>
						<h3 class="font-luxury-tag text-[10px] text-neutral-900 tracking-wider">
							<?php echo esc_html( $benefit_4_title ); ?>
						</h3>
						<p class="text-xs text-neutral-500 font-light">
							<?php echo esc_html( $benefit_4_subtitle ); ?>
						</p>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- ========================================================================= -->
	<!-- 4. FEATURED COLLECTION / OUR SIGNATURE PIECES                             -->
	<!-- ========================================================================= -->
	<section id="signature-pieces" class="py-16 sm:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

		<!-- Section Title & Intro -->
		<div class="text-center max-w-2xl mx-auto space-y-3 mb-10">
			<div class="font-luxury-tag text-xs text-[#c5a880] tracking-[0.25em]">
				<?php echo esc_html( $signature_eyebrow ); ?>
			</div>
			<h2 class="font-serif-luxury text-3xl sm:text-5xl font-normal text-[#0c0c0c]">
				<?php echo esc_html( $signature_title ); ?>
			</h2>
			<p class="text-xs sm:text-sm text-neutral-500 font-light">
				<?php echo esc_html( $signature_subtitle ); ?>
			</p>
		</div>

		<!-- Category Filter Tabs -->
		<div class="flex items-center justify-center gap-4 sm:gap-8 border-b border-[#e8e6df] pb-3 mb-12 text-xs font-medium tracking-wide flex-wrap">
			<button type="button" data-product-filter="all" class="pb-3 border-b-2 border-neutral-900 font-semibold text-neutral-900 transition cursor-pointer">
				<?php esc_html_e( 'All', 'robin' ); ?>
			</button>
			<?php if ( ! empty( $active_categories ) ) : ?>
				<?php foreach ( $active_categories as $cat_slug => $cat_name ) : ?>
					<button type="button" data-product-filter="<?php echo esc_attr( $cat_slug ); ?>" class="pb-3 border-b-2 border-transparent text-neutral-500 hover:text-neutral-900 transition cursor-pointer">
						<?php echo esc_html( $cat_name ); ?>
					</button>
				<?php endforeach; ?>
			<?php else : ?>
				<button type="button" data-product-filter="dresses" class="pb-3 border-b-2 border-transparent text-neutral-500 hover:text-neutral-900 transition cursor-pointer">
					<?php esc_html_e( 'Dresses', 'robin' ); ?>
				</button>
				<button type="button" data-product-filter="suits" class="pb-3 border-b-2 border-transparent text-neutral-500 hover:text-neutral-900 transition cursor-pointer">
					<?php esc_html_e( 'Suits', 'robin' ); ?>
				</button>
				<button type="button" data-product-filter="accessories" class="pb-3 border-b-2 border-transparent text-neutral-500 hover:text-neutral-900 transition cursor-pointer">
					<?php esc_html_e( 'Accessories', 'robin' ); ?>
				</button>
			<?php endif; ?>
		</div>

		<!-- Products Carousel Grid -->
		<div class="relative">
			<!-- Arrow Left -->
			<button id="prod-prev-btn" type="button" aria-label="Previous Products" class="hidden sm:flex absolute -left-4 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-white border border-neutral-200 shadow-md text-neutral-700 items-center justify-center hover:bg-[#c5a880] hover:text-white hover:border-[#c5a880] transition">
				&larr;
			</button>

			<!-- Products Scroll Container -->
			<div id="products-scroll-track" class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-5 sm:gap-6 overflow-x-auto no-scrollbar scroll-smooth">
				<?php foreach ( $products as $prod ) : ?>
					<div data-product-category="<?php echo esc_attr( $prod['tag'] ); ?>" class="group flex flex-col justify-between transition-all duration-300">
						<!-- Image & Wishlist -->
						<div class="relative aspect-4/5 rounded-lg overflow-hidden bg-[#f6f4ee] mb-3">
							<a href="<?php echo esc_url( $prod['link'] ); ?>" class="block w-full h-full">
								<img src="<?php echo esc_url( $prod['image'] ); ?>" alt="<?php echo esc_attr( $prod['name'] ); ?>" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" />
							</a>

							<?php if ( ! empty( $prod['badge'] ) ) : ?>
								<span class="absolute top-2.5 left-2.5 px-2 py-0.5 text-[9px] font-luxury-tag font-medium tracking-widest uppercase bg-neutral-950/80 text-white rounded">
									<?php echo esc_html( $prod['badge'] ); ?>
								</span>
							<?php endif; ?>

							<!-- Heart Wishlist Button -->
							<button type="button" data-wishlist-btn data-liked="false" aria-label="Add to wishlist" class="absolute top-2.5 right-2.5 w-7 h-7 rounded-full bg-white/80 backdrop-blur-xs text-neutral-600 flex items-center justify-center hover:text-[#c5a880] hover:bg-white transition cursor-pointer">
								<svg class="w-3.5 h-3.5 transition" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
								</svg>
							</button>
						</div>

						<!-- Details -->
						<div class="space-y-1">
							<div class="flex items-center justify-between">
								<h3 class="text-xs sm:text-[13px] font-medium text-neutral-900 group-hover:text-[#c5a880] transition truncate">
									<a href="<?php echo esc_url( $prod['link'] ); ?>">
										<?php echo esc_html( $prod['name'] ); ?>
									</a>
								</h3>
							</div>
							<div class="text-[11px] text-neutral-400 font-light">
								<?php echo esc_html( $prod['category'] ); ?>
							</div>
							<div class="text-xs font-semibold text-neutral-900 pt-0.5 flex items-center gap-2">
								<span><?php echo esc_html( $prod['price'] ); ?></span>
								<?php if ( ! empty( $prod['sale_price'] ) ) : ?>
									<span class="text-neutral-400 line-through text-[11px] font-normal"><?php echo esc_html( $prod['sale_price'] ); ?></span>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

			<!-- Arrow Right -->
			<button id="prod-next-btn" type="button" aria-label="Next Products" class="hidden sm:flex absolute -right-4 top-1/2 -translate-y-1/2 z-20 w-9 h-9 rounded-full bg-white border border-neutral-200 shadow-md text-neutral-700 items-center justify-center hover:bg-[#c5a880] hover:text-white hover:border-[#c5a880] transition">
				&rarr;
			</button>
		</div>

	</section>

	<!-- ========================================================================= -->
	<!-- 5. THE EDIT SECTION                                                       -->
	<!-- ========================================================================= -->
	<section id="the-edit" class="py-16 sm:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">

			<!-- Large Left Hero Card: Modern Elegance for Every Occasion -->
			<div class="lg:col-span-8 relative rounded-xl overflow-hidden aspect-16/10 sm:aspect-16/11 bg-neutral-900 text-white flex items-end">
				<img src="<?php echo esc_url( $edit_main_img ); ?>" alt="<?php echo esc_attr( $edit_title ); ?>" class="absolute inset-0 w-full h-full object-cover opacity-85" />
				<div class="absolute inset-0 bg-gradient-to-t from-black/85 via-black/40 to-transparent"></div>

				<div class="relative z-10 p-6 sm:p-12 space-y-3 max-w-lg">
					<div class="font-luxury-tag text-[10px] text-neutral-300 tracking-[0.25em]">
						<?php echo esc_html( $edit_eyebrow ); ?>
					</div>
					<h2 class="font-serif-luxury text-3xl sm:text-5xl text-white font-normal leading-tight">
						<?php echo esc_html( $edit_title ); ?>
					</h2>
					<p class="text-xs sm:text-sm text-neutral-300 font-light leading-relaxed">
						<?php echo esc_html( $edit_subtitle ); ?>
					</p>
					<div class="pt-3">
						<a href="<?php echo esc_url( $edit_btn_url ); ?>" class="btn-luxury inline-flex items-center gap-2.5 px-5 py-2.5 rounded-full border border-white text-white text-[10px] font-semibold tracking-[0.18em] uppercase hover:bg-white hover:text-black transition">
							<span><?php echo esc_html( $edit_btn_text ); ?></span>
							<span class="btn-arrow">&rarr;</span>
						</a>
					</div>
				</div>
			</div>

			<!-- Right Stacked 3 Cards -->
			<div class="lg:col-span-4 flex flex-col justify-between gap-4">

				<!-- Card 1: Resort Wear -->
				<div class="relative rounded-xl overflow-hidden h-[120px] sm:h-[140px] bg-neutral-900 text-white flex items-center p-6 group">
					<img src="<?php echo esc_url( $edit_card1_img ); ?>" alt="<?php echo esc_attr( $edit_card1_title ); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-60" />
					<div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-transparent"></div>
					<div class="relative z-10 space-y-1">
						<h3 class="font-serif-luxury text-2xl text-white font-normal"><?php echo esc_html( $edit_card1_title ); ?></h3>
						<p class="text-[11px] text-neutral-300 font-light"><?php echo esc_html( $edit_card1_desc ); ?></p>
						<a href="<?php echo esc_url( $edit_card1_url ); ?>" class="btn-luxury inline-flex items-center gap-1.5 text-[10px] font-luxury-tag text-white tracking-widest pt-1 border-b border-white pb-0.5 hover:text-[#c5a880] hover:border-[#c5a880] transition">
							<span><?php echo esc_html( $edit_card1_btn ); ?></span>
							<span class="btn-arrow">&rarr;</span>
						</a>
					</div>
				</div>

				<!-- Card 2: Formal Wear -->
				<div class="relative rounded-xl overflow-hidden h-[120px] sm:h-[140px] bg-neutral-900 text-white flex items-center p-6 group">
					<img src="<?php echo esc_url( $edit_card2_img ); ?>" alt="<?php echo esc_attr( $edit_card2_title ); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-60" />
					<div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-transparent"></div>
					<div class="relative z-10 space-y-1">
						<h3 class="font-serif-luxury text-2xl text-white font-normal"><?php echo esc_html( $edit_card2_title ); ?></h3>
						<p class="text-[11px] text-neutral-300 font-light"><?php echo esc_html( $edit_card2_desc ); ?></p>
						<a href="<?php echo esc_url( $edit_card2_url ); ?>" class="btn-luxury inline-flex items-center gap-1.5 text-[10px] font-luxury-tag text-white tracking-widest pt-1 border-b border-white pb-0.5 hover:text-[#c5a880] hover:border-[#c5a880] transition">
							<span><?php echo esc_html( $edit_card2_btn ); ?></span>
							<span class="btn-arrow">&rarr;</span>
						</a>
					</div>
				</div>

				<!-- Card 3: Accessories -->
				<div class="relative rounded-xl overflow-hidden h-[120px] sm:h-[140px] bg-neutral-900 text-white flex items-center p-6 group">
					<img src="<?php echo esc_url( $edit_card3_img ); ?>" alt="<?php echo esc_attr( $edit_card3_title ); ?>" class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition duration-500 opacity-60" />
					<div class="absolute inset-0 bg-gradient-to-r from-black/85 via-black/50 to-transparent"></div>
					<div class="relative z-10 space-y-1">
						<h3 class="font-serif-luxury text-2xl text-white font-normal"><?php echo esc_html( $edit_card3_title ); ?></h3>
						<p class="text-[11px] text-neutral-300 font-light"><?php echo esc_html( $edit_card3_desc ); ?></p>
						<a href="<?php echo esc_url( $edit_card3_url ); ?>" class="btn-luxury inline-flex items-center gap-1.5 text-[10px] font-luxury-tag text-white tracking-widest pt-1 border-b border-white pb-0.5 hover:text-[#c5a880] hover:border-[#c5a880] transition">
							<span><?php echo esc_html( $edit_card3_btn ); ?></span>
							<span class="btn-arrow">&rarr;</span>
						</a>
					</div>
				</div>

			</div>

		</div>
	</section>

	<!-- ========================================================================= -->
	<!-- 6. OUR STORY SECTION                                                      -->
	<!-- ========================================================================= -->
	<section id="our-story" class="py-16 sm:py-24 bg-[#faf9f5] border-y border-[#e8e6df]">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 sm:gap-14 items-center">

				<!-- Left Column: Artisan Craftsmanship Photo -->
				<div class="lg:col-span-4">
					<div class="rounded-xl overflow-hidden aspect-4/3 bg-[#f6f4ee] shadow-sm border border-[#e8e6df]">
						<img src="<?php echo esc_url( $story_img ); ?>" alt="Artisan Craftsmanship" class="w-full h-full object-cover" />
					</div>
				</div>

				<!-- Center Column: Story Narrative -->
				<div class="lg:col-span-5 space-y-4">
					<div class="font-luxury-tag text-xs text-[#c5a880] tracking-[0.25em]">
						<?php echo esc_html( $story_eyebrow ); ?>
					</div>
					<h2 class="font-serif-luxury text-3xl sm:text-4xl text-[#0c0c0c] font-normal leading-tight">
						<?php echo esc_html( $story_title ); ?>
					</h2>
					<p class="text-xs sm:text-sm text-neutral-600 font-light leading-relaxed">
						<?php echo esc_html( $story_paragraph ); ?>
					</p>
					<div class="pt-2">
						<a href="<?php echo esc_url( $story_btn_url ); ?>" class="btn-luxury inline-flex items-center gap-2 text-xs font-luxury-tag text-neutral-900 tracking-[0.18em] border-b border-neutral-900 pb-0.5 hover:text-[#c5a880] hover:border-[#c5a880] transition">
							<span><?php echo esc_html( $story_btn_text ); ?></span>
							<span class="btn-arrow">&rarr;</span>
						</a>
					</div>
				</div>

				<!-- Right Column: 3 Key Metrics -->
				<div class="lg:col-span-3 space-y-6 lg:border-l lg:border-[#e8e6df] lg:pl-10">
					<div>
						<div class="font-serif-luxury text-2xl sm:text-3xl font-normal text-neutral-900">
							<?php echo esc_html( $story_stat1_num ); ?>
						</div>
						<div class="text-xs text-neutral-500 font-light mt-0.5">
							<?php echo esc_html( $story_stat1_lbl ); ?>
						</div>
					</div>

					<div class="pt-2">
						<div class="font-serif-luxury text-2xl sm:text-3xl font-normal text-neutral-900">
							<?php echo esc_html( $story_stat2_num ); ?>
						</div>
						<div class="text-xs text-neutral-500 font-light mt-0.5">
							<?php echo esc_html( $story_stat2_lbl ); ?>
						</div>
					</div>

					<div class="pt-2">
						<div class="font-serif-luxury text-2xl sm:text-3xl font-normal text-neutral-900">
							<?php echo esc_html( $story_stat3_num ); ?>
						</div>
						<div class="text-xs text-neutral-500 font-light mt-0.5">
							<?php echo esc_html( $story_stat3_lbl ); ?>
						</div>
					</div>
				</div>

			</div>
		</div>
	</section>

	<!-- ========================================================================= -->
	<!-- 7. TESTIMONIALS SECTION                                                   -->
	<!-- ========================================================================= -->
	<section class="py-16 sm:py-24 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">

			<!-- Left Column: Title & Star Rating -->
			<div class="lg:col-span-4 space-y-3">
				<div class="font-luxury-tag text-xs text-[#c5a880] tracking-[0.22em]">
					<?php echo esc_html( $testimonials_eyebrow ); ?>
				</div>
				<h2 class="font-serif-luxury text-3xl sm:text-4xl text-[#0c0c0c] font-normal leading-tight">
					<?php echo esc_html( $testimonials_title ); ?>
				</h2>
				<p class="text-xs sm:text-sm text-neutral-500 font-light">
					<?php echo esc_html( $testimonials_subtitle ); ?>
				</p>

				<!-- Rating Stars -->
				<div class="flex items-center gap-2 pt-2 text-[#c5a880] text-xs font-medium">
					<span>★★★★★</span>
					<span class="text-neutral-600 font-normal"><?php echo esc_html( $testimonials_rating ); ?></span>
				</div>

				<!-- Carousel Navigation Controls -->
				<div class="flex items-center gap-3 pt-4">
					<button id="test-prev-btn" type="button" aria-label="Previous Testimonials" class="w-8 h-8 rounded-full border border-neutral-300 flex items-center justify-center text-neutral-700 hover:bg-neutral-900 hover:text-white hover:border-neutral-900 transition">
						&larr;
					</button>
					<button id="test-next-btn" type="button" aria-label="Next Testimonials" class="w-8 h-8 rounded-full border border-neutral-300 flex items-center justify-center text-neutral-700 hover:bg-neutral-900 hover:text-white hover:border-neutral-900 transition">
						&rarr;
					</button>
				</div>
			</div>

			<!-- Right Column: 3 Testimonial Cards Carousel -->
			<div class="lg:col-span-8 overflow-hidden">
				<div id="test-cards-track" class="flex gap-5 overflow-x-auto no-scrollbar scroll-smooth py-2">
					<?php foreach ( $reviews as $rev ) : ?>
						<div class="min-w-[260px] sm:min-w-[280px] p-6 rounded-xl bg-[#faf9f5] border border-[#e8e6df] flex flex-col justify-between space-y-4">
							<div class="flex items-center gap-3">
								<img src="<?php echo esc_url( $rev['avatar'] ); ?>" alt="<?php echo esc_attr( $rev['author'] ); ?>" class="w-9 h-9 rounded-full object-cover border border-[#e8e6df]" />
								<div>
									<div class="text-xs font-semibold text-neutral-900"><?php echo esc_html( $rev['author'] ); ?></div>
									<div class="text-[10px] text-neutral-400 font-light"><?php echo esc_html( $rev['city'] ); ?></div>
								</div>
							</div>
							<p class="text-xs leading-relaxed text-neutral-600 italic font-light">
								<?php echo esc_html( $rev['text'] ); ?>
							</p>
							<div class="text-[#c5a880] text-xs">★★★★★</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>

		</div>
	</section>

	<!-- ========================================================================= -->
	<!-- 8. NEWSLETTER / JOIN OUR INNER CIRCLE                                     -->
	<!-- ========================================================================= -->
	<section class="relative bg-[#0c0c0c] text-white py-12 sm:py-16 overflow-hidden border-t border-neutral-900">
		<!-- Subtle Background Image -->
		<div class="absolute inset-0 pointer-events-none">
			<img src="<?php echo esc_url( $newsletter_bg_img ); ?>" alt="Inner Circle Background" class="w-full h-full object-cover opacity-20 filter brightness-50" />
			<div class="absolute inset-0 bg-gradient-to-r from-black/90 via-black/80 to-black/90"></div>
		</div>

		<div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
			<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center justify-between">

				<!-- Left Text -->
				<div class="lg:col-span-7 space-y-2">
					<div class="font-luxury-tag text-[10px] text-[#c5a880] tracking-[0.25em]">
						<?php echo esc_html( $newsletter_eyebrow ); ?>
					</div>
					<h2 class="font-serif-luxury text-2xl sm:text-4xl text-white font-normal">
						<?php echo esc_html( $newsletter_title ); ?>
					</h2>
					<p class="text-xs sm:text-sm text-neutral-400 font-light max-w-md">
						<?php echo esc_html( $newsletter_subtitle ); ?>
					</p>
				</div>

				<!-- Right Input & Subscribe Button -->
				<div class="lg:col-span-5">
					<form action="#" method="post" onsubmit="alert('Thank you for subscribing to the Vélora Inner Circle.'); return false;" class="flex items-center gap-2">
						<input type="email" required placeholder="<?php esc_attr_e( 'Your email address', 'robin' ); ?>" class="w-full px-4 py-3 rounded-none border border-neutral-700 bg-black/60 text-xs text-white placeholder-neutral-500 focus:outline-hidden focus:border-[#c5a880] transition" />
						<button type="submit" class="px-6 py-3 bg-[#c5a880] text-neutral-950 font-luxury-tag text-[10px] font-bold tracking-wider hover:bg-[#d6bb94] transition cursor-pointer shrink-0">
							<?php echo esc_html( $newsletter_btn_text ); ?>
						</button>
					</form>
				</div>

			</div>
		</div>
	</section>

</main>

<?php
get_footer();
