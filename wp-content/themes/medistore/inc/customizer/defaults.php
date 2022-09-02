<?php
/**
 * Customizer default options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 * @return array An array of default values
 */

function medistore_get_default_theme_options() {
	$theme_data = wp_get_theme();
	$medistore_default_options = array(
		// Color Options
		'header_title_color'			    => '#000',
		'header_tagline_color'			    => '#000',
		'header_txt_logo_extra'			    => 'show-all',
		'colorscheme_hue'				    => '#d87b4d',
		'colorscheme'					    => 'default',
		'theme_version'						=> 'lite-version',
		'home_layout'						=> 'default-design',

		// typography Options
		'theme_typography' 				    => 'default',
		'body_theme_typography' 		    => 'default',
		
		// loader
		'loader_enable'         		    => (bool) false,
		'loader_icon'         			    => 'default',

		// breadcrumb
		'breadcrumb_enable'				    => (bool) true,
		'breadcrumb_separator'			    => '/',
				
		// homepage options
		'enable_frontpage_content' 			=> false,

		// layout 
		'site_layout'         			    => 'wide',
		'sidebar_position'         		    => 'right-sidebar',
		'post_sidebar_position' 		    => 'right-sidebar',
		'page_sidebar_position' 		    => 'right-sidebar',
		'enable_advertisement'              => (bool) false,

		// excerpt options
		'long_excerpt_length'               => 25,

		// pagination options
		'pagination_enable'         	    => (bool) true,
		'pagination_type'         		    => 'default',

		// footer options
		'copyright_text'           		    => sprintf( esc_html_x( 'Copyright &copy; %1$s %2$s. ', '1: Year, 2: Site Title with home URL', 'medistore' ), '[the-year]', '[site-link]' ),
		'scroll_top_visible'        	    => (bool) true,

		// reset options
		'reset_options'      			    => (bool) false,
		
		// homepage sections sortable
		'pro_sortable' 						=> 'slider,about,popular_product,team,blog',

		'default_sortable' 					=> 'slider,about,popular_product,team,blog',		

		// blog/archive options
		'your_latest_posts_title' 		    => esc_html__( 'Blogs', 'medistore' ),
		'blog_column'						=> 'col-2',


		// single post theme options
		'single_post_hide_date' 		    => (bool) false,
		'single_post_hide_category'		    => (bool) false,
		'hide_date'			   				=> (bool) false,

		/* Front Page */

		// Slider
		'slider_section_enable'				=> (bool) false,
		'slider_autoplay_enable'			=> (bool) false,
		'slider_excerpt_length'				=> 25,
		'slider_btn_txt'                    => esc_html__('Learn More','medistore'),
		'slider_btn_alt_txt'                => esc_html__('Get Started','medistore'),


		//popular product
		'popular_product_section_enable'	=> false,
		'popular_product_content_type'		=> 'category',
		'popular_product_title'				=> esc_html__( 'Browse health products and medicine copy', 'medistore' ),
		'popular_product_btn_title'			=> esc_html__( 'Find More Products', 'medistore' ),

		// blog
		'blog_section_enable'			    => (bool) false,
		'blog_appointment_date_enable'	    => (bool) true,
		'blog_title'					    => esc_html__( 'Browse health products and medicine copy', 'medistore' ),
		'blog_appointment_day'			    => esc_html__( 'Monday', 'medistore' ),
		'blog_appointment_description'		=> esc_html__( 'Doctors will be available from 8 am : 12 am, kindly call to confirm your appoinment.', 'medistore' ),
		'blog_btn_title'					=> esc_html__( 'Read More Articles', 'medistore' ),
		'blog_content_type'				    => 'post',
		'blog_excerpt_length'			    => 25,
		'blog_column_layout'			    => 'col-3',


		//about 
		'about_section_enable'			    => (bool) false,
		'about_custom_title'				=> esc_html__('Sets the standard for high quality care and patient safety!','medistore'),
		'about_excerpt_length'				=> 40,
		'about_custom_content'				=> __('We have 5000+ review and our customers trust on our medicines and quality products.We deliver products in time.You can read more about us. <br> Our adminstration and support staff all have exceptional people skills and trained to assist you.','medistore'),
		'about_btn_txt'                     => esc_html__('Make Appointment','medistore'),
		'about_btn_alt_txt'                 => esc_html__('Find Doctor','medistore'),
		
		// team
		'team_section_enable'			=> false,
		'team_column'					=> 'col-3',
		'team_title'					=> esc_html__( 'Meet Our Team', 'medistore' ),
		'team_description'				=> esc_html__( 'Our administration and support staff all have exceptional people skills and trained to assist you with all medical enquires.', 'medistore' ),
		'team_btn_title'				=> esc_html__( 'View All Team', 'medistore' ),
		
	);

	$output = apply_filters( 'medistore_default_theme_options', $medistore_default_options );

	// Sort array in ascending order, according to the key:
	if ( ! empty( $output ) ) {
		ksort( $output );
	}

	return $output;
}