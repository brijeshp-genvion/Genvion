/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
 ( function( $ ) {

	
	const medistore_section_lists = [
		{section : 'slider_section', id: 'featured-slider'},
		{section : 'about_section', id: 'about'},
		{section : 'blog_section', id: 'articles-section'},
		{section : 'gallery_section', id: 'our-gallery'},
		{section : 'magazine_popular_post_section', id: 'counter-section'},
		{section : 'magazine_sport_news_section', id: 'magazine-sports-section'},
		{section : 'magazine_featured_post_section', id: 'magazine-featured-posts'},
		{section : 'magazine_latest_post_section', id: 'magazine-latest-posts'},
		{section : 'most_viewed_section', id: 'magazine-most-viewed-posts'},
		{section : 'popular_post_section', id: 'blog-popular-posts'},
		{section : 'featured_post_section', id: 'blog-featured-posts'},
		{section : 'popular_product_section', id: 'product'},
		{section : 'recent_post_section', id: 'products-collection'},
		{section : 'recent_product_section', id: 'promotion-section'},
		{section : 'featured_products_section', id: 'featured-products'},
		{section : 'service_section', id: 'our-services'},
		{section : 'two_column_section', id: 'magazine-two-column-posts'},
		{section : 'three_column_section', id: 'magazine-three-column-posts'},
		{section : 'subscription_section', id: 'subscribe-now'},
		{section : 'team_section', id: 'team'},
		{section : 'testimonial_section', id: 'testimonials'},
		{section : 'latest_post_section', id: 'blog-latest-posts'},
	];
    medistore_section_lists.forEach( medistore_homepage_scroll_preview );

    function medistore_homepage_scroll_preview(item, index) {
    	// Collect information from customize-controls.js about which panels are opening.
		wp.customize.bind( 'preview-ready', function() {
			
			// Initially hide the theme option placeholders on load.
			$( '.panel-placeholder' ).hide();
			console.log('working');
			wp.customize.preview.bind( item.section, function( data ) {
				// Only on the front page.
				if ( ! $( 'body' ).hasClass( 'home' ) ) {
					return;
				}

				// When the section is expanded, show and scroll to the content placeholders, exposing the edit links.
				if ( true === data.expanded ) {
					$('html, body').animate({
				        'scrollTop' : $('#'+item.id).position().top
				    });
				} 
			});

		});
 	}


	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
			}
		} );
	} );

	// Header title color.
	wp.customize( 'medistore_theme_options[header_title_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Header tagline color.
	wp.customize( 'medistore_theme_options[header_tagline_color]', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Color scheme.
	wp.customize( 'medistore_theme_options[colorscheme]', function( value ) {
		value.bind( function( to ) {

			// Update color body class.
			$( 'body' )
				.removeClass( 'colors-light colors-dark colors-custom' )
				.addClass( 'colors-' + to );
		});
	});

	// Custom color hue.
	wp.customize( 'medistore_theme_options[colorscheme_hue]', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS
			var style = $( '#custom-theme-colors' ),
			    color = style.data( 'color' ),
			    css = style.html();
			css = css.split( color ).join( to );
			style.html( css )
			     .data( 'color', to );
		} );
	} );
} )( jQuery );
