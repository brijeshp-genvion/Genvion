<?php
/**
* Homepage (Static ) options
*
* @package Theme Palace
* @subpackage medistore
* @since medistore 1.0.0
*/

// Homepage (Static ) setting and control.
$wp_customize->add_setting( 'medistore_theme_options[enable_frontpage_content]',
	array(
		'sanitize_callback'   => 'medistore_sanitize_checkbox',
		'default'             => $options['enable_frontpage_content'],
	)
);

$wp_customize->add_control( 'medistore_theme_options[enable_frontpage_content]',
	array(
		'label'       	=> esc_html__( 'Enable Content', 'medistore' ),
		'description' 	=> esc_html__( 'Check to enable content on static front page only.', 'medistore' ),
		'section'     	=> 'static_front_page',
		'type'        	=> 'checkbox',
		'active_callback' => 'medistore_is_static_homepage_enable',
	)
);