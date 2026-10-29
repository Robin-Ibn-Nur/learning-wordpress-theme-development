<?php
/**
 * Vélora Custom Post Types & Meta Boxes
 *
 * Provides native product upload and management capabilities
 * in the WordPress dashboard without WooCommerce or page builders.
 *
 * @package Robin
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the 'velora_product' custom post type and 'product_category' taxonomy
 */
function velora_register_product_cpt() {
	// 1. Taxonomy: Product Category
	$tax_labels = array(
		'name'              => _x( 'Product Categories', 'taxonomy general name', 'robin' ),
		'singular_name'     => _x( 'Product Category', 'taxonomy singular name', 'robin' ),
		'search_items'      => __( 'Search Categories', 'robin' ),
		'all_items'         => __( 'All Categories', 'robin' ),
		'parent_item'       => __( 'Parent Category', 'robin' ),
		'parent_item_colon' => __( 'Parent Category:', 'robin' ),
		'edit_item'         => __( 'Edit Category', 'robin' ),
		'update_item'       => __( 'Update Category', 'robin' ),
		'add_new_item'      => __( 'Add New Category', 'robin' ),
		'new_item_name'     => __( 'New Category Name', 'robin' ),
		'menu_name'         => __( 'Categories', 'robin' ),
	);

	register_taxonomy(
		'velora_category',
		array( 'velora_product' ),
		array(
			'hierarchical'      => true,
			'labels'            => $tax_labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'product-category' ),
			'show_in_rest'      => true,
		)
	);

	// 2. Custom Post Type: velora_product
	$cpt_labels = array(
		'name'                  => _x( 'Products', 'Post type general name', 'robin' ),
		'singular_name'         => _x( 'Product', 'Post type singular name', 'robin' ),
		'menu_name'             => _x( 'Products', 'Admin Menu text', 'robin' ),
		'name_admin_bar'        => _x( 'Product', 'Add New on Toolbar', 'robin' ),
		'add_new'               => __( 'Add New Product', 'robin' ),
		'add_new_item'          => __( 'Add New Product', 'robin' ),
		'new_item'              => __( 'New Product', 'robin' ),
		'edit_item'             => __( 'Edit Product', 'robin' ),
		'view_item'             => __( 'View Product', 'robin' ),
		'all_items'             => __( 'All Products', 'robin' ),
		'search_items'          => __( 'Search Products', 'robin' ),
		'not_found'             => __( 'No products found.', 'robin' ),
		'not_found_in_trash'    => __( 'No products found in Trash.', 'robin' ),
		'featured_image'        => _x( 'Product Image', 'Overrides the "Featured Image" phrase', 'robin' ),
		'set_featured_image'    => _x( 'Set product image', 'Overrides the "Set featured image" phrase', 'robin' ),
		'remove_featured_image' => _x( 'Remove product image', 'Overrides the "Remove featured image" phrase', 'robin' ),
		'use_featured_image'    => _x( 'Use as product image', 'Overrides the "Use as featured image" phrase', 'robin' ),
	);

	$cpt_args = array(
		'labels'             => $cpt_labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'products' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-tag',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true,
	);

	register_post_type( 'velora_product', $cpt_args );
}
add_action( 'init', 'velora_register_product_cpt' );

/**
 * Add custom meta boxes for Product Price, Department & Badges
 */
function velora_add_product_meta_boxes() {
	add_meta_box(
		'velora_product_details',
		__( 'Product Pricing & Details', 'robin' ),
		'velora_render_product_meta_box',
		'velora_product',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'velora_add_product_meta_boxes' );

/**
 * Render Product Meta Box Form
 *
 * @param WP_Post $post Current post object.
 */
function velora_render_product_meta_box( $post ) {
	wp_nonce_field( 'velora_save_product_meta', 'velora_product_meta_nonce' );

	$price      = get_post_meta( $post->ID, '_velora_price', true );
	$sale_price = get_post_meta( $post->ID, '_velora_sale_price', true );
	$department = get_post_meta( $post->ID, '_velora_department', true );
	$badge      = get_post_meta( $post->ID, '_velora_badge', true );
	?>
	<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; padding: 8px 0;">
		<div>
			<label for="velora_price" style="font-weight: 600; display: block; margin-bottom: 6px;">
				<?php esc_html_e( 'Regular Price (e.g. $ 420.00)', 'robin' ); ?>
			</label>
			<input type="text" id="velora_price" name="velora_price" value="<?php echo esc_attr( $price ); ?>" placeholder="$ 420.00" class="widefat" />
		</div>
		<div>
			<label for="velora_sale_price" style="font-weight: 600; display: block; margin-bottom: 6px;">
				<?php esc_html_e( 'Sale Price (optional)', 'robin' ); ?>
			</label>
			<input type="text" id="velora_sale_price" name="velora_sale_price" value="<?php echo esc_attr( $sale_price ); ?>" placeholder="$ 380.00" class="widefat" />
		</div>
		<div>
			<label for="velora_department" style="font-weight: 600; display: block; margin-bottom: 6px;">
				<?php esc_html_e( 'Department / Subtitle (e.g. Women, Men, Accessories)', 'robin' ); ?>
			</label>
			<input type="text" id="velora_department" name="velora_department" value="<?php echo esc_attr( $department ); ?>" placeholder="Women" class="widefat" />
		</div>
		<div>
			<label for="velora_badge" style="font-weight: 600; display: block; margin-bottom: 6px;">
				<?php esc_html_e( 'Badge Tag (e.g. New, Signature, Bestseller)', 'robin' ); ?>
			</label>
			<input type="text" id="velora_badge" name="velora_badge" value="<?php echo esc_attr( $badge ); ?>" placeholder="Signature" class="widefat" />
		</div>
	</div>
	<p style="color: #64748b; font-size: 13px; margin-top: 12px; margin-bottom: 0;">
		<?php esc_html_e( '💡 Remember to set the Featured Image in the right sidebar. That image will be used as the product photo on the website.', 'robin' ); ?>
	</p>
	<?php
}

/**
 * Save Product Meta Box Data
 *
 * @param int $post_id Post ID.
 */
function velora_save_product_meta( $post_id ) {
	if ( ! isset( $_POST['velora_product_meta_nonce'] ) || ! wp_verify_nonce( $_POST['velora_product_meta_nonce'], 'velora_save_product_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	if ( isset( $_POST['velora_price'] ) ) {
		update_post_meta( $post_id, '_velora_price', sanitize_text_field( $_POST['velora_price'] ) );
	}
	if ( isset( $_POST['velora_sale_price'] ) ) {
		update_post_meta( $post_id, '_velora_sale_price', sanitize_text_field( $_POST['velora_sale_price'] ) );
	}
	if ( isset( $_POST['velora_department'] ) ) {
		update_post_meta( $post_id, '_velora_department', sanitize_text_field( $_POST['velora_department'] ) );
	}
	if ( isset( $_POST['velora_badge'] ) ) {
		update_post_meta( $post_id, '_velora_badge', sanitize_text_field( $_POST['velora_badge'] ) );
	}
}
add_action( 'save_post_velora_product', 'velora_save_product_meta' );

/**
 * Custom columns in Product List table
 */
function velora_product_columns( $columns ) {
	$new_columns = array();
	foreach ( $columns as $key => $title ) {
		if ( 'title' === $key ) {
			$new_columns['velora_thumbnail'] = __( 'Image', 'robin' );
			$new_columns['title']            = $title;
			$new_columns['velora_price']     = __( 'Price', 'robin' );
			$new_columns['velora_dept']      = __( 'Department', 'robin' );
		} else {
			$new_columns[ $key ] = $title;
		}
	}
	return $new_columns;
}
add_filter( 'manage_velora_product_posts_columns', 'velora_product_columns' );

function velora_product_column_content( $column, $post_id ) {
	if ( 'velora_thumbnail' === $column ) {
		if ( has_post_thumbnail( $post_id ) ) {
			echo get_the_post_thumbnail( $post_id, array( 50, 50 ), array( 'style' => 'width: 44px; height: 50px; object-fit: cover; border-radius: 4px;' ) );
		} else {
			echo '<span style="color: #94a3b8; font-size: 11px;">' . esc_html__( 'No image', 'robin' ) . '</span>';
		}
	} elseif ( 'velora_price' === $column ) {
		$price = get_post_meta( $post_id, '_velora_price', true );
		echo esc_html( $price ? $price : '—' );
	} elseif ( 'velora_dept' === $column ) {
		$dept = get_post_meta( $post_id, '_velora_department', true );
		echo esc_html( $dept ? $dept : '—' );
	}
}
add_action( 'manage_velora_product_posts_custom_column', 'velora_product_column_content', 10, 2 );
