<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'medistore_single_post_section',
	array(
		'title'             => esc_html__( 'Single Post','medistore' ),
		'description'       => esc_html__( 'Options to change the single posts globally.', 'medistore' ),
		'panel'             => 'medistore_theme_options_panel',
	)
);

// Archive date meta setting and control.
$wp_customize->add_setting( 'medistore_theme_options[single_post_hide_date]',
	array(
		'default'           => $options['single_post_hide_date'],
		'sanitize_callback' => 'medistore_sanitize_switch_control',
	)
);

$wp_customize->add_control( new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[single_post_hide_date]',
		array(
			'label'             => esc_html__( 'Hide Date', 'medistore' ),
			'section'           => 'medistore_single_post_section',
			'on_off_label' 		=> medistore_hide_options(),
		)
	)
);

// Archive author category setting and control.
$wp_customize->add_setting( 'medistore_theme_options[single_post_hide_category]',
	array(
		'default'           => $options['single_post_hide_category'],
		'sanitize_callback' => 'medistore_sanitize_switch_control',
	)
);

$wp_customize->add_control( new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[single_post_hide_category]',
		array(
			'label'             => esc_html__( 'Hide Category', 'medistore' ),
			'section'           => 'medistore_single_post_section',
			'on_off_label' 		=> medistore_hide_options(),
		)
	)
);