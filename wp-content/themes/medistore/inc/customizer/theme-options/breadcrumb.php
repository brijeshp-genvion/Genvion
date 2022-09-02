<?php
/**
 * Breadcrumb options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

$wp_customize->add_section( 'medistore_breadcrumb',
	array(
		'title'             => esc_html__( 'Breadcrumb','medistore' ),
		'description'       => esc_html__( 'Breadcrumb section options.', 'medistore' ),
		'panel'             => 'medistore_theme_options_panel',
	)
);

// Breadcrumb enable setting and control.
$wp_customize->add_setting( 'medistore_theme_options[breadcrumb_enable]',
	array(
		'sanitize_callback' => 'medistore_sanitize_switch_control',
		'default'          	=> $options['breadcrumb_enable'],
	)
);

$wp_customize->add_control( new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[breadcrumb_enable]',
		array(
			'label'            	=> esc_html__( 'Enable Breadcrumb', 'medistore' ),
			'section'          	=> 'medistore_breadcrumb',
			'on_off_label' 		=> medistore_switch_options(),
		)
	)
);

// Breadcrumb separator setting and control.
$wp_customize->add_setting( 'medistore_theme_options[breadcrumb_separator]',
	array(
		'sanitize_callback'	=> 'sanitize_text_field',
		'default'          	=> $options['breadcrumb_separator'],
	)
);

$wp_customize->add_control( 'medistore_theme_options[breadcrumb_separator]',
	array(
		'label'            	=> esc_html__( 'Separator', 'medistore' ),
		'active_callback' 	=> 'medistore_is_breadcrumb_enable',
		'section'          	=> 'medistore_breadcrumb',
	)
);
