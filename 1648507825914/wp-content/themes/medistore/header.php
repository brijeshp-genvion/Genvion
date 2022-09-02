<?php
	/**
	 * The header for our theme.
	 *
	 * This is the template that displays all of the <head> section and everything up until <div id="content">
	 *
	 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
	 *
	 * @package Theme Palace
	 * @subpackage  medistore
	 * @since  medistore 1.0.0
	 */

	/**
	 * medistore_doctype hook
	 *
	 * @hooked medistore_doctype -  10
	 *
	 */
	do_action( 'medistore_doctype' );

?>
<head>
<?php
	/**
	 * medistore_before_wp_head hook
	 *
	 * @hooked medistore_head -  10
	 *
	 */
	do_action( 'medistore_before_wp_head' );

	wp_head(); 
?>
</head>

<body <?php body_class(); ?>>

<?php do_action( 'wp_body_open' ); ?>
<?php
	/**
	 * medistore_page_start_action hook
	 *
	 * @hooked medistore_page_start -  10
	 *
	 */
	do_action( 'medistore_page_start_action' ); 

	/**
	 * medistore_loader_action hook
	 *
	 * @hooked medistore_loader -  10
	 *
	 */
	do_action( 'medistore_before_header' );

	/**
	 * medistore_header_action hook
	 *
	 * @hooked medistore_site_branding -  10
	 * @hooked medistore_header_start -  20
	 * @hooked medistore_site_navigation -  30
	 * @hooked medistore_header_end -  50
	 *
	 */
	do_action( 'medistore_header_action' );

	/**
	 * medistore_content_start_action hook
	 *
	 * @hooked medistore_content_start -  10
	 *
	 */
	do_action( 'medistore_content_start_action' );

    /**
     * medistore_header_image_action hook
     *
     * @hooked medistore_header_image -  10
     *
     */
    do_action( 'medistore_header_image_action' );
	
