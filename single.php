<?php
/**
 * The template for displaying all single posts
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
				<!-- Post Header -->
				<header class="mb-8">
					<?php robin_entry_categories(); ?>

					<h1 class="text-3xl sm:text-5xl font-extrabold tracking-tight text-slate-900 leading-tight mb-4">
						<?php the_title(); ?>
					</h1>

					<div class="flex flex-wrap items-center gap-4 text-sm text-slate-500 pb-6 border-b border-slate-100">
						<?php robin_posted_by(); ?>
						<span>&bull;</span>
						<?php robin_posted_on(); ?>
						<?php if ( comments_open() || get_comments_number() ) : ?>
							<span>&bull;</span>
							<span class="inline-flex items-center text-xs font-medium text-slate-500">
								<?php comments_number( __( 'No comments', 'robin' ), __( '1 comment', 'robin' ), __( '% comments', 'robin' ) ); ?>
							</span>
						<?php endif; ?>
					</div>
				</header>

				<!-- Featured Image -->
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="aspect-video w-full rounded-2xl overflow-hidden mb-10 bg-slate-100 shadow-xs">
						<?php the_post_thumbnail( 'full', array( 'class' => 'w-full h-full object-cover' ) ); ?>
					</div>
				<?php endif; ?>

				<!-- Entry Content -->
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

				<!-- Post Tags -->
				<?php
				$tags_list = get_the_tag_list( '<div class="flex flex-wrap gap-2 mt-8 pt-6 border-t border-slate-100"><span class="text-xs font-semibold uppercase tracking-wider text-slate-400 py-1">Tags:</span>', ' ', '</div>' );
				if ( $tags_list ) {
					echo $tags_list; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
				?>
			</article>

			<!-- Post Navigation -->
			<nav class="my-8 flex justify-between gap-4 text-sm font-medium">
				<div class="flex-1">
					<?php previous_post_link( '<div class="text-slate-500 text-xs mb-1">&larr; Previous Post</div><div class="text-indigo-600 font-semibold hover:underline">%link</div>' ); ?>
				</div>
				<div class="flex-1 text-right">
					<?php next_post_link( '<div class="text-slate-500 text-xs mb-1">Next Post &rarr;</div><div class="text-indigo-600 font-semibold hover:underline">%link</div>' ); ?>
				</div>
			</nav>

			<!-- Comments -->
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
