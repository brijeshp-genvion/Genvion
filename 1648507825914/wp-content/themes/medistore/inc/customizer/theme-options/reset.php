<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage  medistore
 * @since  medistore 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'medistore_reset_section',
	array(
		'title'             => esc_html__('Reset all settings','medistore'),
		'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'medistore' ),
	)
);

// Add reset enable setting and control.
$wp_customize->add_setting( 'medistore_theme_options[reset_options]',
	array(
		'default'           => $options['reset_options'],
		'sanitize_callback' => 'medistore_sanitize_checkbox',
		'transport'			=> 'postMessage',
	)
);

$wp_customize->add_control( 'medistore_theme_options[reset_options]',
	array(
		'label'             => esc_html__( 'Check to reset all settings', 'medistore' ),
		'section'           => 'medistore_reset_section',
		'type'              => 'checkbox',
	)
);
