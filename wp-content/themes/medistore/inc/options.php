<?php
/**
 * Theme Palace options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

/**
 * List of pages for page choices.
 * @return Array Array of page ids and name.
 */
function medistore_page_choices() {
    $pages = get_pages();
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'medistore' );
    foreach ( $pages as $page ) {
        $choices[ $page->ID ] = $page->post_title;
    }
    return  $choices;
}

/**
 * List of posts for post choices.
 * @return Array Array of post ids and name.
 */
function medistore_post_choices() {
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'medistore' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    wp_reset_postdata();
    return  $choices;
}

/**
 * List of trips for post choices.
 * @return Array Array of post ids and name.
 */
function medistore_trip_choices() {
    $posts = get_posts( array( 'post_type' => 'itineraries', 'numberposts' => -1 ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'medistore' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}

/**
 * List of products for post choices.
 * @return Array Array of post ids and name.
 */
function medistore_product_choices() {
    $posts = get_posts( array( 'numberposts' => -1, 'post_type' => 'product' ) );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'medistore' );
    foreach ( $posts as $post ) {
        $choices[ $post->ID ] = $post->post_title;
    }
    return  $choices;
}

/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function medistore_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'category',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'medistore' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}

/**
 * List of category for category choices.
 * @return Array Array of post ids and name.
 */
function medistore_product_category_choices() {
    $tax_args = array(
        'hierarchical' => 0,
        'taxonomy'     => 'product_cat',
    );
    $taxonomies = get_categories( $tax_args );
    $choices = array();
    $choices[0] = esc_html__( '--Select--', 'medistore' );
    foreach ( $taxonomies as $tax ) {
        $choices[ $tax->term_id ] = $tax->name;
    }
    return  $choices;
}




if ( ! function_exists( 'medistore_site_layout' ) ) :
    /**
     * Site Layout
     * @return array site layout options
     */
    function medistore_site_layout() {
        $medistore_site_layout = array(
            'wide'          => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
            'boxed-layout'  => esc_url( get_template_directory_uri() . '/assets/images/boxed.png' ),
        );

        $output = apply_filters( 'medistore_site_layout', $medistore_site_layout );
        return $output;
    }
endif;

if ( ! function_exists( 'medistore_selected_sidebar' ) ) :
    /**
     * Sidebars options
     * @return array Sidbar positions
     */
    function medistore_selected_sidebar() {
        $medistore_selected_sidebar = array(
            'sidebar-1'             => esc_html__( 'Default Sidebar', 'medistore' ),
            'optional-sidebar'      => esc_html__( 'Optional Sidebar 1', 'medistore' ),
            'optional-sidebar-2'    => esc_html__( 'Optional Sidebar 2', 'medistore' ),
            'optional-sidebar-3'    => esc_html__( 'Optional Sidebar 3', 'medistore' ),
            'optional-sidebar-4'    => esc_html__( 'Optional Sidebar 4', 'medistore' ),
        );

        $output = apply_filters( 'medistore_selected_sidebar', $medistore_selected_sidebar );

        return $output;
    }
endif;


if ( ! function_exists( 'medistore_global_sidebar_position' ) ) :
    /**
     * Global Sidebar position
     * @return array Global Sidebar positions
     */
    function medistore_global_sidebar_position() {
        $medistore_global_sidebar_position = array(
            'right-sidebar' => esc_url( get_template_directory_uri() . '/assets/images/right.png' ),
            'no-sidebar'    => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
        );

        $output = apply_filters( 'medistore_global_sidebar_position', $medistore_global_sidebar_position );

        return $output;
    }
endif;


if ( ! function_exists( 'medistore_sidebar_position' ) ) :
    /**
     * Sidebar position
     * @return array Sidbar positions
     */
    function medistore_sidebar_position() {
        $medistore_sidebar_position = array(
            'right-sidebar'         => esc_url( get_template_directory_uri() . '/assets/images/right.png' ),
            'no-sidebar'            => esc_url( get_template_directory_uri() . '/assets/images/full.png' ),
        );

        $output = apply_filters( 'medistore_sidebar_position', $medistore_sidebar_position );

        return $output;
    }
endif;

if ( ! function_exists( 'medistore_pagination_options' ) ) :
    /**
     * Pagination
     * @return array site pagination options
     */
    function medistore_pagination_options() {
        $medistore_pagination_options = array(
            'numeric'   => esc_html__( 'Numeric', 'medistore' ),
            'default'   => esc_html__( 'Default(Older/Newer)', 'medistore' ),
        );

        $output = apply_filters( 'medistore_pagination_options', $medistore_pagination_options );

        return $output;
    }
endif;

if ( ! function_exists( 'medistore_get_spinner_list' ) ) :
    /**
     * List of spinner icons options.
     * @return array List of all spinner icon options.
     */
    function medistore_get_spinner_list() {
        $arr = array(
            'default'               => esc_html__( 'Default', 'medistore' ),
            'spinner-wheel'         => esc_html__( 'Wheel', 'medistore' ),
            'spinner-double-circle' => esc_html__( 'Double Circle', 'medistore' ),
            'spinner-two-way'       => esc_html__( 'Two Way', 'medistore' ),
            'spinner-umbrella'      => esc_html__( 'Umbrella', 'medistore' ),
            'spinner-dots'          => esc_html__( 'Dots', 'medistore' ),
            'spinner-one-way'       => esc_html__( 'One Way', 'medistore' ),
            'spinner-fidget'        => esc_html__( 'Fidget', 'medistore' ),
        );
        return apply_filters( 'medistore_spinner_list', $arr );
    }
endif;

if ( ! function_exists( 'medistore_switch_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function medistore_switch_options() {
        $arr = array(
            'on'        => esc_html__( 'Enable', 'medistore' ),
            'off'       => esc_html__( 'Disable', 'medistore' )
        );
        return apply_filters( 'medistore_switch_options', $arr );
    }
endif;

if ( ! function_exists( 'medistore_hide_options' ) ) :
    /**
     * List of custom Switch Control options
     * @return array List of switch control options.
     */
    function medistore_hide_options() {
        $arr = array(
            'on'        => esc_html__( 'Yes', 'medistore' ),
            'off'       => esc_html__( 'No', 'medistore' )
        );
        return apply_filters( 'medistore_hide_options', $arr );
    }
endif;

if ( ! function_exists( 'medistore_sortable_sections' ) ) :
    /**
     * List of sections Control options
     * @return array List of Sections control options.
     */
    function medistore_sortable_sections() {
        $options = medistore_get_theme_options();
  
        $sections = array(
            'slider'                => esc_html__( 'Slider', 'medistore' ),
            'service'               => esc_html__( 'Service', 'medistore' ),
            'featured_post'         => esc_html__( 'Featured Post', 'medistore' ),
            'popular_post'          => esc_html__( 'Popular Post', 'medistore' ),
            'about'                => esc_html__( 'About', 'medistore' ),
            'recent_post'           => esc_html__( 'Recent Posts', 'medistore' ),
            'latest_post'           => esc_html__( 'Latest Post', 'medistore' ),
            'team'                  => esc_html__( 'Team', 'medistore' ),
            'gallery'               => esc_html__( 'Gallery', 'medistore' ),
            'magazine_featured_post'=> esc_html__( 'Magazine Featured Post', 'medistore' ),
            'magazine_latest_post'  => esc_html__( 'Magazine Latest Post', 'medistore' ),
            'magazine_sport_news'   => esc_html__( 'Magazine Sport News', 'medistore' ),
            'most_viewed'           => esc_html__( 'Most News', 'medistore' ),
            'service'               => esc_html__( 'Service', 'medistore' ),
            'blog'                  => esc_html__( 'Blog', 'medistore' ),
            'featured_products'     => esc_html__( 'Featured Products', 'medistore' ),
            'popular_product'       => esc_html__( 'Popular Products', 'medistore' ),
            'recent_product'        => esc_html__( 'Recent Products', 'medistore' ),
            'subscription'          => esc_html__( 'Subscription', 'medistore' ),
            'testimonial'           => esc_html__( 'Testimonial', 'medistore' ),
            'two_column'            => esc_html__( 'Two Column', 'medistore' ),
            'three_column'          => esc_html__( 'Three Column', 'medistore' ),
        );
      
         
        return apply_filters( 'medistore_sortable_sections', $sections );
    }
endif;


if ( ! function_exists( 'medistore_popular_product_content_type' ) ) :
    /**
     * Product Options
     * @return array site product options
     */
    function medistore_popular_product_content_type() {
        $medistore_popular_product_content_type = array(
            'category'  => esc_html__( 'Category', 'medistore' ),

        );

        if(class_exists('WooCommerce')){
            $medistore_popular_product_content_type = array_merge($medistore_popular_product_content_type, 
                array(
                    'product-category'   => esc_html__( 'Product Category', 'medistore' ),
                )
            );
        }

        $output = apply_filters( 'medistore_popular_product_content_type', $medistore_popular_product_content_type );

        return $output;
    }
endif;

if ( ! function_exists( 'medistore_typography_options' ) ) :
    function medistore_typography_options(){
    $font_family_arr = array();
    $font_family_arr[''] = esc_html__( '--Default--', 'medistore' );

    // Make the request
    $request = wp_remote_get( get_theme_file_uri( 'assets/webfonts.json' ) );

    if( is_wp_error( $request ) ) {
        return false; // Bail early
    }
     // Retrieve the data
    $body = wp_remote_retrieve_body( $request );
    $data = json_decode( $body );
    if ( ! empty( $data ) ) {
        foreach ( $data->items as $items => $fonts ) {
            $family_str_arr = explode( ' ', $fonts->family );
            $family_value = implode( '+', $family_str_arr );
            $font_family_arr[ $family_value ] = $fonts->family;
        }
    }

    return $font_family_arr;
}
endif;