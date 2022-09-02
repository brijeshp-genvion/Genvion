<?php
/**
 * Blog Section options
 *
 * @package Theme Palace
 * @subpackage medistore
 * @since medistore 1.0.0
 */

// Add Blog section
$wp_customize->add_section( 'medistore_blog_section',
    array(
        'title'             => esc_html__( 'Blog','medistore' ),
        'description'       => esc_html__( 'Blog Section options.', 'medistore' ),
        'panel'             => 'medistore_front_page_panel',
    )
);

// Blog content enable control and setting
$wp_customize->add_setting( 'medistore_theme_options[blog_section_enable]',
    array(
        'default'           =>  $options['blog_section_enable'],
        'sanitize_callback' => 'medistore_sanitize_switch_control',
    )
);

$wp_customize->add_control( new Medistore_Switch_Control( $wp_customize,
    'medistore_theme_options[blog_section_enable]',
        array(
            'label'             => esc_html__( 'Blog Section Enable', 'medistore' ),
            'section'           => 'medistore_blog_section',
            'on_off_label'      => medistore_switch_options(),
        ) 
    )
);

// blog title setting and control
$wp_customize->add_setting( 'medistore_theme_options[blog_title]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => $options['blog_title'],
        'transport'         => 'postMessage',
    )
);

$wp_customize->add_control( 'medistore_theme_options[blog_title]',
    array(
        'label'             => esc_html__( 'Section Title', 'medistore' ),
        'section'           => 'medistore_blog_section',
        'active_callback'   => 'medistore_is_blog_section_enable',
        'type'              => 'text',
    ) 
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[blog_title]',
        array(
            'selector'            => '#articles-section .section-header h2.section-title',
            'settings'            => 'medistore_theme_options[blog_title]',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'medistore_blog_title_partial',
        )
    );
}


// Blog content type control and setting
$wp_customize->add_setting( 'medistore_theme_options[blog_content_type]',
    array(
        'default'           => $options['blog_content_type'],
        'sanitize_callback' => 'medistore_sanitize_select',
    ) 
);

$wp_customize->add_control( 'medistore_theme_options[blog_content_type]',
    array(
        'label'             => esc_html__( 'Content Type', 'medistore' ),
        'section'           => 'medistore_blog_section',
        'type'              => 'select',
        'active_callback'   => 'medistore_is_blog_section_enable',
        'choices'           => array( 
            'post'      => esc_html__( 'Post', 'medistore' ),
            'category'  => esc_html__( 'Category', 'medistore' ),
        ),
    ) 
);

for ( $i = 1; $i <= 3; $i++ ) :

    // blog posts drop down chooser control and setting
    $wp_customize->add_setting( 'medistore_theme_options[blog_content_post_' . $i . ']', 
        array(
            'sanitize_callback' => 'medistore_sanitize_page',
        ) 
    );

    $wp_customize->add_control( new Medistore_Dropdown_Chooser( $wp_customize, 'medistore_theme_options[blog_content_post_' . $i . ']', 
        array(
            'label'             => sprintf( esc_html__( 'Select Post %d', 'medistore' ), $i ),
            'section'           => 'medistore_blog_section',
            'choices'           => medistore_post_choices(),
            'active_callback'   => 'medistore_is_blog_section_content_post_enable',
        ) 
    ) );

endfor;

// Add dropdown category setting and control.
$wp_customize->add_setting(  'medistore_theme_options[blog_content_category]',
    array(
        'sanitize_callback' => 'medistore_sanitize_single_category',
    )
) ;

$wp_customize->add_control( new Medistore_Dropdown_Taxonomies_Control( $wp_customize,'medistore_theme_options[blog_content_category]',
    array(
        'label'             => esc_html__( 'Select Category', 'medistore' ),
        'description'       => esc_html__( 'Note: Latest selected no of posts will be shown from selected category', 'medistore' ),
        'section'           => 'medistore_blog_section',
        'type'              => 'dropdown-taxonomies',
        'active_callback'   => 'medistore_is_blog_section_content_category_enable'
    ) 
) );

// Blog Excerpt length setting and control.
$wp_customize->add_setting( 'medistore_theme_options[blog_excerpt_length]',
	array(
		'sanitize_callback' => 'medistore_sanitize_number_range',
		'default'			=> $options['blog_excerpt_length'],
	)
);

$wp_customize->add_control( 'medistore_theme_options[blog_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Excerpt Length', 'medistore' ),
		'description' 		=> esc_html__( 'Total words to be displayed in Blog section', 'medistore' ),
		'section'     		=> 'medistore_blog_section',
		'type'        		=> 'number',
		'active_callback' 	=> 'medistore_is_blog_section_enable',
	)
);

// featured product btn title setting and control
$wp_customize->add_setting( 'medistore_theme_options[blog_btn_title]',
	array(
		'sanitize_callback' => 'sanitize_text_field',
		'default'           => $options['blog_btn_title'],
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'medistore_theme_options[blog_btn_title]',
	array(
		'label'           	=> esc_html__( 'Button Label ', 'medistore' ),
		'section'        	=> 'medistore_blog_section',
		'active_callback' 	=> 'medistore_is_blog_section_enable',
		'type'				=> 'text',
	)
);


// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[blog_btn_title]',
		array(
			'selector'            => '#articles-section div.articles-button div:last-child a',
			'settings'            => 'medistore_theme_options[blog_btn_title]',
			'container_inclusive' => false,
			'fallback_refresh'    => true,
			'render_callback'     => 'medistore_blog_btn_title_partial',
		)
	);
}

$wp_customize->add_setting( 'medistore_theme_options[blog_btn_url]',
    array(
        'sanitize_callback' => 'esc_url_raw',
    )
);

$wp_customize->add_control( 'medistore_theme_options[blog_btn_url]',
    array(
        'label'           	=> esc_html__( 'Button URL', 'medistore' ),
        'section'        	=> 'medistore_blog_section',
        'active_callback' 	=> 'medistore_is_blog_section_enable',
        'type'				=> 'url',
    ) 
);

// Blog content enable control and setting
$wp_customize->add_setting( 'medistore_theme_options[blog_appointment_date_enable]',
    array(
        'default'           =>  $options['blog_appointment_date_enable'],
        'sanitize_callback' => 'medistore_sanitize_switch_control',
    )
);

$wp_customize->add_control( new Medistore_Switch_Control( $wp_customize,
    'medistore_theme_options[blog_appointment_date_enable]',
        array(
            'label'             => esc_html__( 'Show Appointment Date', 'medistore' ),
            'section'           => 'medistore_blog_section',
            'on_off_label'      => medistore_switch_options(),
        ) 
    )
);

// blog title setting and control
$wp_customize->add_setting( 'medistore_theme_options[blog_appointment_day]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => $options['blog_appointment_day'],
        'transport'         => 'postMessage',
    )
);

$wp_customize->add_control( 'medistore_theme_options[blog_appointment_day]',
    array(
        'label'             => esc_html__( 'Appointment Title', 'medistore' ),
        'section'           => 'medistore_blog_section',
        'active_callback'   => 'medistore_is_blog_section_appointment_enable',
        'type'              => 'text',
    ) 
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[blog_appointment_day]',
        array(
            'selector'            => '#articles-section div.articles-button div.read-more a span',
            'settings'            => 'medistore_theme_options[blog_appointment_day]',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'medistore_blog_appointment_day_partial',
        )
    );
}

// blog title setting and control
$wp_customize->add_setting( 'medistore_theme_options[blog_appointment_description]',
    array(
        'sanitize_callback' => 'sanitize_text_field',
        'default'           => $options['blog_appointment_description'],
        'transport'         => 'postMessage',
    )
);

$wp_customize->add_control( 'medistore_theme_options[blog_appointment_description]',
    array(
        'label'             => esc_html__( 'Appointment Description', 'medistore' ),
        'section'           => 'medistore_blog_section',
        'active_callback'   => 'medistore_is_blog_section_appointment_enable',
        'type'              => 'text',
    ) 
);

// Abort if selective refresh is not available.
if ( isset( $wp_customize->selective_refresh ) ) {
    $wp_customize->selective_refresh->add_partial( 'medistore_theme_options[blog_appointment_description]',
        array(
            'selector'            => '#articles-section div.articles-button div.entry-content p',
            'settings'            => 'medistore_theme_options[blog_appointment_description]',
            'container_inclusive' => false,
            'fallback_refresh'    => true,
            'render_callback'     => 'medistore_blog_appointment_description_partial',
        )
    );
}