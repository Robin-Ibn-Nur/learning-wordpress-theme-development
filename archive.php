<?php
/**
 * The template for displaying archive pages
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="primary" class="flex-grow py-10 sm:py-16">
	<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

		<header class="mb-12 text-center max-w-2xl mx-auto">
			<?php
			the_archive_title( '<h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900 mb-3">', '</h1>' );
			the_archive_description( '<div class="text-slate-600 text-base leading-relaxed">', '</div>' );
			?>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', get_post_type() );
				endwhile;
				?>
			</div>

			<?php robin_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content/content', 'none' ); ?>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
