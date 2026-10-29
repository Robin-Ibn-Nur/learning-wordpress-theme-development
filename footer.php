<?php
/**
 * The template for displaying the footer
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$brand_name       = robin_get_option( 'brand_name', 'VÉLORA' );
$brand_tagline    = robin_get_option( 'brand_tagline', 'TIMELESS STYLE' );
$footer_about     = robin_get_option( 'footer_about', 'Luxury fashion for modern lives. For women. For men. For you.' );
$footer_copyright = robin_get_option( 'footer_copyright', '© 2025 Vélora. All rights reserved.' );
?>

<footer class="mt-auto bg-[#0a0a0a] text-neutral-400 border-t border-neutral-900 text-xs">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-12">

		<!-- 5 Columns Footer Grid -->
		<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-10 pb-16 border-b border-neutral-800/70">

			<!-- Column 1: Brand Info & Socials -->
			<div class="space-y-4">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex flex-col">
					<span class="font-serif-luxury text-2xl tracking-[0.16em] font-light text-white uppercase">
						<?php echo esc_html( $brand_name ); ?>
					</span>
					<span class="text-[8px] font-luxury-tag text-[#c5a880] tracking-[0.25em] uppercase">
						<?php echo esc_html( $brand_tagline ); ?>
					</span>
				</a>
				<p class="text-neutral-400 text-xs leading-relaxed max-w-xs">
					<?php echo esc_html( $footer_about ); ?>
				</p>

				<!-- Social Media Icons (Instagram, Facebook, Pinterest, TikTok, Spotify) -->
				<div class="flex items-center gap-3.5 pt-2 text-neutral-400">
					<!-- Instagram -->
					<a href="#" aria-label="Instagram" class="hover:text-[#c5a880] transition">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
							<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
						</svg>
					</a>
					<!-- Facebook -->
					<a href="#" aria-label="Facebook" class="hover:text-[#c5a880] transition">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
							<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
						</svg>
					</a>
					<!-- Pinterest -->
					<a href="#" aria-label="Pinterest" class="hover:text-[#c5a880] transition">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
							<path d="M12 0c-6.627 0-12 5.372-12 12 0 5.084 3.163 9.426 7.627 11.174-.105-.949-.2-2.405.042-3.441.218-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738.098.119.112.224.083.345-.09.375-.291 1.199-.332 1.357-.053.211-.174.256-.402.155-1.499-.696-2.435-2.88-2.435-4.631 0-3.774 2.743-7.24 7.906-7.24 4.144 0 7.371 2.955 7.371 6.906 0 4.117-2.597 7.431-6.202 7.431-1.211 0-2.348-.63-2.738-1.373l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146 1.124.347 2.317.535 3.554.535 6.627 0 12-5.373 12-12 0-6.628-5.373-12-12-12z" />
						</svg>
					</a>
					<!-- TikTok -->
					<a href="#" aria-label="TikTok" class="hover:text-[#c5a880] transition">
						<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
							<path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.24 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z" />
						</svg>
					</a>
				</div>
			</div>

			<!-- Column 2: Shop -->
			<div class="space-y-3">
				<h4 class="font-luxury-tag text-white tracking-widest uppercase">
					<?php esc_html_e( 'SHOP', 'robin' ); ?>
				</h4>
				<ul class="space-y-2 text-neutral-400">
					<li><a href="#signature-pieces" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Women', 'robin' ); ?></a></li>
					<li><a href="#signature-pieces" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Men', 'robin' ); ?></a></li>
					<li><a href="#signature-pieces" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'New Arrivals', 'robin' ); ?></a></li>
					<li><a href="#signature-pieces" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Best Sellers', 'robin' ); ?></a></li>
					<li><a href="#signature-pieces" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Sale', 'robin' ); ?></a></li>
				</ul>
			</div>

			<!-- Column 3: Help -->
			<div class="space-y-3">
				<h4 class="font-luxury-tag text-white tracking-widest uppercase">
					<?php esc_html_e( 'HELP', 'robin' ); ?>
				</h4>
				<ul class="space-y-2 text-neutral-400">
					<li><a href="#" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Shipping & Returns', 'robin' ); ?></a></li>
					<li><a href="#" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Size Guide', 'robin' ); ?></a></li>
					<li><a href="#" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'FAQ', 'robin' ); ?></a></li>
					<li><a href="#" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Contact Us', 'robin' ); ?></a></li>
					<li><a href="#" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Track Order', 'robin' ); ?></a></li>
				</ul>
			</div>

			<!-- Column 4: About -->
			<div class="space-y-3">
				<h4 class="font-luxury-tag text-white tracking-widest uppercase">
					<?php esc_html_e( 'ABOUT', 'robin' ); ?>
				</h4>
				<ul class="space-y-2 text-neutral-400">
					<li><a href="#our-story" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Our Story', 'robin' ); ?></a></li>
					<li><a href="#" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Sustainability', 'robin' ); ?></a></li>
					<li><a href="#the-edit" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Journal', 'robin' ); ?></a></li>
					<li><a href="#" class="hover:text-[#c5a880] transition"><?php esc_html_e( 'Careers', 'robin' ); ?></a></li>
				</ul>
			</div>

			<!-- Column 5: Payment Methods -->
			<div class="space-y-3">
				<h4 class="font-luxury-tag text-white tracking-widest uppercase">
					<?php esc_html_e( 'PAYMENT METHODS', 'robin' ); ?>
				</h4>
				<div class="flex items-center gap-2 pt-1 flex-wrap">
					<!-- VISA -->
					<span class="inline-flex items-center justify-center px-2.5 py-1 rounded bg-neutral-900 border border-neutral-800 text-[10px] font-bold tracking-wider text-white">
						VISA
					</span>
					<!-- MasterCard -->
					<span class="inline-flex items-center justify-center px-2 py-1 rounded bg-neutral-900 border border-neutral-800 text-[10px] font-bold text-white">
						<span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block -mr-1"></span>
						<span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block opacity-80"></span>
					</span>
					<!-- PayPal -->
					<span class="inline-flex items-center justify-center px-2.5 py-1 rounded bg-neutral-900 border border-neutral-800 text-[10px] font-bold tracking-tight text-white">
						PayPal
					</span>
					<!-- Apple Pay -->
					<span class="inline-flex items-center justify-center px-2.5 py-1 rounded bg-neutral-900 border border-neutral-800 text-[10px] font-bold tracking-tight text-white">
						Pay
					</span>
				</div>
			</div>

		</div>

		<!-- Bottom Legal Bar -->
		<div class="pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-neutral-500 text-[11px]">
			<div>
				<p><?php echo esc_html( $footer_copyright ); ?></p>
			</div>

			<div class="flex items-center gap-6">
				<a href="#" class="hover:text-neutral-300 transition"><?php esc_html_e( 'Privacy Policy', 'robin' ); ?></a>
				<a href="#" class="hover:text-neutral-300 transition"><?php esc_html_e( 'Terms & Conditions', 'robin' ); ?></a>

				<!-- Back to top circular button -->
				<button id="back-to-top" type="button" aria-label="<?php esc_attr_e( 'Back to top', 'robin' ); ?>" class="w-8 h-8 rounded-full border border-neutral-800 bg-neutral-900 text-neutral-300 hover:text-white hover:border-[#c5a880] flex items-center justify-center transition">
					<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
						<path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
					</svg>
				</button>
			</div>
		</div>

	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
