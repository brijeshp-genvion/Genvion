<?php
/**
 * Popular Product Section options
 *
 * @package Theme Palace
 * @subpackage medistore
 * @since medistore 1.0.0
 */

// Add Product section
$wp_customize->add_section( 'medistore_popular_product_section',
	array(
		'title'             => esc_html__( 'Popular Product','medistore' ),
		'description'       => esc_html__( 'Note: To activate this section you need to install WooCommerce Plugin.', 'medistore' ),
        'panel'       		=> 'medistore_front_page_panel',
	)
);

// Product content enable control and setting
$wp_customize->add_setting( 'medistore_theme_options[popular_product_section_enable]',
	array(
		'default'			=> 	$options['popular_product_section_enable'],
		'sanitize_callback' => 'medistore_sanitize_switch_control',
	)
);

$wp_customize->add_control( new Medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[popular_product_section_enable]',
		array(
			'label'             => esc_html__( 'Popular Product Section Enable', 'medistore' ),
			'section'           => 'medistore_popular_product_section',
			'on_off_label' 		=> medistore_switch_options(),
		)
	)
);

// popular_product title setting and control
$wp_customize->add_setting( 'medistore_theme_options[popular_product_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'			=> $options['popular_product_title'],
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'medistore_theme_options[popular_product_title]',
	array(
		'label'           	=> esc_html__( 'Section Title', 'medistore' ),
		'section'        	=> 'medistore_popular_product_section',
		'active_callback' 	=> 'medistore_is_popular_product_section_enable',
		'type'				=> 'text',
	)
);


// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[popular_product_title]',
		array(
			'selector'            => '#product .section-header h2.section-title',
			'settings'            => 'medistore_theme_options[popular_product_title]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'medistore_popular_product_title_partial',
		)
	);
}

// Product content type control and setting
$wp_customize->add_setting( 'medistore_theme_options[popular_product_content_type]',
	array(
		'default'          	=> $options['popular_product_content_type'],
		'sanitize_callback' => 'medistore_sanitize_select',
	)
);

$wp_customize->add_control( 'medistore_theme_options[popular_product_content_type]',
	array(
		'label'             => esc_html__( 'Content Type', 'medistore' ),
		'section'           => 'medistore_popular_product_section',
		'type'				=> 'select',
		'active_callback' 	=> 'medistore_is_popular_product_section_enable',
		'choices'			=>  medistore_popular_product_content_type()
	)
);


// Add dropdown categories setting and control.
$wp_customize->add_setting( 'medistore_theme_options[popular_product_category]',
    array(
        'sanitize_callback' => 'medistore_sanitize_category_list',
    )
);

$wp_customize->add_control( new Medistore_Dropdown_Multiple_Chooser( $wp_customize,
		'medistore_theme_options[popular_product_category]', 
		array(
			'label'             => esc_html__( 'Select Excluding Categories', 'medistore' ),
			'section'           => 'medistore_popular_product_section',
			'type'              => 'dropdown_multiple_chooser',
			'choices'           =>  medistore_category_choices(),
			'active_callback'   => 'medistore_is_popular_product_section_content_category_enable'
		)
	)
);


// Add dropdown category setting and control.
$wp_customize->add_setting(  'medistore_theme_options[popular_product_content_product_category]',
	array(
		'sanitize_callback' => 'medistore_sanitize_product_category_list',
	)
);

$wp_customize->add_control( new Medistore_Dropdown_Multiple_Chooser( $wp_customize,
	'medistore_theme_options[popular_product_content_product_category]',
		array(
			'label'             => esc_html__( 'Select Product Category', 'medistore' ),
			'description'      	=> esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'medistore' ),
			'section'           => 'medistore_popular_product_section',
			'choices'           =>  medistore_product_category_choices(),
			'type'              => 'dropdown_multiple_chooser',
			'active_callback'	=> 'medistore_is_popular_product_section_content_product_category_enable'
		)
	)
);


// featured product btn title setting and control
$wp_customize->add_setting( 'medistore_theme_options[popular_product_btn_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => $options['popular_product_btn_title'],
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'medistore_theme_options[popular_product_btn_title]',
	array(
		'label'           	=> esc_html__( 'Button Label ', 'medistore' ),
		'section'        	=> 'medistore_popular_product_section',
		'active_callback' 	=> 'medistore_is_popular_product_section_enable',
		'type'				=> 'text',
	)
);


// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[popular_product_btn_title]',
		array(
			'selector'            => '#product div.read-more a',
			'settings'            => 'medistore_theme_options[popular_product_btn_title]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'medistore_popular_product_btn_title_partial',
		)
	);
}

$wp_customize->add_setting( 'medistore_theme_options[popular_product_btn_url]',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control( 'medistore_theme_options[popular_product_btn_url]',
    array(
        'label'           	=> esc_html__( 'Button URL', 'medistore' ),
        'section'        	=> 'medistore_popular_product_section',
        'active_callback' 	=> 'medistore_is_popular_product_section_enable',
        'type'				=> 'url',
    ) 
);