<?php
/**
 * Template part for displaying posts in an archive/loop
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'flex flex-col bg-white rounded-2xl border border-slate-200/80 shadow-xs overflow-hidden hover:shadow-md transition duration-300' ); ?>>
	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" class="block aspect-video overflow-hidden bg-slate-100">
			<?php
			the_post_thumbnail(
				'medium_large',
				array(
					'class' => 'w-full h-full object-cover group-hover:scale-105 transition duration-500',
				)
			);
			?>
		</a>
	<?php endif; ?>

	<div class="flex-1 p-6 flex flex-col justify-between">
		<div>
			<?php robin_entry_categories(); ?>

			<h2 class="text-xl font-bold tracking-tight text-slate-900 mb-2 hover:text-indigo-600 transition">
				<a href="<?php the_permalink(); ?>" rel="bookmark">
					<?php the_title(); ?>
				</a>
			</h2>

			<div class="text-sm text-slate-600 line-clamp-3 mb-4 leading-relaxed">
				<?php the_excerpt(); ?>
			</div>
		</div>

		<div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs text-slate-500">
			<?php robin_posted_by(); ?>
			<?php robin_posted_on(); ?>
		</div>
	</div>
</article>
