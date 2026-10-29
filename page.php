<?php
/**
 * The template for displaying all pages
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="flex-grow py-10 sm:py-16">
	<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

		<?php
		while ( have_posts() ) :
			the_post();
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-3xl border border-slate-200/80 shadow-xs p-6 sm:p-12 mb-10' ); ?>>
				<header class="mb-8">
					<h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900 mb-2">
						<?php the_title(); ?>
					</h1>
				</header>

				<?php if ( has_post_thumbnail() ) : ?>
					<div class="aspect-video w-full rounded-2xl overflow-hidden mb-8 bg-slate-100">
						<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
					</div>
				<?php endif; ?>

				<div class="entry-content">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<div class="page-links mt-8 pt-4 border-t border-slate-100 flex items-center gap-2"><span class="font-semibold text-sm text-slate-700">' . esc_html__( 'Pages:', 'robin' ) . '</span>',
							'after'  => '</div>',
						)
					);
					?>
				</div>
			</article>

			<?php
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile;
		?>

	</div>
</main>

<?php
get_footer();
