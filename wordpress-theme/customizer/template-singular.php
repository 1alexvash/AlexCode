<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


function customizer_register_template_singular( $wp_customize ) {

	$wp_customize->add_section(
		ALEXCODETH_SLUG . '_template_singular',
		[
			'title'            => __( 'Постоянные страницы и посты', ALEXCODETH_TEXTDOMAIN ),
			'priority'         => 30,
			'panel'            => 'page_templates',
		]
	); /**/

	$wp_customize->add_setting(
		'archivetitleprefix',
		[
			'transport'         => 'reset',
			'sanitize_callback' => 'sanitize_text_field',
		]
	);
	$wp_customize->add_control(
		'archivetitleprefix',
		[
			'section'           => ALEXCODETH_SLUG . '_template_archive',
			'label'             => __( 'Текст перед заголовком архива', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'text',
		]
	); /**/

}

add_action( 'customize_register', 'alexcodeth\customizer_register_template_singular', 10, 1 );