<?php
/**
 * medistore WooCoommerce compatibility hooks.
 *
 * This is the template that includes all WooCoommerce hooks to make the theme compatible with WooCommerce.
 *
 * @package Theme Palace
 * @subpackage medistore
 * @since medistore 1.0.0
 */

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action( 'woocommerce_archive_description', 'woocommerce_taxonomy_archive_description' ,10 );
remove_action( 'woocommerce_archive_description', 'woocommerce_product_archive_description' ,10 );
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb' ,20 );

function medistore_before_main_content() {
	echo '<div id="inner-content-wrapper" class="wrapper page-section">';
}
add_action( 'woocommerce_before_main_content', 'medistore_before_main_content', 5 );

function medistore_after_main_content() {
	echo '</div>';
}
add_action( 'woocommerce_sidebar', 'medistore_after_main_content', 20 );

// remove title
add_filter('woocommerce_show_page_title', 'medistore_hide_title' );
function medistore_hide_title() {
	return false;
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'medistore_loop_columns');
if ( ! function_exists('medistore_loop_columns')) {
	/**
	 * Shop Page no. of column
	 *
	 * @since medistore 1.0
	 *
	 */
	function medistore_loop_columns() {
		if ( is_front_page() )
			return 4; // 4 products per row

		return 3; // 3 products per row
	}
}

if ( ! function_exists('medistore_product_link_open')) {
	/**
	 * Shop Page no. of column
	 *
	 * @since medistore 1.0
	 *
	 */
	function medistore_product_link_open() {		
		echo '<div class="product-item-wrapper">';
	}
}
add_action('woocommerce_before_shop_loop_item', 'medistore_product_link_open', 5);

if ( ! function_exists('medistore_product_link_close')) {
	/**
	 * Shop Page no. of column
	 *
	 * @since medistore 1.0
	 *
	 */
	function medistore_product_link_close() {		
		echo '</div></div>';
	}
}
add_action('woocommerce_after_shop_loop_item', 'medistore_product_link_close', 20);

if ( ! function_exists('medistore_product_featured_image')) {
	/**
	 * Shop Page no. of column
	 *
	 * @since medistore 1.0
	 *
	 */
	function medistore_product_featured_image() {		
		echo '<div class="featured-image">';
	}
}
add_action('woocommerce_before_shop_loop_item', 'medistore_product_featured_image', 15);

if ( ! function_exists('medistore_product_wrapper_close')) {
	/**
	 * Shop Page no. of column
	 *
	 * @since medistore 1.0
	 *
	 */
	function medistore_product_wrapper_close() {		
		echo '</a></div>';
	}
}
add_action('woocommerce_before_shop_loop_item_title', 'medistore_product_wrapper_close', 15);

if ( ! function_exists('medistore_product_entry_content')) {
	/**
	 * Shop Page no. of column
	 *
	 * @since medistore 1.0
	 *
	 */
	function medistore_product_entry_content() {		
		echo '<div class="entry-container">';
	}
}

add_action('woocommerce_before_shop_loop_item_title', 'medistore_product_entry_content', 20);
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_link_open', 25);
add_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 20);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 15);
// remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

if ( ! function_exists('medistore_product_sidebar')) {
	/**
	 * WooCommerce sidebar
	 *
	 * @since medistore 1.0
	 *
	 */
	function medistore_product_sidebar() {		
		if ( is_product() )
			return;

		if ( medistore_is_sidebar_enable() ) {
			get_sidebar();
		}
	}
}
add_action('woocommerce_sidebar', 'medistore_product_sidebar', 10);
