<?php
/**
 * Typography options
 *
 * @package Theme Palace
 * @subpackage medistore
 * @since medistore 1.0.0
 */

// Typography Section
$wp_customize->add_section( 'medistore_section_typography',
	array(
		'title'      		=> esc_html__( 'Typography', 'medistore' ),
		'priority'   		=> 600,
		'panel'      		=> 'medistore_theme_options_panel',
	)
);

$wp_customize->add_setting( 'medistore_theme_options[theme_site_title_typography]',
	array(
		'sanitize_callback'	=> 'medistore_sanitize_select',
	)
);
$wp_customize->add_control( 'medistore_theme_options[theme_site_title_typography]',
    array(
		'label'       		=> esc_html__( 'Choose Site Title Typography', 'medistore' ),
		'section'     		=> 'medistore_section_typography',
		'settings'    		=> 'medistore_theme_options[theme_site_title_typography]',
		'type'		  		=> 'select',
		'choices'			=> medistore_typography_options(),
    )
);

$wp_customize->add_setting( 'medistore_theme_options[theme_site_description_typography]',
	array(
		'sanitize_callback'	=> 'medistore_sanitize_select',
	)
);
$wp_customize->add_control( 'medistore_theme_options[theme_site_description_typography]',
    array(
		'label'       		=> esc_html__( 'Choose Site Description Typography', 'medistore' ),
		'section'     		=> 'medistore_section_typography',
		'settings'    		=> 'medistore_theme_options[theme_site_description_typography]',
		'type'		  		=> 'select',
		'choices'			=> medistore_typography_options(),
    )
);

$wp_customize->add_setting( 'medistore_theme_options[theme_menu_typography]',
	array(
		'sanitize_callback'	=> 'medistore_sanitize_select',
	)
);
$wp_customize->add_control( 'medistore_theme_options[theme_menu_typography]',
    array(
		'label'       		=> esc_html__( 'Choose Menu Typography', 'medistore' ),
		'section'     		=> 'medistore_section_typography',
		'settings'    		=> 'medistore_theme_options[theme_menu_typography]',
		'type'		  		=> 'select',
		'choices'			=> medistore_typography_options(),
    )
);

$wp_customize->add_setting( 'medistore_theme_options[theme_head_typography]',
	array(
		'sanitize_callback'	=> 'medistore_sanitize_select',
	)
);

$wp_customize->add_control( 'medistore_theme_options[theme_head_typography]',
    array(
		'label'       		=> esc_html__( 'Choose Heading Typography', 'medistore' ),
		'section'     		=> 'medistore_section_typography',
		'settings'    		=> 'medistore_theme_options[theme_head_typography]',
		'type'		  		=> 'select',
		'choices'			=> medistore_typography_options(),
    )
);

$wp_customize->add_setting( 'medistore_theme_options[theme_sub_head_typography]',
	array(
		'sanitize_callback'	=> 'medistore_sanitize_select',
	)
);

$wp_customize->add_control( 'medistore_theme_options[theme_sub_head_typography]',
    array(
		'label'       		=> esc_html__( 'Choose Sub Heading Typography', 'medistore' ),
		'section'     		=> 'medistore_section_typography',
		'settings'    		=> 'medistore_theme_options[theme_sub_head_typography]',
		'type'		  		=> 'select',
		'choices'			=> medistore_typography_options(),
    )
);

$wp_customize->add_setting( 'medistore_theme_options[theme_body_typography]',
	array(
		'sanitize_callback'	=> 'medistore_sanitize_select',
	)
);
$wp_customize->add_control( 'medistore_theme_options[theme_body_typography]',
    array(
		'label'       		=> esc_html__( 'Choose Body Typography', 'medistore' ),
		'section'     		=> 'medistore_section_typography',
		'settings'    		=> 'medistore_theme_options[theme_body_typography]',
		'type'		  		=> 'select',
		'choices'			=> medistore_typography_options(),
    )
);

$wp_customize->add_setting( 'medistore_theme_options[theme_btn_label_typography]',
	array(
		'sanitize_callback'	=> 'medistore_sanitize_select',
	)
);
$wp_customize->add_control( 'medistore_theme_options[theme_btn_label_typography]',
    array(
		'label'       		=> esc_html__( 'Choose Button Label Typography', 'medistore' ),
		'section'     		=> 'medistore_section_typography',
		'settings'    		=> 'medistore_theme_options[theme_btn_label_typography]',
		'type'		  		=> 'select',
		'choices'			=> medistore_typography_options(),
    )
);