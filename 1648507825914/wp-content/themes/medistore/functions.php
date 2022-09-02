<?php
/**
 * Theme Palace functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

if ( ! function_exists( 'medistore_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function medistore_setup() {
        $options = medistore_get_theme_options();
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Theme Palace, use a find and replace
		 * to change 'medistore' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'medistore' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		add_theme_support( 'register_block_pattern' ); 

		add_theme_support( 'register_block_style' ); 

		add_theme_support( 'responsive-embeds' );

		// add woocommerce support
		add_theme_support( 'woocommerce' );
		if ( class_exists( 'WooCommerce' ) ) {
			global $woocommerce;

			if( version_compare( $woocommerce->version, '3.0.0', ">=" ) ) {
				add_theme_support( 'wc-product-gallery-zoom' );
				add_theme_support( 'wc-product-gallery-lightbox' );
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}

		// Enable support for footer widgets.
		add_theme_support( 'footer-widgets', 4 );

		add_theme_support( "responsive-embeds" );

		// Load Footer Widget Support.
		require_if_theme_supports( 'footer-widgets', get_template_directory() . '/inc/footer-widgets.php' );
		
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		set_post_thumbnail_size( 600, 450, true );

		// Set the default content width.
		$GLOBALS['content_width'] = 525;
		
		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'primary' 	=> esc_html__( 'Primary', 'medistore' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'medistore_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// This setup supports logo, site-title & site-description
		add_theme_support( 'custom-logo', array(
			'height'      => 70,
			'width'       => 120,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );


		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		add_editor_style( array( '/assets/css/editor-style' . medistore_min() . '.css', medistore_fonts_url() ) );

		// Gutenberg support
		add_theme_support( 'editor-color-palette', array(
	       	array(
				'name' => esc_html__( 'Blue', 'medistore' ),
				'slug' => 'blue',
				'color' => '#2c7dfa',
	       	),
	       	array(
	           	'name' => esc_html__( 'Green', 'medistore' ),
	           	'slug' => 'green',
	           	'color' => '#07d79c',
	       	),
	       	array(
	           	'name' => esc_html__( 'Orange', 'medistore' ),
	           	'slug' => 'orange',
	           	'color' => '#ff8737',
	       	),
	       	array(
	           	'name' => esc_html__( 'Black', 'medistore' ),
	           	'slug' => 'black',
	           	'color' => '#2f3633',
	       	),
	       	array(
	           	'name' => esc_html__( 'Grey', 'medistore' ),
	           	'slug' => 'grey',
	           	'color' => '#82868b',
	       	),
	   	));

		add_theme_support( 'align-wide' );
		add_theme_support( 'editor-font-sizes', array(
		   	array(
		       	'name' => esc_html__( 'small', 'medistore' ),
		       	'shortName' => esc_html__( 'S', 'medistore' ),
		       	'size' => 12,
		       	'slug' => 'small'
		   	),
		   	array(
		       	'name' => esc_html__( 'regular', 'medistore' ),
		       	'shortName' => esc_html__( 'M', 'medistore' ),
		       	'size' => 16,
		       	'slug' => 'regular'
		   	),
		   	array(
		       	'name' => esc_html__( 'larger', 'medistore' ),
		       	'shortName' => esc_html__( 'L', 'medistore' ),
		       	'size' => 36,
		       	'slug' => 'larger'
		   	),
		   	array(
		       	'name' => esc_html__( 'huge', 'medistore' ),
		       	'shortName' => esc_html__( 'XL', 'medistore' ),
		       	'size' => 48,
		       	'slug' => 'huge'
		   	)
		));
		add_theme_support('editor-styles');
		add_theme_support( 'wp-block-styles' );
	}
endif;
add_action( 'after_setup_theme', 'medistore_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function medistore_content_width() {

	$content_width = $GLOBALS['content_width'];


	$sidebar_position = medistore_layout();
	switch ( $sidebar_position ) {

	  case 'no-sidebar':
	    $content_width = 1170;
	    break;

	  case 'left-sidebar':
	  case 'right-sidebar':
	    $content_width = 819;
	    break;

	  default:
	    break;
	}

	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$content_width = 1170;
	}

	/**
	 * Filter  medistore content width of the theme.
	 *
	 * @since  medistore 1.0.0
	 *
	 * @param int $content_width Content width in pixels.
	 */
	$GLOBALS['content_width'] = apply_filters( 'medistore_content_width', $content_width );
}
add_action( 'template_redirect', 'medistore_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function medistore_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'medistore' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'medistore' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Popular Post Section Sidebar', 'medistore' ),
		'id'            => 'popular-post-section-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'medistore' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );


	register_sidebars( 4, array(
		'name'          => esc_html__( 'Optional Sidebar %d', 'medistore' ),
		'id'            => 'optional-sidebar',
		'description'   => esc_html__( 'Add widgets here.', 'medistore' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'medistore_widgets_init' );


if ( ! function_exists( 'medistore_fonts_url' ) ) :
/**
 * Register Google fonts
 *
 * @return string Google fonts URL for the theme.
 */
function medistore_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';


	/* translators: If there are characters in your language that are not supported by Khand, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'lora font: on or off', 'medistore' ) ) {
		$fonts[] = 'Lora:400,500,600,700&display=swap';
	}
    if ( 'off' !== _x( 'on', 'roboto font: on or off', 'medistore' ) ) {
        $fonts[] = 'Roboto:400,500,600,700&display=swap';
    }

    if ( 'off' !== _x( 'on', 'merriweather font: on or off', 'medistore' ) ) {
        $fonts[] = 'Merriweather:400,700&display=swap';
    }

	$query_args = array(
		'family' => urlencode( implode( '|', $fonts ) ),
		'subset' => urlencode( $subsets ),
	);

	if ( $fonts ) {
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
	}

	return esc_url_raw( $fonts_url );
}
endif;

/**
 * Add preconnect for Google Fonts.
 *
 * @since  medistore 1.0.0
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function medistore_resource_hints( $urls, $relation_type ) {
	if ( wp_style_is( 'medistore-fonts', 'queue' ) && 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => esc_url('https://fonts.gstatic.com'),			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'medistore_resource_hints', 10, 2 );

/**
 * Enqueue scripts and styles.
 */
function medistore_scripts() {
	$options = medistore_get_theme_options();
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'medistore-fonts', medistore_fonts_url(), array(), null );

	// slick
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/css/slick'. '.css' );

	// slick theme
	wp_enqueue_style( 'slick-theme', get_template_directory_uri() . '/assets/css/slick-theme'. '.css' );
	
	// font awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome'. medistore_min() . '.css' );


	// blocks
	wp_enqueue_style( 'medistore-blocks', get_template_directory_uri() . '/assets/css/blocks' . medistore_min() . '.css' );

	wp_enqueue_style( 'medistore-style', get_stylesheet_uri() );

	// Load the html5 shiv.
	wp_enqueue_script( 'medistore-html5', get_template_directory_uri() . '/assets/js/html5' . medistore_min() . '.js', array(), '3.7.3' );

	wp_script_add_data( 'medistore-html5', 'conditional', 'lt IE 9' );

	wp_enqueue_script( 'medistore-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix' . medistore_min() . '.js', array(), '20160412', true );
	

	wp_enqueue_script( 'medistore-navigation', get_template_directory_uri() . '/assets/js/navigation' . medistore_min() . '.js', array(), '20151215', true );
	
	$medistore_l10n = array(
		'quote'          => medistore_get_svg( array( 'icon' => 'quote-right' ) ),
		'expand'         => esc_html__( 'Expand child menu', 'medistore' ),
		'collapse'       => esc_html__( 'Collapse child menu', 'medistore' ),
		'icon'           => medistore_get_svg( array( 'icon' => 'down', 'fallback' => true ) ),
	);
	
	wp_localize_script( 'medistore-navigation', 'medistore_l10n', $medistore_l10n );

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/js/slick'. medistore_min() . '.js','', '1.6.0', true );

	wp_enqueue_script( 'medistore-custom', get_template_directory_uri() . '/assets/js/custom'. medistore_min() .'.js', array( 'jquery' ), '20151215', true );

}
add_action( 'wp_enqueue_scripts', 'medistore_scripts');

/**
 * Enqueue editor styles for Gutenberg
 *
 * @since  medistore 1.0.0
 */
function medistore_block_editor_styles() {
	// Block styles.
	wp_enqueue_style( 'medistore-block-editor-style', get_theme_file_uri( '/assets/css/editor-blocks' . medistore_min() . '.css' ) );
	// Add custom fonts.
	wp_enqueue_style( 'medistore-fonts', medistore_fonts_url(), array(), null );
}
add_action( 'enqueue_block_editor_assets', 'medistore_block_editor_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load core file
 */
require get_template_directory() . '/inc/core.php';
