<?php
/**
 * Team Section options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

// Add Team section
$wp_customize->add_section( 'medistore_team_section',
	array(
		'title'             => esc_html__( 'Team','medistore' ),
		'description'       => esc_html__( 'Team Section options.', 'medistore' ),
		'panel'             => 'medistore_front_page_panel',
	)
);

// Team content enable control and setting
$wp_customize->add_setting( 'medistore_theme_options[team_section_enable]',
	array(
		'default'			=> 	$options['team_section_enable'],
		'sanitize_callback' => 'medistore_sanitize_switch_control',
	)
);

$wp_customize->add_control( new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[team_section_enable]',
		array(
			'label'             => esc_html__( 'Team Section Enable', 'medistore' ),
			'section'           => 'medistore_team_section',
			'on_off_label' 		=> medistore_switch_options(),
		)
	)
);

// team title setting and control
$wp_customize->add_setting( 'medistore_theme_options[team_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> $options['team_title'],
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'medistore_theme_options[team_title]',
	array(
		'label'           	=> esc_html__( 'Section Title', 'medistore' ),
		'section'        	=> 'medistore_team_section',
		'active_callback' 	=> 'medistore_is_team_section_enable',
		'type'				=> 'text',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[team_title]',
		array(
			'selector'            => '#team .section-header h2',
			'settings'            => 'medistore_theme_options[team_title]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'medistore_team_title_partial',
		)
	);
}

// team description setting and control
$wp_customize->add_setting( 'medistore_theme_options[team_description]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> $options['team_description'],
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'medistore_theme_options[team_description]',
	array(
		'label'           	=> esc_html__( 'Section Description', 'medistore' ),
		'section'        	=> 'medistore_team_section',
		'active_callback' 	=> 'medistore_is_team_section_enable',
		'type'				=> 'textarea',
	)
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[team_description]',
		array(
			'selector'            => '#team .section-header p',
			'settings'            => 'medistore_theme_options[team_description]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'medistore_team_description_partial',
		)
	);
}


for ( $i = 1; $i <= 3; $i++ ) :
	// team pages drop down chooser control and setting
	$wp_customize->add_setting( 'medistore_theme_options[team_content_page_' . $i . ']',
		array(
			'sanitize_callback' => 'medistore_sanitize_page',
		)
	);

	$wp_customize->add_control( new  medistore_Dropdown_Chooser( $wp_customize,
		'medistore_theme_options[team_content_page_' . $i . ']',
			array(
				'label'             => sprintf( esc_html__( 'Select Page %d', 'medistore' ), $i ),
				'section'           => 'medistore_team_section',
				'choices'			=> medistore_page_choices(),
				'active_callback'	=> 'medistore_is_team_section_enable',
			)
		)
	);

	// team multiple input setting and control
	$wp_customize->add_setting( 'medistore_theme_options[team_social_'. $i .']', 
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control( new  medistore_Multi_Input_Custom_Control( $wp_customize,
		'medistore_theme_options[team_social_'. $i .']',
			array(
				'label'           => sprintf( esc_html__( 'Social Link %d', 'medistore' ), $i ),
				'button_text'	  => esc_html__( 'Add Social Link', 'medistore' ),
				'section'         => 'medistore_team_section',
				'active_callback' => 'medistore_is_team_section_enable',
				'type'			  => 'multi-input'
			)
		)
	);

	// team hr setting and control
	$wp_customize->add_setting( 'medistore_theme_options[team_hr_'. $i .']', 
		array(
			'sanitize_callback' => 'medistore_sanitize_html'
		)
	);

	$wp_customize->add_control( new  medistore_Customize_Horizontal_Line( $wp_customize,
		'medistore_theme_options[team_hr_'. $i .']',
			array(
				'section'         => 'medistore_team_section',
				'active_callback' => 'medistore_is_team_section_enable',
				'type'			  => 'hr'
			)
		)
	);
endfor;

