<?php
/**
 * Theme Palace custom helper funtions
 *
 * This is the template that includes all the other files for core featured of Photo Fusion Pro
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

if( ! function_exists( 'medistore_check_enable_status' ) ):
	/**
	 * Check status of content.
	 *
	 * @since  medistore 1.0.0
	 */
  	function medistore_check_enable_status( $input, $content_enable ){
		$options = medistore_get_theme_options();

		// Content status.
		$content_status = $options[ $content_enable ];

		if ( ( ! is_home() && is_front_page() ) && $content_status ) {
			$input = true;
		}
		else {
			$input = false;
		}
		
		return $input;
  	}
endif;
add_filter( 'medistore_section_status', 'medistore_check_enable_status', 10, 2 );


if ( ! function_exists( 'medistore_is_sidebar_enable' ) ) :
	/**
	 * Check if sidebar is enabled in meta box first then in customizer
	 *
	 * @since  medistore 1.0.0
	 */
	function medistore_is_sidebar_enable() {
		$options               = medistore_get_theme_options();
		$sidebar_position      = $options['sidebar_position'];

		if ( is_home() ) {
			$post_id = get_option( 'page_for_posts' );
			if ( ! empty( $post_id ) )
				$post_sidebar_position = get_post_meta( $post_id, 'medistore-sidebar-position', true );
			else
				$post_sidebar_position = '';
		} elseif ( is_archive() || is_search() ) {
			$post_sidebar_position = '';
		} else {
			$post_sidebar_position = get_post_meta( get_the_id(), 'medistore-sidebar-position', true );
			if ( is_single() ) {
				$post_sidebar_position = ! empty( $post_sidebar_position ) ? $post_sidebar_position : $options['post_sidebar_position'];
			} elseif ( is_page() ) {
				$post_sidebar_position = ! empty( $post_sidebar_position ) ? $post_sidebar_position : $options['page_sidebar_position'];
			}
		}
		if ( ( in_array( $sidebar_position, array( 'no-sidebar', 'no-sidebar-content' ) ) && $post_sidebar_position == "" ) || in_array( $post_sidebar_position, array( 'no-sidebar', 'no-sidebar-content' ) ) ) {
			return false;
		} else {
			return true;
		}

	}
endif;

add_action( 'medistore_action_pagination', 'medistore_pagination', 10 );
if ( ! function_exists( 'medistore_pagination' ) ) :

	/**
	 * pagination.
	 *
	 * @since  medistore 1.0.0
	 */
	function medistore_pagination() {
		$options = medistore_get_theme_options();
		if ( true == $options['pagination_enable'] ) {
			$pagination = $options['pagination_type'];
			if ( $pagination == 'default' ) :
				the_posts_navigation( array(
			'prev_text'	=> medistore_get_svg( array( 'icon' => 'left' ) ) .  '<span>' . esc_html__( 'Prev', 'medistore' ) . '</span>',
            'next_text' => '<span>' . esc_html__( 'Next', 'medistore' ) . '</span>' . medistore_get_svg( array( 'icon' => 'right' ) ),
		) );
			elseif ( in_array( $pagination, array( 'infinite', 'numeric' ) ) ) :
				the_posts_pagination( array(
				    'mid_size'  => 4,
				    'prev_text' => medistore_get_svg( array( 'icon' => 'left') ),
				    'next_text' => medistore_get_svg( array( 'icon' => 'right' ) ),
				) );
			endif;
		}
	}

endif;


add_action( 'medistore_action_post_pagination', 'medistore_post_pagination', 10 );

if ( ! function_exists( 'medistore_post_pagination' ) ) :

	/**
	 * post pagination.
	 *
	 * @since  medistore 1.0.0
	 */
	function medistore_post_pagination() {
		the_post_navigation( array(
			'prev_text'	=> medistore_get_svg( array( 'icon' => 'left' ) ) .  '<span>%title</span>',
            'next_text' => '<span>%title</span>' . medistore_get_svg( array( 'icon' => 'right' ) ),
		) );
	}
endif;

if ( ! function_exists( 'medistore_excerpt_length' ) ) :
	/**
	 * long excerpt
	 * 
	 * @since Careerpress Pro 1.0.0
	 * @return long excerpt value
	 */
	function medistore_excerpt_length( $length ){
		if ( is_admin() ) {
			return $length;
		}

		$options = medistore_get_theme_options();
		$length = $options['long_excerpt_length'];
		return $length;
	}
endif;
add_filter( 'excerpt_length', 'medistore_excerpt_length', 999 );


if ( ! function_exists( 'medistore_trim_content' ) ) :
	/**
	 * custom excerpt function
	 * 
	 * @since  medistore 1.0.0
	 * @return  no of words to display
	 */
	function medistore_trim_content( $length = 40, $post_obj = null ) {
		global $post;
		if ( is_null( $post_obj ) ) {
			$post_obj = $post;
		}

		$length = absint( $length );
		if ( $length < 1 ) {
			$length = 40;
		}

		$source_content = $post_obj->post_content;
		if ( ! empty( $post_obj->post_excerpt ) ) {
			$source_content = $post_obj->post_excerpt;
		}

		$source_content = preg_replace( '`\[[^\]]*\]`', '', $source_content );
		$trimmed_content = wp_trim_words( $source_content, $length, '...' );

	   return apply_filters( 'medistore_trim_content', $trimmed_content );
	}
endif;


if ( ! function_exists( 'medistore_layout' ) ) :
	/**
	 * Check home page layout option
	 *
	 * @since  medistore 1.0.0
	 *
	 * @return string  medistore layout value
	 */
	function medistore_layout() {
		$options = medistore_get_theme_options();

		$sidebar_position = $options['sidebar_position'];
		$sidebar_position_post = $options['post_sidebar_position'];
		$sidebar_position_page = $options['page_sidebar_position'];
		$sidebar_position = apply_filters( 'medistore_sidebar_position', $sidebar_position );
		// Check if single and static blog page
		if ( is_singular() || is_home() ) {
			if ( is_home() ) {
				$post_sidebar_position = get_post_meta( get_option( 'page_for_posts' ), 'medistore-sidebar-position', true );
			} else {
				$post_sidebar_position = get_post_meta( get_the_ID(), 'medistore-sidebar-position', true );
			}
			if ( isset( $post_sidebar_position ) && ! empty( $post_sidebar_position ) ) {
				$sidebar_position = $post_sidebar_position;
			} elseif ( is_single() ) {
				$sidebar_position = $sidebar_position_post;
			} elseif ( is_page() ) {
				$sidebar_position = $sidebar_position_page;
			}
		} 
		return $sidebar_position;
	}
endif;

/**
 * Add SVG definitions to the footer.
 */
function medistore_include_svg_icons() {
	// Define SVG sprite file.
	$svg_icons = get_template_directory() . '/assets/images/svg-icons.svg';

	// If it exists, include it.
	if ( file_exists( $svg_icons ) ) {
		require  $svg_icons;
	}
}
add_action( 'wp_footer', 'medistore_include_svg_icons', 9999 );

/**
 * Return SVG markup.
 *
 * @param array $args {
 *     Parameters needed to display an SVG.
 *
 *     @type string $icon  Required SVG icon filename.
 *     @type string $title Optional SVG title.
 *     @type string $desc  Optional SVG description.
 * }
 * @return string SVG markup.
 */
function medistore_get_svg( $args = array() ) {
	// Make sure $args are an array.
	if ( empty( $args ) ) {
		return esc_html__( 'Please define default parameters in the form of an array.', 'medistore' );
	}

	// Define an icon.
	if ( false === array_key_exists( 'icon', $args ) ) {
		return esc_html__( 'Please define an SVG icon filename.', 'medistore' );
	}

	// Set defaults.
	$defaults = array(
		'icon'        => '',
		'title'       => '',
		'desc'        => '',
		'class'        => '',
		'fallback'    => false,
	);

	// Parse args.
	$args = wp_parse_args( $args, $defaults );

	// Set aria hidden.
	$aria_hidden = ' aria-hidden="true"';

	// Set ARIA.
	$aria_labelledby = '';

	/*
	 * Theme Palace doesn't use the SVG title or description attributes; non-decorative icons are described with .screen-reader-text.
	 *
	 * However, child themes can use the title and description to add information to non-decorative SVG icons to improve accessibility.
	 *
	 * Example 1 with title: <?php echo medistore_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ) ) ); ?>
	 *
	 * Example 2 with title and description: <?php echo medistore_get_svg( array( 'icon' => 'arrow-right', 'title' => __( 'This is the title', 'textdomain' ), 'desc' => __( 'This is the description', 'textdomain' ) ) ); ?>
	 *
	 * See https://www.paciellogroup.com/blog/2013/12/using-aria-enhance-svg-accessibility/.
	 */
	if ( $args['title'] ) {
		$aria_hidden     = '';
		$unique_id    	 = uniqid();
		$aria_labelledby = ' aria-labelledby="title-' . esc_attr( $unique_id ) . '"';

		if ( $args['desc'] ) {
			$aria_labelledby = ' aria-labelledby="title-' . esc_attr( $unique_id ) . ' desc-' . esc_attr( $unique_id ) . '"';
		}
	}

	// Begin SVG markup.
	$svg = '<svg class="icon icon-' . esc_attr( $args['icon'] ) . ' ' . esc_attr( $args['class'] ) . '"' . $aria_hidden . $aria_labelledby . ' role="img">';

	// Display the title.
	if ( $args['title'] ) {
		$svg .= '<title id="title-' . esc_attr( $unique_id ) . '">' . esc_html( $args['title'] ) . '</title>';

		// Display the desc only if the title is already set.
		if ( $args['desc'] ) {
			$svg .= '<desc id="desc-' . esc_attr( $unique_id ) . '">' . esc_html( $args['desc'] ) . '</desc>';
		}
	}

	/*
	 * Display the icon.
	 *
	 * The whitespace around `<use>` is intentional - it is a work around to a keyboard navigation bug in Safari 10.
	 *
	 * See https://core.trac.wordpress.org/ticket/38387.
	 */
	$svg .= ' <use href="#icon-' . esc_html( $args['icon'] ) . '" xlink:href="#icon-' . esc_html( $args['icon'] ) . '"></use> ';

	// Add some markup to use as a fallback for browsers that do not support SVGs.
	if ( $args['fallback'] ) {
		$svg .= '<span class="svg-fallback icon-' . esc_attr( $args['icon'] ) . '"></span>';
	}

	$svg .= '</svg>';

	return $svg;
}

/**
 * Add dropdown icon if menu item has children.
 *
 * @param  string $title The menu item's title.
 * @param  object $item  The current menu item.
 * @param  array  $args  An array of wp_nav_menu() arguments.
 * @param  int    $depth Depth of menu item. Used for padding.
 * @return string $title The menu item's title with dropdown icon.
 */
function medistore_dropdown_icon_to_menu_link( $title, $item, $args, $depth ) {
	if ( 'primary' === $args->theme_location ) {
		foreach ( $item->classes as $value ) {
			if ( 'menu-item-has-children' === $value || 'page_item_has_children' === $value ) {
				$title = $title . medistore_get_svg( array( 'icon' => 'down' ) );
			}
		}
	}

	return $title;
}
add_filter( 'nav_menu_item_title', 'medistore_dropdown_icon_to_menu_link', 10, 4 );

/**
 * Returns an array of supported social links (URL and icon name).
 *
 * @return array $social_links_icons
 */
function medistore_social_links_icons() {
	// Supported social links icons.
	$social_links_icons = array(
		'behance.net'     => 'behance',
		'codepen.io'      => 'codepen',
		'deviantart.com'  => 'deviantart',
		'digg.com'        => 'digg',
		'dribbble.com'    => 'dribbble',
		'dropbox.com'     => 'dropbox',
		'facebook.com'    => 'facebook',
		'flickr.com'      => 'flickr',
		'foursquare.com'  => 'foursquare',
		'plus.google.com' => 'google-plus',
		'github.com'      => 'github',
		'instagram.com'   => 'instagram',
		'linkedin.com'    => 'linkedin',
		'mailto:'         => 'envelope-o',
		'medium.com'      => 'medium',
		'pinterest.com'   => 'pinterest-p',
		'getpocket.com'   => 'get-pocket',
		'reddit.com'      => 'reddit-alien',
		'skype.com'       => 'skype',
		'skype:'          => 'skype',
		'slideshare.net'  => 'slideshare',
		'snapchat.com'    => 'snapchat-ghost',
		'soundcloud.com'  => 'soundcloud',
		'spotify.com'     => 'spotify',
		'stumbleupon.com' => 'stumbleupon',
		'tumblr.com'      => 'tumblr',
		'twitch.tv'       => 'twitch',
		'twitter.com'     => 'twitter',
		'vimeo.com'       => 'vimeo',
		'vine.co'         => 'vine',
		'vk.com'          => 'vk',
		'wordpress.org'   => 'wordpress',
		'wordpress.com'   => 'wordpress',
		'yelp.com'        => 'yelp',
		'youtube.com'     => 'youtube',
	);

	/**
	 * Filter  medistore social links icons.
	 *
	 * @since  medistore 1.0.0
	 *
	 * @param array $social_links_icons Array of social links icons.
	 */
	return apply_filters( 'medistore_social_links_icons', $social_links_icons );
}

/**
 * Display SVG icons in social links menu.
 *
 * @param  string  $item_output The menu item output.
 * @param  WP_Post $item        Menu item object.
 * @param  int     $depth       Depth of the menu.
 * @param  array   $args        wp_nav_menu() arguments.
 * @return string  $item_output The menu item output with social icon.
 */
function medistore_nav_menu_social_icons( $item_output, $item, $depth, $args ) {
	// Get supported social icons.
	$social_icons = medistore_social_links_icons();

	// Change SVG icon inside social links menu if there is supported URL.
	if ( 'social' === $args->theme_location ) {
		foreach ( $social_icons as $attr => $value ) {
			if ( false !== strpos( $item_output, $attr ) ) {
				$item_output = str_replace( $args->link_after, '</span>' . medistore_get_svg( array( 'icon' => esc_attr( $value ) ) ), $item_output );
			}
		}
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'medistore_nav_menu_social_icons', 10, 4 );

/**
 * Display SVG icons as per the link.
 *
 * @param  string   $social_link        Theme mod value rendered
 * @return string  SVG icon HTML
 */
function medistore_return_social_icon( $social_link ) {
	// Get supported social icons.
	$social_icons = medistore_social_links_icons();

	// Check in the URL for the url in the array.
	foreach ( $social_icons as $attr => $value ) {
		if ( false !== strpos( $social_link, $attr ) ) {
			return medistore_get_svg( array( 'icon' => esc_attr( $value ) ) );
		}
	}
}

/**
 * Fallback function call for menu
 * @param  Mixed $args Menu arguments
 * @return String $output Return or echo the add menu link.       
 */
function medistore_menu_fallback_cb( $args ){
    if ( ! current_user_can( 'edit_theme_options' ) ){
	    return;
   	}
    // see wp-includes/nav-menu-template.php for available arguments
    $link = $args['link_before']
        	. '<a href="' .esc_url( admin_url( 'nav-menus.php' ) ) . '">' . $args['before'] . esc_html__( 'Add a menu','medistore' ) . $args['after'] . '</a>'
        	. $args['link_after'];

   	if ( FALSE !== stripos( $args['items_wrap'], '<ul' ) || FALSE !== stripos( $args['items_wrap'], '<ol' )
	){
		$link = "<li>$link</li>";
	}
	$output = sprintf( $args['items_wrap'], $args['menu_id'], $args['menu_class'], $link );
	if ( ! empty ( $args['container'] ) ){
		$output = sprintf( '<%1$s class="%2$s" id="%3$s">%4$s</%1$s>', $args['container'], $args['container_class'], $args['container_id'], $output );
	}
	if ( $args['echo'] ){
		echo $output;
	}
	return $output;
}

/**
 * Function to detect SCRIPT_DEBUG on and off.
 * @return string If on, empty else return .min string.
 */
function medistore_min() {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}

/**
 * Checks to see if we're on the homepage or not.
 */
function medistore_is_frontpage() {
	return ( is_front_page() && ! is_home() );
}

/**
 * Checks to see if Static Front Page is set to "Your latest posts".
 */
function medistore_is_latest_posts() {
	return ( is_front_page() && is_home() );
}

/**
 * Checks to see if blog Page
 */
function medistore_is_blog_page() {
	return ( ! is_front_page() && is_home() );
}

if ( ! function_exists( 'medistore_simple_breadcrumb' ) ) :
	/**
	 * Simple breadcrumb.
	 *
	 * @param  array $args Arguments
	 */
	function medistore_simple_breadcrumb( $args = array() ) {
		/**
		 * Add breadcrumb.
		 *
		 */
		$options = medistore_get_theme_options();
		
		// Bail if Breadcrumb disabled.
		if ( ! $options['breadcrumb_enable'] ) {
			return;
		}

		$args = array(
			'show_on_front'   => false,
			'show_title'      => true,
			'show_browse'     => false,
		);
		breadcrumb_trail( $args );      

		return;
	}

endif;
add_action( 'medistore_simple_breadcrumb', 'medistore_simple_breadcrumb' , 10 );

/**
 * Display custom header title in frontpage and blog
 */
function medistore_custom_header_banner_title() {
	$options = medistore_get_theme_options();
	if ( medistore_is_latest_posts() ) : 
		$title = ! empty( $options['your_latest_posts_title'] ) ? $options['your_latest_posts_title'] : esc_html_e( 'Blog', 'medistore' ); ?>
		<h1 class="page-title"><?php echo esc_html( $title ); ?></h1>
	<?php elseif ( medistore_is_blog_page() || is_singular() ): ?>
		<h1 class="page-title"><?php single_post_title(); ?></h1>
	<?php elseif ( is_archive() ) : 
		the_archive_title( '<h1 class="page-title">', '</h1>' );
	elseif ( is_search() ) : ?>
		<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'medistore' ), get_search_query() ); ?></h1>
	<?php elseif ( is_404() ) :
		echo '<h1 class="page-title">' . esc_html__( 'Oops! That page can&#39;t be found.', 'medistore' ) . '</h1>';
	endif;
}


if ( ! function_exists( 'medistore_is_frontpage_content_enable' ) ) :
	/**
	 * Check home page ( static ) content status.
	 *
	 * @param bool $status Home page content status.
	 * @return bool Modified home page content status.
	 */
	function medistore_is_frontpage_content_enable( $status ) {
		if ( is_front_page() ) {
			$options = medistore_get_theme_options();
			$front_page_content_status = $options['enable_frontpage_content'];
			if ( false === $front_page_content_status ) {
				$status = false;
			}
		}
		return $status;
	}

endif;

add_filter( 'medistore_filter_frontpage_content_enable', 'medistore_is_frontpage_content_enable' );


function medistore_get_homepage_sections(){
	$options = medistore_get_theme_options();
	$home_section_list = '';
	foreach ( array( 'default', 'pro', 'second', 'third', 'fourth' ) as $layout ) {
		if ( $options['home_layout'] == $layout.'-design' ) {
			$home_section_list = $options[$layout.'_sortable'];
		}
	}
	return  $home_section_list;
}