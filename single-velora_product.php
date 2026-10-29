<?php
/**
 * Single Product Template for Vélora Products
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

while ( have_posts() ) :
	the_post();

	$pid        = get_the_ID();
	$price      = get_post_meta( $pid, '_velora_price', true );
	$sale_price = get_post_meta( $pid, '_velora_sale_price', true );
	$dept       = get_post_meta( $pid, '_velora_department', true );
	$badge      = get_post_meta( $pid, '_velora_badge', true );

	$terms     = get_the_terms( $pid, 'velora_category' );
	$cat_title = ! empty( $dept ) ? $dept : '';
	if ( empty( $cat_title ) && ! empty( $terms ) && ! is_wp_error( $terms ) ) {
		$cat_title = $terms[0]->name;
	}
	if ( empty( $cat_title ) ) {
		$cat_title = __( 'Luxury Collection', 'robin' );
	}

	$img_url = get_the_post_thumbnail_url( $pid, 'large' );
	if ( ! $img_url ) {
		$img_url = get_theme_file_uri( 'assets/images/prod-dress.jpg' );
	}
	?>

	<main id="primary" class="bg-[#faf9f5] min-h-screen py-10 sm:py-16">
		<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

			<!-- Breadcrumbs -->
			<nav class="flex items-center gap-2 text-xs text-neutral-400 mb-8" aria-label="Breadcrumb">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-neutral-900 transition">
					<?php esc_html_e( 'Home', 'robin' ); ?>
				</a>
				<span>/</span>
				<a href="<?php echo esc_url( home_url( '/#signature-pieces' ) ); ?>" class="hover:text-neutral-900 transition">
					<?php echo esc_html( $cat_title ); ?>
				</a>
				<span>/</span>
				<span class="text-neutral-700 font-medium truncate max-w-xs sm:max-w-md">
					<?php the_title(); ?>
				</span>
			</nav>

			<!-- Product Showcase Grid -->
			<div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-16 bg-white rounded-2xl border border-[#e8e6df] p-6 sm:p-12 shadow-xs mb-16">

				<!-- Left: Product Image -->
				<div class="lg:col-span-6 space-y-4">
					<div class="relative aspect-4/5 rounded-xl overflow-hidden bg-[#f6f4ee] border border-neutral-100">
						<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php the_title_attribute(); ?>" class="w-full h-full object-cover" />

						<?php if ( ! empty( $badge ) ) : ?>
							<span class="absolute top-4 left-4 px-3 py-1 text-[10px] font-luxury-tag font-semibold tracking-widest uppercase bg-neutral-950/85 text-white rounded">
								<?php echo esc_html( $badge ); ?>
							</span>
						<?php endif; ?>
					</div>
				</div>

				<!-- Right: Product Info & Actions -->
				<div class="lg:col-span-6 flex flex-col justify-between space-y-8">
					<div class="space-y-4">
						<div class="font-luxury-tag text-xs text-[#c5a880] tracking-[0.25em] uppercase">
							<?php echo esc_html( $cat_title ); ?>
						</div>

						<h1 class="font-serif-luxury text-3xl sm:text-5xl font-normal text-neutral-900 leading-tight">
							<?php the_title(); ?>
						</h1>

						<!-- Pricing -->
						<div class="flex items-baseline gap-3 pt-1">
							<span class="text-2xl sm:text-3xl font-semibold text-neutral-900">
								<?php echo esc_html( ! empty( $price ) ? $price : '$ 0.00' ); ?>
							</span>
							<?php if ( ! empty( $sale_price ) ) : ?>
								<span class="text-lg text-neutral-400 line-through font-light">
									<?php echo esc_html( $sale_price ); ?>
								</span>
								<span class="px-2 py-0.5 text-xs font-semibold uppercase bg-emerald-50 text-emerald-700 rounded border border-emerald-200">
									<?php esc_html_e( 'Special Offer', 'robin' ); ?>
								</span>
							<?php endif; ?>
						</div>

						<!-- Rating review stars -->
						<div class="flex items-center gap-2 pt-2 text-xs text-neutral-500">
							<div class="flex text-[#c5a880]">
								<span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span><span>&#9733;</span>
							</div>
							<span class="font-medium text-neutral-800">4.9</span>
							<span>&bull;</span>
							<span><?php esc_html_e( '120+ verified customer reviews', 'robin' ); ?></span>
						</div>

						<!-- Excerpt / Short Description -->
						<?php if ( has_excerpt() ) : ?>
							<p class="text-sm text-neutral-600 font-light leading-relaxed pt-2">
								<?php echo esc_html( get_the_excerpt() ); ?>
							</p>
						<?php endif; ?>

						<!-- Size Selector Options -->
						<div class="pt-4 space-y-2">
							<label class="block text-xs font-luxury-tag tracking-wider text-neutral-800">
								<?php esc_html_e( 'SELECT SIZE', 'robin' ); ?>
							</label>
							<div class="flex items-center gap-2">
								<button type="button" class="w-10 h-10 rounded border border-neutral-900 bg-neutral-900 text-white text-xs font-medium cursor-pointer transition">XS</button>
								<button type="button" class="w-10 h-10 rounded border border-neutral-200 hover:border-neutral-900 text-neutral-800 text-xs font-medium cursor-pointer transition">S</button>
								<button type="button" class="w-10 h-10 rounded border border-neutral-200 hover:border-neutral-900 text-neutral-800 text-xs font-medium cursor-pointer transition">M</button>
								<button type="button" class="w-10 h-10 rounded border border-neutral-200 hover:border-neutral-900 text-neutral-800 text-xs font-medium cursor-pointer transition">L</button>
								<button type="button" class="w-10 h-10 rounded border border-neutral-200 hover:border-neutral-900 text-neutral-800 text-xs font-medium cursor-pointer transition">XL</button>
							</div>
						</div>

						<!-- Action Buttons -->
						<div class="flex flex-col sm:flex-row items-center gap-3 pt-4">
							<a href="#inquire" class="btn-luxury w-full sm:w-auto flex-1 text-center py-3.5 px-6 rounded-md bg-[#0c0c0c] text-white hover:bg-[#c5a880] transition text-xs font-luxury-tag tracking-[0.2em] uppercase font-medium">
								<?php esc_html_e( 'ADD TO BAG', 'robin' ); ?>
							</a>
							<button type="button" data-wishlist-btn data-liked="false" class="w-full sm:w-auto px-5 py-3.5 rounded-md border border-neutral-300 hover:border-neutral-900 text-neutral-700 hover:text-neutral-900 flex items-center justify-center gap-2 text-xs font-luxury-tag tracking-wider transition cursor-pointer">
								<svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
								</svg>
								<span><?php esc_html_e( 'WISHLIST', 'robin' ); ?></span>
							</button>
						</div>

						<!-- Value Proposition Badges -->
						<div class="border-t border-[#e8e6df] pt-6 grid grid-cols-1 sm:grid-cols-2 gap-4 text-xs text-neutral-600">
							<div class="flex items-center gap-2.5">
								<svg class="w-4 h-4 text-[#c5a880]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
								</svg>
								<span><?php esc_html_e( 'Complimentary Worldwide Shipping', 'robin' ); ?></span>
							</div>
							<div class="flex items-center gap-2.5">
								<svg class="w-4 h-4 text-[#c5a880]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
								</svg>
								<span><?php esc_html_e( '30-Day Hassle-Free Returns', 'robin' ); ?></span>
							</div>
							<div class="flex items-center gap-2.5">
								<svg class="w-4 h-4 text-[#c5a880]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
								</svg>
								<span><?php esc_html_e( 'Signature Vélora Gift Packaging', 'robin' ); ?></span>
							</div>
							<div class="flex items-center gap-2.5">
								<svg class="w-4 h-4 text-[#c5a880]" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
									<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
								</svg>
								<span><?php esc_html_e( 'Ethically Crafted Luxury Silk & Linen', 'robin' ); ?></span>
							</div>
						</div>

					</div>
				</div>

			</div>

			<!-- Product Details & Description -->
			<div class="bg-white rounded-2xl border border-[#e8e6df] p-6 sm:p-12 mb-16 shadow-xs">
				<h2 class="font-serif-luxury text-2xl sm:text-3xl text-neutral-900 mb-6 font-normal">
					<?php esc_html_e( 'Product Details & Craftsmanship', 'robin' ); ?>
				</h2>
				<div class="entry-content text-neutral-600 font-light text-sm sm:text-base leading-relaxed space-y-4">
					<?php
					the_content();
					?>
				</div>
			</div>

			<!-- Back to Collection Link -->
			<div class="text-center pb-10">
				<a href="<?php echo esc_url( home_url( '/#signature-pieces' ) ); ?>" class="inline-flex items-center gap-2 text-xs font-luxury-tag text-neutral-900 tracking-[0.2em] border-b border-neutral-900 pb-1 hover:text-[#c5a880] hover:border-[#c5a880] transition">
					<span>&larr; <?php esc_html_e( 'BACK TO SIGNATURE PIECES', 'robin' ); ?></span>
				</a>
			</div>

		</div>
	</main>

	<?php
endwhile;

get_footer();
