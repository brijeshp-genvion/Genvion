<?php
/**
 * About Section options
 *
 * @package Theme Palace
 * @subpackage medistore
 * @since medistore 1.0.0
 */

// Add About section
$wp_customize->add_section( 'medistore_about_section',
	array(
		'title'             => esc_html__( 'About us','medistore' ),
		'description'       => esc_html__( 'About us  Section options.', 'medistore' ),
        'panel'             => 'medistore_front_page_panel',
	)
);

// About content enable control and setting
$wp_customize->add_setting( 'medistore_theme_options[about_section_enable]',
	array(
		'default'			=> 	$options['about_section_enable'],
		'sanitize_callback' => 'medistore_sanitize_switch_control',
	)
);

$wp_customize->add_control( new Medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[about_section_enable]',
		array(
			'label'             => esc_html__( 'About Section Enable', 'medistore' ),
			'section'           => 'medistore_about_section',
			'on_off_label' 		=> medistore_switch_options(),
		)
	)
);


// About Excerpt length setting and control.
$wp_customize->add_setting( 'medistore_theme_options[about_excerpt_length]',
	array(
		'sanitize_callback' => 'medistore_sanitize_number_range',
		'default'			=> $options['about_excerpt_length'],
	)
);

$wp_customize->add_control( 'medistore_theme_options[about_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Excerpt Length', 'medistore' ),
		'description' 		=> esc_html__( 'Total words to be displayed in About section', 'medistore' ),
		'section'     		=> 'medistore_about_section',
		'type'        		=> 'number',
		'active_callback' 	=> 'medistore_is_about_section_enable',
	)
);


	// about pages drop down chooser control and setting
	$wp_customize->add_setting( 'medistore_theme_options[about_content_page]',
		array(
			'sanitize_callback' => 'medistore_sanitize_page',
		)
	);

	$wp_customize->add_control( new Medistore_Dropdown_Chooser( $wp_customize,
		'medistore_theme_options[about_content_page]',
			array(
				'label'             => esc_html__( 'Select Page', 'medistore' ),
				'section'           => 'medistore_about_section',
				'choices'			=> medistore_page_choices(),
				'active_callback'	=> 'medistore_is_about_section_enable',
			)
		)
	);
//about_btn_txt
$wp_customize->add_setting('medistore_theme_options[about_btn_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['about_btn_txt'],
    )
);

$wp_customize->add_control('medistore_theme_options[about_btn_txt]',
    array(
        'section'			=> 'medistore_about_section',
        'label'				=> esc_html__( 'Button Text:', 'medistore' ),
        'type'          	=>'text',
        'active_callback' 	=> 'medistore_is_about_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[about_btn_txt]',
		array(
			'selector'            => '#about div.read-more a:nth-child(1)',
			'settings'            => 'medistore_theme_options[about_btn_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'medistore_about_btn_txt_partial',
		)
	);
}
//about_btn_alt_txt
$wp_customize->add_setting('medistore_theme_options[about_btn_alt_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['about_btn_alt_txt'],
    )
);

$wp_customize->add_control('medistore_theme_options[about_btn_alt_txt]',
    array(
        'section'			=> 'medistore_about_section',
        'label'				=> esc_html__( 'Alt Button Text:', 'medistore' ),
        'type'          	=>'text',
        'active_callback' 	=> 'medistore_is_about_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[about_btn_alt_txt]',
		array(
			'selector'            => '#about div.read-more a:nth-child(2)',
			'settings'            => 'medistore_theme_options[about_btn_alt_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'medistore_about_btn_alt_txt_partial',
		) 
	);
}

$wp_customize->add_setting( 'medistore_theme_options[about_btn_alt_url]',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control( 'medistore_theme_options[about_btn_alt_url]',
    array(
        'label'           	=> esc_html__( 'Alt Button URL', 'medistore' ),
        'section'        	=> 'medistore_about_section',
        'active_callback' 	=> 'medistore_is_about_section_enable',
        'type'				=> 'url',
    ) 
);

