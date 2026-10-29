<?php
/**
 * The sidebar containing the main widget area
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<div class="space-y-6">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</div>
