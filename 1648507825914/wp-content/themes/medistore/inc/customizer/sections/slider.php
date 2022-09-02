<?php
/**
 * Slider Section options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

// Add Slider section
$wp_customize->add_section( 'medistore_slider_section',
	array(
		'title'             => esc_html__( 'Slider','medistore' ),
		'description'       => esc_html__( 'Slider Section options.', 'medistore' ),
		'panel'             => 'medistore_front_page_panel',
	)
);

// Slider content enable control and setting
$wp_customize->add_setting( 'medistore_theme_options[slider_section_enable]', 
	array(
		'default'			=> 	$options['slider_section_enable'],
		'sanitize_callback' => 'medistore_sanitize_switch_control',
	) 
);

$wp_customize->add_control( new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[slider_section_enable]',
		array(
			'label'             => esc_html__( 'Slider Section Enable', 'medistore' ),
			'section'           => 'medistore_slider_section',
			'on_off_label' 		=> medistore_switch_options(),
		)
	)
);

// Slider autoplay enable control and setting
$wp_customize->add_setting( 'medistore_theme_options[slider_autoplay_enable]',
	array(
		'default'			=> 	$options['slider_autoplay_enable'],
		'sanitize_callback' => 'medistore_sanitize_switch_control',
	)
);

$wp_customize->add_control( new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[slider_autoplay_enable]',
		array(
			'label'             => esc_html__( 'Slider Autoplay Enable', 'medistore' ),
			'section'           => 'medistore_slider_section',
			'active_callback'   => 'medistore_is_slider_section_enable',
			'on_off_label' 		=> medistore_switch_options(),
		)
	)
);


// Slider Excerpt length setting and control.
$wp_customize->add_setting( 'medistore_theme_options[slider_excerpt_length]',
	array(
		'sanitize_callback' => 'medistore_sanitize_number_range',
		'default'			=> $options['slider_excerpt_length'],
	)
);

$wp_customize->add_control( 'medistore_theme_options[slider_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Excerpt Length', 'medistore' ),
		'description' 		=> esc_html__( 'Total words to be displayed in Slider section', 'medistore' ),
		'section'     		=> 'medistore_slider_section',
		'type'        		=> 'number',
		'active_callback' 	=> 'medistore_is_slider_section_enable',
	)
);


for ( $i = 1; $i <= 3; $i++ ) :

	// slider pages drop down chooser control and setting
	$wp_customize->add_setting( 'medistore_theme_options[slider_content_page_'. $i .']', 
		array(
			'sanitize_callback' => 'medistore_sanitize_page',
		)
	);

	$wp_customize->add_control( new  medistore_Dropdown_Chooser( $wp_customize,
		'medistore_theme_options[slider_content_page_'. $i .']', 
			array(
				'label'             => sprintf(esc_html__( 'Select Page: %d', 'medistore'), $i ),
				'section'           => 'medistore_slider_section',
				'choices'			=> medistore_page_choices(),
				'active_callback'	=> 'medistore_is_slider_section_enable',
			)
		)
	);

endfor;

//slider_btn_txt
$wp_customize->add_setting('medistore_theme_options[slider_btn_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['slider_btn_txt'],
    )
);

$wp_customize->add_control('medistore_theme_options[slider_btn_txt]',
    array(
        'section'			=> 'medistore_slider_section',
        'label'				=> esc_html__( 'Button Text:', 'medistore' ),
        'type'          	=>'text',
        'active_callback' 	=> 'medistore_is_slider_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[slider_btn_txt]',
		array(
			'selector'            => '#featured-slider article div.read-more a:nth-child(1)',
			'settings'            => 'medistore_theme_options[slider_btn_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'medistore_slider_btn_txt_partial',
		) 
	);
}

//slider_btn_alt_txt
$wp_customize->add_setting('medistore_theme_options[slider_btn_alt_txt]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'transport'			=> 'postMessage',
        'default'           => $options['slider_btn_alt_txt'],
    )
);

$wp_customize->add_control('medistore_theme_options[slider_btn_alt_txt]',
    array(
        'section'			=> 'medistore_slider_section',
        'label'				=> esc_html__( 'Button Text:', 'medistore' ),
        'type'          	=>'text',
        'active_callback' 	=> 'medistore_is_slider_section_enable'
    )
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[slider_btn_alt_txt]',
		array(
			'selector'            => '#featured-slider div.read-more a:nth-child(2)',
			'settings'            => 'medistore_theme_options[slider_btn_alt_txt]',
			'fallback_refresh'    => true,
			'container_inclusive' => false,
			'render_callback'     => 'medistore_slider_btn_alt_txt_partial',
		) 
	);
}

$wp_customize->add_setting( 'medistore_theme_options[slider_btn_alt_url]',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control( 'medistore_theme_options[slider_btn_alt_url]',
    array(
        'label'           	=> esc_html__( 'Button Alt URL', 'medistore' ),
        'section'        	=> 'medistore_slider_section',
        'active_callback' 	=> 'medistore_is_slider_section_enable',
        'type'				=> 'url',
    ) 
);
