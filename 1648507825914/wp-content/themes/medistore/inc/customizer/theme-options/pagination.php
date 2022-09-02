<?php
/**
 * pagination options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

// Add sidebar section
$wp_customize->add_section( 'medistore_pagination',
	array(
		'title'               	=> esc_html__('Pagination','medistore'),
		'description'         	=> esc_html__( 'Pagination section options.', 'medistore' ),
		'panel'               	=> 'medistore_theme_options_panel',
	)
);

// Sidebar position setting and control.
$wp_customize->add_setting( 'medistore_theme_options[pagination_enable]',
	array(
		'sanitize_callback' 	=> 'medistore_sanitize_switch_control',
		'default'             	=> $options['pagination_enable'],
	)
);

$wp_customize->add_control( new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[pagination_enable]',
		array(
			'label'               	=> esc_html__( 'Pagination Enable', 'medistore' ),
			'section'             	=> 'medistore_pagination',
			'on_off_label' 			=> medistore_switch_options(),
		)
	)
);

// Site layout setting and control.
$wp_customize->add_setting( 'medistore_theme_options[pagination_type]',
	array(
		'sanitize_callback'   	=> 'medistore_sanitize_select',
		'default'             	=> $options['pagination_type'],
	)
);

$wp_customize->add_control( 'medistore_theme_options[pagination_type]',
	array(
		'label'               	=> esc_html__( 'Pagination Type', 'medistore' ),
		'section'             	=> 'medistore_pagination',
		'type'                	=> 'select',
		'choices'			  	=> medistore_pagination_options(),
		'active_callback'	  	=> 'medistore_is_pagination_enable',
	)
);
