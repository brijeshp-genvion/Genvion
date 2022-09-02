<?php
/**
 * Layout options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'medistore_layout',
	array(
		'title'               => esc_html__('Layout','medistore'),
		'description'         => esc_html__( 'Layout section options.', 'medistore' ),
		'panel'               => 'medistore_theme_options_panel',
	)
);

// Site layout setting and control.
$wp_customize->add_setting( 'medistore_theme_options[site_layout]',
	array(
		'sanitize_callback'   => 'medistore_sanitize_select',
		'default'             => $options['site_layout'],
	)
);

$wp_customize->add_control(  new  medistore_Custom_Radio_Image_Control ( $wp_customize,
	'medistore_theme_options[site_layout]',
		array(
			'label'               => esc_html__( 'Site Layout', 'medistore' ),
			'section'             => 'medistore_layout',
			'choices'			  => medistore_site_layout(),
		)
	)
);

// Sidebar position setting and control.
$wp_customize->add_setting( 'medistore_theme_options[sidebar_position]',
	array(
		'sanitize_callback'   => 'medistore_sanitize_select',
		'default'             => $options['sidebar_position'],
	)
);

$wp_customize->add_control(  new  medistore_Custom_Radio_Image_Control ( $wp_customize,
	'medistore_theme_options[sidebar_position]',
		array(
			'label'               => esc_html__( 'Global Sidebar Position', 'medistore' ),
			'section'             => 'medistore_layout',
			'choices'			  => medistore_global_sidebar_position(),
		)
	)
);

// Post sidebar position setting and control.
$wp_customize->add_setting( 'medistore_theme_options[post_sidebar_position]',
	array(
		'sanitize_callback'   => 'medistore_sanitize_select',
		'default'             => $options['post_sidebar_position'],
	)
);

$wp_customize->add_control(  new  medistore_Custom_Radio_Image_Control ( $wp_customize,
	'medistore_theme_options[post_sidebar_position]',
		array(
			'label'               => esc_html__( 'Posts Sidebar Position', 'medistore' ),
			'section'             => 'medistore_layout',
			'choices'			  => medistore_sidebar_position(),
		)
	)
);

// Post sidebar position setting and control.
$wp_customize->add_setting( 'medistore_theme_options[page_sidebar_position]',
	array(
		'sanitize_callback'   => 'medistore_sanitize_select',
		'default'             => $options['page_sidebar_position'],
	)
);

$wp_customize->add_control( new  medistore_Custom_Radio_Image_Control( $wp_customize,
	'medistore_theme_options[page_sidebar_position]',
		array(
			'label'               => esc_html__( 'Pages Sidebar Position', 'medistore' ),
			'section'             => 'medistore_layout',
			'choices'			  => medistore_sidebar_position(),
		)
	)
);