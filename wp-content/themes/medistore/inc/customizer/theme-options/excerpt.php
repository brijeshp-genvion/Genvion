<?php
/**
 * Excerpt options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

// Add excerpt section
$wp_customize->add_section( 'medistore_excerpt_section',
	array(
		'title'             => esc_html__( 'Excerpt','medistore' ),
		'description'       => esc_html__( 'Excerpt section options.', 'medistore' ),
		'panel'             => 'medistore_theme_options_panel',
	)
);


// long Excerpt length setting and control.
$wp_customize->add_setting( 'medistore_theme_options[long_excerpt_length]',
	array(
		'sanitize_callback' => 'medistore_sanitize_number_range',
		'validate_callback' => 'medistore_validate_long_excerpt',
		'default'			=> $options['long_excerpt_length'],
	)
);

$wp_customize->add_control( 'medistore_theme_options[long_excerpt_length]',
	array(
		'label'       		=> esc_html__( 'Blog Page Excerpt Length', 'medistore' ),
		'description' 		=> esc_html__( 'Total words to be displayed in archive page/search page.', 'medistore' ),
		'section'     		=> 'medistore_excerpt_section',
		'type'        		=> 'number',
		'input_attrs' 		=> array(
			'style'       => 'width: 80px;',
			'max'         => 100,
			'min'         => 5,
		),
	)
);
