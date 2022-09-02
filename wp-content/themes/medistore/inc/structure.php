<?php
/**
 * Theme Palace basic theme structure hooks
 *
 * This file contains structural hooks.
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

$options = medistore_get_theme_options();  


if ( ! function_exists( 'medistore_doctype' ) ) :
	/**
	 * Doctype Declaration.
	 *
	 * @since  medistore 1.0.0
	 */
	function medistore_doctype() {
	?>
		<!DOCTYPE html>
			<html <?php language_attributes(); ?>>
	<?php
	}
endif;
add_action( 'medistore_doctype', 'medistore_doctype', 10 );


if ( ! function_exists( 'medistore_head' ) ) :
	/**
	 * Header Codes
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="profile" href="https://gmpg.org/xfn/11">
		<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
			<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">
		<?php endif;
	}
endif;
add_action( 'medistore_before_wp_head', 'medistore_head', 10 );

if ( ! function_exists( 'medistore_page_start' ) ) :
	/**
	 * Page starts html codes
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_page_start() {
		?>
		<div id="page" class="site">
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'medistore' ); ?></a>
		<?php
	}
endif;
add_action( 'medistore_page_start_action', 'medistore_page_start', 10 );

if ( ! function_exists( 'medistore_page_end' ) ) :
	/**
	 * Page end html codes
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_page_end() {
		?>
		</div><!-- #page -->
		<?php
	}
endif;
add_action( 'medistore_page_end_action', 'medistore_page_end', 10 );

if ( ! function_exists( 'medistore_site_branding' ) ) :
	/**
	 * Site branding codes
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_site_branding() {
		$options  = medistore_get_theme_options();
		$header_txt_logo_extra = $options['header_txt_logo_extra'];	
        $advertisement_image = (!empty($options['advertisement_image'])) ? $options['advertisement_image'] : '';
        $advertisement_url = (!empty($options['advertisement_url'])) ? $options['advertisement_url'] : '';
        $enable_advertisement = ($options['enable_advertisement'] && ($options['home_layout'] == 'third-design')) ? true : false; ?>

		<div class="menu-overlay"></div>

		<header id="masthead" class="site-header" role="banner">
			<?php if($enable_advertisement) echo '<div class="site-branding-wrappper">'; ?>
			<div class="wrapper">
				<div class="site-branding">
					<?php if ( in_array( $header_txt_logo_extra, array( 'show-all', 'logo-title', 'logo-tagline' ) ) && has_custom_logo()  ) : ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php endif; 

					if ( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title', 'show-all', 'tagline-only', 'logo-tagline' ) ) ) : ?>
						<div id="site-identity">
							<?php
							if( in_array( $header_txt_logo_extra, array( 'show-all', 'title-only', 'logo-title' ) )  ) {
								if ( medistore_is_latest_posts() ) : ?>
									<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
								<?php else : ?>
									<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
								<?php
								endif;
							} 
							if ( in_array( $header_txt_logo_extra, array( 'show-all', 'tagline-only', 'logo-tagline' ) ) ) {
								$description = get_bloginfo( 'description', 'display' );
								if ( $description || is_customize_preview() ) : ?>
									<p class="site-description"><?php echo esc_html( $description ); /* WPCS: xss ok. */ ?></p>
								<?php
								endif; 
							}?>
						</div>
					<?php endif; ?>
				</div><!-- .site-branding -->

				<?php if(!empty($advertisement_image) && !empty($advertisement_url) && $enable_advertisement): ?>
					<div class="site-advertisement">
						<a href="<?php echo esc_url( $advertisement_url ); ?>"><img src="<?php echo esc_url( $advertisement_image ); ?>" alt="<?php _e('Advertisement Image','medistore'); ?>"></a>
					</div><!-- .site-advertisement -->
				<?php endif; ?>

			<?php if($enable_advertisement) echo '</div></div>'; ?>
                
				<nav id="site-navigation" class="main-navigation" role="navigation" aria-label="Primary Menu">
					<?php if($enable_advertisement) echo '<div class="wrapper">'; ?>
					
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" title="Primary Menu">
					<?php
						echo medistore_get_svg( array( 'icon' => 'menu', 'class' => 'icon-menu' ) );
						echo medistore_get_svg( array( 'icon' => 'close', 'class' => 'icon-menu' ) );
					?>	
						<span class="menu-label"><?php esc_html_e('Menu', 'medistore')?></span>		
					</button>
					<?php  
							$search_html = sprintf(
											'<li class="search-menu"><a href="#" title="%1$s">%2$s%3$s</a><div id="search">%4$s</div>',
											esc_attr__('Search','medistore'),
											medistore_get_svg( array( 'icon' => 'search' ) ), 
											medistore_get_svg( array( 'icon' => 'close' ) ), 
											get_search_form( $echo = false )
										);

						if( class_exists('WooCommerce')){

							$cart_button = sprintf(
								'<li class="cart"><a href="%1$s" class="custom-button">%2$s%3$s</a></li>',
								wc_get_cart_url(),
								medistore_get_svg( array( 'icon' => 'cart' ) ),
								esc_attr__('Cart','medistore')
							);
						}else{
							$cart_button = '';
						}

						wp_nav_menu( array(
							'theme_location' => 'primary',
							'container' => 'div',
							'menu_class' => 'menu nav-menu',
							'menu_id' => 'primary-menu',
							'echo' => true,
							'fallback_cb' => 'medistore_menu_fallback_cb',
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s'.$search_html.$cart_button.'</ul>',
						) );
						
						
					?>
					<?php if($enable_advertisement) echo '</div>'; ?>
				</nav><!-- #site-navigation -->
				<?php if(!$enable_advertisement) echo '</div>'; ?>
		</header><!-- .header-->
<?php 
	}
endif;
add_action( 'medistore_header_action', 'medistore_site_branding', 10 );

if ( ! function_exists( 'medistore_content_start' ) ) :
	/**
	 * Site content codes
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_content_start() {
		?>
		<div id="content" class="site-content">
		<?php
	}
endif;
add_action( 'medistore_content_start_action', 'medistore_content_start', 10 );

if ( ! function_exists( 'medistore_header_image' ) ) :
    /**
     * Header Image codes
     *
     * @since  medistore 1.0.0
     *
     */
    function medistore_header_image() {
        if ( medistore_is_frontpage() )
            return;
        $header_image = get_header_image();
        if ( is_singular() ) :
            $header_image = has_post_thumbnail() ? get_the_post_thumbnail_url( get_the_id(), 'full' ) : $header_image;
        endif;
        ?>

        <div id="page-site-header" class="relative" style="background-image: url('<?php echo esc_url( $header_image ); ?>');">
            <div class="overlay"></div>
            <div class="wrapper">
                <header class="page-header">
                    <?php medistore_custom_header_banner_title(); ?>
                </header>
                <?php medistore_add_breadcrumb(); ?>
            </div>
        </div><!-- #page-site-header -->

        <?php
    }
endif;
add_action( 'medistore_header_image_action', 'medistore_header_image', 10 );

if ( ! function_exists( 'medistore_add_breadcrumb' ) ) :
	/**
	 * Add breadcrumb.
	 *
	 * @since  medistore 1.0.0
	 */
	function medistore_add_breadcrumb() {
		$options = medistore_get_theme_options();

		// Bail if Breadcrumb disabled.
		$breadcrumb = $options['breadcrumb_enable'];
		if ( false === $breadcrumb ) {
			return;
		}
		
		// Bail if Home Page.
		if ( medistore_is_frontpage() ) {
			return;
		}

		echo '<div id="breadcrumb-list" >';
				/**
				 * medistore_simple_breadcrumb hook
				 *
				 * @hooked medistore_simple_breadcrumb -  10
				 *
				 */
				do_action( 'medistore_simple_breadcrumb' );
		echo '</div><!-- #breadcrumb-list -->';
	}
endif;

if ( ! function_exists( 'medistore_content_end' ) ) :
	/**
	 * Site content codes
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_content_end() {
		?>
        </div><!-- #content -->
		<?php
	}
endif;
add_action( 'medistore_content_end_action', 'medistore_content_end', 10 );

if ( ! function_exists( 'medistore_footer_start' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_footer_start() {
		?>
		<footer id="colophon" class="site-footer" role="contentinfo">
		<?php
	}
endif;
add_action( 'medistore_footer', 'medistore_footer_start', 10 );

if ( ! function_exists( 'medistore_footer_site_info' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_footer_site_info() {
		$options = medistore_get_theme_options();
		$search = array( '[the-year]', '[site-link]' );

        $replace = array( date( 'Y' ), '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_attr( get_bloginfo( 'name', 'display' ) ) . '</a>' );

        $options['copyright_text'] = str_replace( $search, $replace, $options['copyright_text'] );
        $theme_data = wp_get_theme();
		$copyright_text = $options['copyright_text'];
		?>
		<div class="site-info">
                <div class="wrapper">
                    <span>
                    <?php 
	                	echo medistore_santize_allow_tag( $copyright_text ); 
	                	if ( function_exists( 'the_privacy_policy_link' ) ) {
							the_privacy_policy_link( ' | ' );
						}
                	?>
                	<?php echo esc_html__( ' All Rights Reserved | ', 'medistore' ) . esc_html( $theme_data->get( 'Name') ) . '&nbsp;' . esc_html__( 'by', 'medistore' ). '&nbsp;<a target="_blank" href="'. esc_url( $theme_data->get( 'AuthorURI' ) ) .'">'. esc_html( ucwords( $theme_data->get( 'Author' ) ) ) .'</a>' ?>
                	</span>
                </div><!-- .wrapper -->    
            </div><!-- .site-info -->

		<?php
	}
endif;
add_action( 'medistore_footer', 'medistore_footer_site_info', 40 );

if ( ! function_exists( 'medistore_footer_scroll_to_top' ) ) :
	/**
	 * Footer starts
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_footer_scroll_to_top() {
		$options  = medistore_get_theme_options();
		if ( true === $options['scroll_top_visible'] ) : ?>
			<div class="backtotop"><?php echo medistore_get_svg( array( 'icon' => 'up' ) ); ?></div>
		<?php endif;
	}
endif;
add_action( 'medistore_footer', 'medistore_footer_scroll_to_top', 40 );


if ( ! function_exists( 'medistore_loader' ) ) :
	/**
	 * Start div id #loader
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_loader() {
		$options = medistore_get_theme_options();
		if ( $options['loader_enable'] ) { ?>

			<div id="loader">
	            <div class="loader-container">
	            	<?php if ( 'default' == $options['loader_icon'] ) : ?>
		                <div id="preloader">
		                    <span></span>
		                    <span></span>
		                    <span></span>
		                    <span></span>
		                    <span></span>
		                </div>
		            <?php else :
		            	echo medistore_get_svg( array( 'icon' => esc_attr( $options['loader_icon'] ) ) );
		            endif; ?>
	            </div>
	        </div><!-- #loader -->
		<?php }
	}
endif;
add_action( 'medistore_before_header', 'medistore_loader', 10 );


if ( ! function_exists( 'medistore_infinite_loader_spinner' ) ) :
	/**
	 *
	 * @since  medistore 1.0.0
	 *
	 */
	function medistore_infinite_loader_spinner() { 
		global $post;
		$options = medistore_get_theme_options();
		if ( $options['pagination_type'] == 'infinite' ) :			
			echo '<div class="blog-loader">' . medistore_get_svg( array( 'icon' => 'spinner-umbrella' ) ) . '</div>';			
		endif;
	}
endif;
add_action( 'medistore_infinite_loader_spinner_action', 'medistore_infinite_loader_spinner', 10 );
