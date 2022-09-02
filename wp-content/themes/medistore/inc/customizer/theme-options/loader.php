<?php
/**
 * Loader options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

$wp_customize->add_section( 'medistore_loader',
	array(
		'title'            	=> esc_html__( 'Loader','medistore' ),
		'description'      	=> esc_html__( 'Loader section options.', 'medistore' ),
		'panel'            	=> 'medistore_theme_options_panel',
	)
);

// Loader enable setting and control.
$wp_customize->add_setting( 'medistore_theme_options[loader_enable]',
	array(
		'sanitize_callback' => 'medistore_sanitize_switch_control',
		'default'           => $options['loader_enable'],
	)
);

$wp_customize->add_control(  new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[loader_enable]',
		array(
			'label'            	=> esc_html__( 'Enable loader', 'medistore' ),
			'section'          	=> 'medistore_loader',
			'on_off_label' 		=> medistore_switch_options(),
		)
	)
);

// Loader icons setting and control.
$wp_customize->add_setting( 'medistore_theme_options[loader_icon]',
	array(
		'sanitize_callback' => 'medistore_sanitize_select',
		'default'			=> $options['loader_icon'],
	)
);

$wp_customize->add_control( 'medistore_theme_options[loader_icon]',
	array(
		'label'           	=> esc_html__( 'Icon', 'medistore' ),
		'section'         	=> 'medistore_loader',
		'type'				=> 'select',
		'choices'			=> medistore_get_spinner_list(),
		'active_callback' 	=> 'medistore_is_loader_enable',
	)
);
