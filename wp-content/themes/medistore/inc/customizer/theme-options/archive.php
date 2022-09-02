<?php
/**
 * Archive options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

// Add archive section
$wp_customize->add_section( 'medistore_archive_section',
	array(
		'title'             => esc_html__( 'Blog/Archive','medistore' ),
		'description'       => esc_html__( 'Archive section options.', 'medistore' ),
		'panel'             => 'medistore_theme_options_panel',
	)
);

// Your latest posts title setting and control.
$wp_customize->add_setting( 'medistore_theme_options[your_latest_posts_title]',
	array(
		'default'           => $options['your_latest_posts_title'],
		'sanitize_callback' => 'sanitize_text_field',
	)
);

$wp_customize->add_control( 'medistore_theme_options[your_latest_posts_title]',
	array(
		'label'             => esc_html__( 'Your Latest Posts Title', 'medistore' ),
		'description'       => esc_html__( 'This option only works if Static Front Page is set to "Your latest posts."', 'medistore' ),
		'section'           => 'medistore_archive_section',
		'type'				=> 'text',
		'active_callback'   => 'medistore_is_latest_posts'
	)
);

// features content type control and setting
$wp_customize->add_setting( 'medistore_theme_options[blog_column]',
	array(
		'default'          	=> $options['blog_column'],
		'sanitize_callback' => 'medistore_sanitize_select',
	)
);

$wp_customize->add_control( 'medistore_theme_options[blog_column]',
	array(
		'label'             => esc_html__( 'Column Layout', 'medistore' ),
		'section'           => 'medistore_archive_section',
		'type'				=> 'select',
		'choices'			=> array( 
			'col-1'		=> esc_html__( 'One Column', 'medistore' ),
			'col-2'		=> esc_html__( 'Two Column', 'medistore' ),
			'col-3'		=> esc_html__( 'Three Column', 'medistore' ),
		),
	)
);

// Archive tag category setting and control.
$wp_customize->add_setting( 'medistore_theme_options[hide_date]',
	array(
		'default'           => $options['hide_date'],
		'sanitize_callback' => 'medistore_sanitize_switch_control',
	)
);

$wp_customize->add_control( new  medistore_Switch_Control( $wp_customize,
	'medistore_theme_options[hide_date]',
		array(
			'label'             => esc_html__( 'Hide Date', 'medistore' ),
			'section'           => 'medistore_archive_section',
			'on_off_label' 		=> medistore_hide_options(),
		)
	)
);