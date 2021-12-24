<?php


namespace alexcodeth;


if ( ! defined( 'ABSPATH' ) ) { exit; };


function customizer_register_header( $wp_customize ) {

	$wp_customize->add_section(
		ALEXCODETH_SLUG . '_header',
		[
			'title'            => __( 'Шапка сайта', ALEXCODETH_TEXTDOMAIN ),
			'priority'         => 10,
			'panel'            => 'template_section',
		]
	); /**/

	$wp_customize->add_setting(
		'headersocialsusedby',
		[
			'transport'         => 'postMessage',
			'sanitize_callback' => 'alexcodeth\sanitize_checkbox',
		]
	);
	$wp_customize->add_control(
		'headersocialsusedby',
		[
			'section'           => ALEXCODETH_SLUG . '_header',
			'label'             => __( 'Использовать блок социальных сетей', ALEXCODETH_TEXTDOMAIN ),
			'type'              => 'checkbox',
		]
	);
	$wp_customize->selective_refresh->add_partial( 'headersocialsusedby', [
		'render_callback'  => '__return_false',
		'fallback_refresh' => true,
	] ); /**/

}

add_action( 'customize_register', 'alexcodeth\customizer_register_header', 10, 1 );