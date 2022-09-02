<?php
/**
* Partial functions
*
* @package Theme Palace
* @subpackage  medistore
* @since  medistore 1.0.0
*/

// blog btn title
if ( ! function_exists( 'medistore_copyright_text_partial' ) ) :
    function medistore_copyright_text_partial() {
        $options = medistore_get_theme_options();
        return esc_html( $options['copyright_text'] );
    }
endif;

// slider_btn_txt
if ( ! function_exists( 'medistore_slider_btn_txt_partial' ) ) :
    function medistore_slider_btn_txt_partial() {
        $options = medistore_get_theme_options();
        return esc_html( $options['slider_btn_txt'] );
    }
endif;

// slider_btn_alt_txt
if ( ! function_exists( 'medistore_slider_btn_alt_txt_partial' ) ) :
    function medistore_slider_btn_alt_txt_partial() {
        $options = medistore_get_theme_options();
        return esc_html( $options['slider_btn_alt_txt'] );
    }
endif;

// blog_title selective refresh
if ( ! function_exists( 'medistore_blog_title_partial' ) ) :
    function medistore_blog_title_partial() {
        $options = medistore_get_theme_options();
        return esc_html( $options['blog_title'] );
    }
endif;

// blog_btn_title selective refresh
if ( ! function_exists( 'medistore_blog_btn_title_partial' ) ) :
    function medistore_blog_btn_title_partial() {
        $options = medistore_get_theme_options();
        return esc_html( $options['blog_btn_title'] );
    }
endif;

// blog_appointment_day selective refresh
if ( ! function_exists( 'medistore_blog_appointment_day_partial' ) ) :
    function medistore_blog_appointment_day_partial() {
        $options = medistore_get_theme_options();
        return esc_html( $options['blog_appointment_day'] );
    }
endif;

// blog_appointment_description selective refresh
if ( ! function_exists( 'medistore_blog_appointment_description_partial' ) ) :
    function medistore_blog_appointment_description_partial() {
        $options = medistore_get_theme_options();
        return esc_html( $options['blog_appointment_description'] );
    }
endif;

// popular_product_btn_title selective refresh
if ( ! function_exists( 'medistore_popular_product_btn_title_partial' ) ) :
    function medistore_popular_product_btn_title_partial() {
        $options = medistore_get_theme_options();
        return esc_html( $options['popular_product_btn_title'] );
    }
endif;

// popular_product_title selective refresh
if ( ! function_exists( 'medistore_popular_product_title_partial' ) ) :
    function medistore_popular_product_title_partial() {
        $options = medistore_get_theme_options();
        return esc_html( $options['popular_product_title'] );
    }
endif;
