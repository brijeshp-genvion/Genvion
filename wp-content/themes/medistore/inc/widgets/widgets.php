<?php
/**
 * Theme Palace widgets inclusion
 *
 * This is the template that includes all custom widgets of medistore
 *
 * @package Theme Palace
 * @subpackage medistore
 * @since medistore 1.0.0
 */

/*

/*
 * Add popular post widget
 */
require get_template_directory() . '/inc/widgets/social-link-widget.php';
/*

/*
 * Add popular post widget
 */
require get_template_directory() . '/inc/widgets/latest-post-widget.php';
/*
 * Add popular post widget
 */
require get_template_directory() . '/inc/widgets/contact-info-widget.php';
/*

/**
 * Register widgets
 */
function medistore_register_widgets() {

	register_widget( 'medistore_Social_Link' );
	register_widget( 'medistore_Recent_Post' );
	register_widget( 'medistore_Contact_Info' );

}
add_action( 'widgets_init', 'medistore_register_widgets' );