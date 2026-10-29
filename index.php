<?php
/**
 * The main template file
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

		<?php if ( is_home() && ! is_front_page() ) : ?>
			<header class="mb-10 text-center">
				<h1 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900">
					<?php single_post_title(); ?>
				</h1>
			</header>
		<?php endif; ?>

		<div class="grid grid-cols-1 <?php echo is_active_sidebar( 'sidebar-1' ) ? 'lg:grid-cols-3' : ''; ?> gap-8">
			<!-- Main Posts Grid -->
			<div class="<?php echo is_active_sidebar( 'sidebar-1' ) ? 'lg:col-span-2' : ''; ?>">
				<?php if ( have_posts() ) : ?>
					<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
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

			<!-- Sidebar -->
			<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
				<aside id="secondary" class="widget-area lg:col-span-1">
					<?php get_sidebar(); ?>
				</aside>
			<?php endif; ?>
		</div>

	</div>
</main>

<?php
get_footer();
