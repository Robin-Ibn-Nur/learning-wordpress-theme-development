<?php
/**
 * The header for Vélora theme
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$topbar_text     = robin_get_option( 'topbar_text', 'Free express shipping on orders over $200 | Easy returns within 30 days' );
$topbar_currency = robin_get_option( 'topbar_currency', 'USD' );
$topbar_lang     = robin_get_option( 'topbar_lang', 'EN' );
$brand_name      = robin_get_option( 'brand_name', 'VÉLORA' );
$brand_tagline   = robin_get_option( 'brand_tagline', 'TIMELESS STYLE' );
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'min-h-screen flex flex-col bg-white text-neutral-900 antialiased selection:bg-[#c5a880] selection:text-white' ); ?>>
<?php wp_body_open(); ?>

<a class="sr-only focus:not-sr-only focus:fixed focus:top-4 focus:left-4 focus:z-50 focus:px-4 focus:py-2 focus:bg-[#0c0c0c] focus:text-white focus:rounded" href="#primary">
	<?php esc_html_e( 'Skip to content', 'robin' ); ?>
</a>

<!-- 1. Top Announcement Bar -->
<div class="bg-[#0c0c0c] text-white text-[11px] font-medium tracking-wide border-b border-neutral-900">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-8 flex items-center justify-between">

		<!-- Left / Center Announcement -->
		<div class="flex-1 text-center md:text-left truncate">
			<span class="text-neutral-300 font-light"><?php echo esc_html( $topbar_text ); ?></span>
		</div>

		<!-- Right Utilities (Currency, Language, Search) -->
		<div class="hidden md:flex items-center gap-5 text-neutral-300 text-[11px]">
			<div class="flex items-center gap-1 cursor-pointer hover:text-white transition">
				<span><?php echo esc_html( $topbar_currency ); ?></span>
				<svg class="w-3 h-3 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</div>

			<div class="flex items-center gap-1 cursor-pointer hover:text-white transition">
				<span><?php echo esc_html( $topbar_lang ); ?></span>
				<svg class="w-3 h-3 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
				</svg>
			</div>

			<a href="#search-modal" class="flex items-center gap-1.5 hover:text-white transition border-l border-neutral-800 pl-4">
				<span><?php esc_html_e( 'Search', 'robin' ); ?></span>
				<svg class="w-3 h-3 text-neutral-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
					<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
				</svg>
			</a>
		</div>

	</div>
</div>

<!-- 2. Main Navigation Header -->
<header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-[#e8e6df] transition duration-200">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
		<div class="flex items-center justify-between h-20 sm:h-22">

			<!-- Left Nav: Category Links -->
			<nav class="hidden lg:flex items-center gap-8 text-[13px] font-medium tracking-wide text-neutral-700" aria-label="<?php esc_attr_e( 'Primary Menu', 'robin' ); ?>">
				<a href="#signature-pieces" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Women', 'robin' ); ?></a>
				<a href="#signature-pieces" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Men', 'robin' ); ?></a>
				<a href="#signature-pieces" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Collections', 'robin' ); ?></a>
				<a href="#our-story" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'About', 'robin' ); ?></a>
				<a href="#the-edit" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Journal', 'robin' ); ?></a>
			</nav>

			<!-- Mobile Hamburger Toggle -->
			<div class="flex lg:hidden items-center">
				<button id="mobile-menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-menu" aria-label="<?php esc_attr_e( 'Open Navigation Menu', 'robin' ); ?>" class="p-2 text-neutral-800 hover:text-black focus:outline-hidden">
					<svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
					</svg>
				</button>
			</div>

			<!-- Center Logo: VÉLORA TIMELESS STYLE -->
			<div class="flex flex-col items-center justify-center text-center">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="group inline-flex flex-col items-center">
					<span class="font-serif-luxury text-2xl sm:text-3xl tracking-[0.18em] font-light text-[#0c0c0c] uppercase">
						<?php echo esc_html( $brand_name ); ?>
					</span>
					<span class="text-[8px] sm:text-[9px] font-luxury-tag text-[#c5a880] tracking-[0.3em] uppercase mt-0.5">
						<?php echo esc_html( $brand_tagline ); ?>
					</span>
				</a>
			</div>

			<!-- Right Action Icons: Search, User, Wishlist, Cart -->
			<div class="flex items-center gap-5 sm:gap-6 text-neutral-800">
				<!-- Search -->
				<a href="#signature-pieces" aria-label="<?php esc_attr_e( 'Search', 'robin' ); ?>" class="hover:text-[#c5a880] transition">
					<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
					</svg>
				</a>

				<!-- Account / User -->
				<a href="#account" aria-label="<?php esc_attr_e( 'User Profile', 'robin' ); ?>" class="hover:text-[#c5a880] transition hidden sm:inline-block">
					<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
					</svg>
				</a>

				<!-- Wishlist Heart -->
				<a href="#wishlist" aria-label="<?php esc_attr_e( 'Wishlist', 'robin' ); ?>" class="relative hover:text-[#c5a880] transition">
					<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
					</svg>
					<span id="wishlist-counter" style="display: none;" class="absolute -top-1.5 -right-2 w-4 h-4 rounded-full bg-[#c5a880] text-white text-[9px] font-bold items-center justify-center">
						0
					</span>
				</a>

				<!-- Cart Bag with '0' Count -->
				<a href="#cart" aria-label="<?php esc_attr_e( 'Shopping Bag', 'robin' ); ?>" class="relative flex items-center hover:text-[#c5a880] transition">
					<svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119 1.007zM8.625 10.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
					</svg>
					<span class="text-xs font-semibold ml-1.5 text-neutral-800">0</span>
				</a>
			</div>

		</div>
	</div>

	<!-- Mobile Navigation Drawer -->
	<div id="mobile-menu" class="hidden lg:hidden border-t border-[#e8e6df] bg-white px-6 py-6 text-neutral-800 shadow-xl">
		<nav class="flex flex-col space-y-4 text-sm font-medium tracking-wide">
			<a href="#signature-pieces" class="hover:text-[#c5a880] transition py-1"><?php esc_html_e( 'Women', 'robin' ); ?></a>
			<a href="#signature-pieces" class="hover:text-[#c5a880] transition py-1"><?php esc_html_e( 'Men', 'robin' ); ?></a>
			<a href="#signature-pieces" class="hover:text-[#c5a880] transition py-1"><?php esc_html_e( 'Collections', 'robin' ); ?></a>
			<a href="#our-story" class="hover:text-[#c5a880] transition py-1"><?php esc_html_e( 'About', 'robin' ); ?></a>
			<a href="#the-edit" class="hover:text-[#c5a880] transition py-1"><?php esc_html_e( 'Journal', 'robin' ); ?></a>
			<div class="pt-4 border-t border-neutral-100 flex items-center justify-between text-xs text-neutral-500">
				<span><?php echo esc_html( $topbar_currency ); ?> | <?php echo esc_html( $topbar_lang ); ?></span>
				<a href="#account" class="text-neutral-800 font-semibold"><?php esc_html_e( 'Sign In', 'robin' ); ?></a>
			</div>
		</nav>
	</div>
</header>
