<?php
/**
 * Customizer active callbacks
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

if ( ! function_exists( 'medistore_is_loader_enable' ) ) :
	/**
	 * Check if loader is enabled.
	 *
	 * @since  medistore 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function medistore_is_loader_enable( $control ) {
		return $control->manager->get_setting( 'medistore_theme_options[loader_enable]' )->value();
	}
endif;

if ( ! function_exists( 'medistore_is_static_homepage_enable' ) ) :
	/**
	 * Check if static homepage is enabled.
	 *
	 * @since medistore 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function medistore_is_static_homepage_enable( $control ) {
		return ( 'page' == $control->manager->get_setting( 'show_on_front' )->value() );
	}
endif;

if ( ! function_exists( 'medistore_is_breadcrumb_enable' ) ) :
	/**
	 * Check if breadcrumb is enabled.
	 *
	 * @since  medistore 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function medistore_is_breadcrumb_enable( $control ) {
		return $control->manager->get_setting( 'medistore_theme_options[breadcrumb_enable]' )->value();
	}
endif;

if ( ! function_exists( 'medistore_is_pagination_enable' ) ) :
	/**
	 * Check if pagination is enabled.
	 *
	 * @since  medistore 1.0.0
	 * @param WP_Customize_Control $control WP_Customize_Control instance.
	 * @return bool Whether the control is active to the current preview.
	 */
	function medistore_is_pagination_enable( $control ) {
		return $control->manager->get_setting( 'medistore_theme_options[pagination_enable]' )->value();
	}
endif;

/**
 * Check if slider section is enabled.
 *
 * @since  medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_slider_section_enable( $control ) {
	return ( $control->manager->get_setting( 'medistore_theme_options[slider_section_enable]' )->value() );
}

/**
 * Check if about section is enabled.
 *
 * @since medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_about_section_enable( $control ) {
	return ( $control->manager->get_setting( 'medistore_theme_options[about_section_enable]' )->value() );
}
	
/**
 * Check if blog section is enabled.
 *
 * @since  medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_blog_section_enable( $control ) {
	return ( $control->manager->get_setting( 'medistore_theme_options[blog_section_enable]' )->value() );
}

/**
 * Check if blog section content type is post.
 *
 * @since  medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_blog_section_content_post_enable( $control ) {
	$content_type = $control->manager->get_setting( 'medistore_theme_options[blog_content_type]' )->value();
	return medistore_is_blog_section_enable( $control ) && ( 'post' == $content_type );
}

/**
 * Check if blog section content type is category.
 *
 * @since  medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_blog_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'medistore_theme_options[blog_content_type]' )->value();
	return medistore_is_blog_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if blog separator section is enabled.
 *
 * @since  medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_blog_section_separator_enable( $control ) {
    $content_type = $control->manager->get_setting( 'medistore_theme_options[blog_content_type]' )->value();
    return medistore_is_blog_section_enable( $control ) && !( 'recent' == $content_type || 'category' == $content_type ) ;
}

/**
 * Check if blog appointment section is enabled.
 *
 * @since  medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_blog_section_appointment_enable( $control ) {
    return ( $control->manager->get_setting( 'medistore_theme_options[blog_appointment_date_enable]' )->value() &&  medistore_is_blog_section_enable( $control ) );
}


/**
 * Check if team section is enabled.
 *
 * @since  medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_team_section_enable( $control ) {
	return ( $control->manager->get_setting( 'medistore_theme_options[team_section_enable]' )->value() );
}



/**
 * Check if popular_product section is enabled.
 *
 * @since medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_popular_product_section_enable( $control ) {
	return ( $control->manager->get_setting( 'medistore_theme_options[popular_product_section_enable]' )->value() );
}

/**
 * Check if popular_product section content type is category.
 *
 * @since medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_popular_product_section_content_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'medistore_theme_options[popular_product_content_type]' )->value();
	return medistore_is_popular_product_section_enable( $control ) && ( 'category' == $content_type );
}

/**
 * Check if popular_product section content type is product-category.
 *
 * @since medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_popular_product_section_content_product_category_enable( $control ) {
	$content_type = $control->manager->get_setting( 'medistore_theme_options[popular_product_content_type]' )->value();
	return medistore_is_popular_product_section_enable( $control ) && ( 'product-category' == $content_type );
}


/**
 * Check if popular_product section separator is enabled.
 *
 * @since  medistore 1.0.0
 * @param WP_Customize_Control $control WP_Customize_Control instance.
 * @return bool Whether the control is active to the current preview.
 */
function medistore_is_popular_product_section_separator_enable( $control ) {
    $content_type = $control->manager->get_setting( 'medistore_theme_options[popular_product_content_type]' )->value();
    return medistore_is_popular_product_section_enable( $control ) && !( 'product-category' == $content_type );
}