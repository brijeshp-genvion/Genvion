<?php
/**
 * Footer options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

// Footer Section
$wp_customize->add_section( 'medistore_section_footer',
	array(
		'title'      			=> esc_html__( 'Footer Options', 'medistore' ),
		'priority'   			=> 900,
		'panel'      			=> 'medistore_theme_options_panel',
	)
);

// footer text
$wp_customize->add_setting( 'medistore_theme_options[copyright_text]',
	array(
		'default'       		=> $options['copyright_text'],
		'sanitize_callback'		=> 'medistore_santize_allow_tag',
		'transport'				=> 'postMessage',
	)
);

$wp_customize->add_control( 'medistore_theme_options[copyright_text]',
    array(
		'label'      			=> esc_html__( 'Copyright Text', 'medistore' ),
		'section'    			=> 'medistore_section_footer',
		'type'		 			=> 'textarea',
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[copyright_text]',
		array(
			'selector'            => '.site-info .wrapper',
			'settings'            => 'medistore_theme_options[copyright_text]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'medistore_copyright_text_partial',
		)
	);
}

// scroll top visible
$wp_customize->add_setting( 'medistore_theme_options[scroll_top_visible]',
	array(
		'default'       	=> $options['scroll_top_visible'],
		'sanitize_callback' => 'medistore_sanitize_switch_control',
	)
);

$wp_customize->add_control( new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[scroll_top_visible]',
		array(
			'label'      		=> esc_html__( 'Display Scroll Top Button', 'medistore' ),
			'section'    		=> 'medistore_section_footer',
			'on_off_label' 		=> medistore_switch_options(),
		)
	)
);
